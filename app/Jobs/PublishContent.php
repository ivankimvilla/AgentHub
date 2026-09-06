<?php

namespace App\Jobs;

use App\Models\ContentItem;
use App\Services\PlatformPublisher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PublishContent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    public function __construct(public ContentItem $content) {}

    public function handle(PlatformPublisher $publisher): void
    {
        $this->content->update(['status' => ContentItem::PUBLISHING]);
        foreach ($this->content->platforms as $platform) {
            try {
                $publisher->publish($this->content, $platform);
            } catch (\Throwable $exception) {
                $this->content->publishLogs()->updateOrCreate(
                    ['platform' => $platform],
                    ['status' => 'failed', 'error_message' => $exception->getMessage()],
                );
            }
        }

        $hasFailures = $this->content->publishLogs()->where('status', 'failed')->exists();
        $this->content->update([
            'status' => $hasFailures ? ContentItem::FAILED : ContentItem::PUBLISHED,
            'published_at' => $hasFailures ? null : now(),
            'failure_reason' => $hasFailures ? 'One or more platforms failed to publish.' : null,
        ]);
    }
}
