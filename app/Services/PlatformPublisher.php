<?php

namespace App\Services;

use App\Models\ContentItem;
use App\Models\PublishLog;
use RuntimeException;

class PlatformPublisher
{
    public function publish(ContentItem $content, string $platform): PublishLog
    {
        $supported = ['youtube', 'facebook', 'tiktok'];
        if (! in_array($platform, $supported, true)) {
            throw new RuntimeException("Unsupported platform: {$platform}");
        }

        return $content->publishLogs()->updateOrCreate(
            ['platform' => $platform],
            [
                'status' => 'published',
                'external_id' => 'demo-'.str()->uuid(),
                'published_at' => now(),
                'error_message' => null,
            ],
        );
    }
}
