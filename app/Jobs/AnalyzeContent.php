<?php

namespace App\Jobs;

use App\Models\ContentItem;
use App\Services\ContentAnalyzer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AnalyzeContent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    public function __construct(public ContentItem $content) {}

    public function handle(ContentAnalyzer $analyzer): void
    {
        $result = $analyzer->analyze($this->content);
        $this->content->update([
            'generated_caption' => $result['caption'],
            'generated_hashtags' => $result['hashtags'],
            'status' => ContentItem::PENDING_REVIEW,
            'failure_reason' => null,
        ]);
    }

    public function failed(?\Throwable $exception): void
    {
        $this->content->update(['status' => ContentItem::FAILED, 'failure_reason' => $exception?->getMessage()]);
    }
}
