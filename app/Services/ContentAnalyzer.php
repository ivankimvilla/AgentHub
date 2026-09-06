<?php

namespace App\Services;

use App\Models\ContentItem;

class ContentAnalyzer
{
    public function analyze(ContentItem $content): array
    {
        $title = pathinfo($content->title, PATHINFO_FILENAME);
        $label = trim((string) preg_replace('/[-_]+/', ' ', $title));
        $label = $label !== '' ? ucfirst($label) : 'New content';

        return [
            'caption' => "Introducing {$label}. Tell your story, share the moment, and stay tuned for what comes next.",
            'hashtags' => ['#NewContent', '#BehindTheScenes', '#YourBrand'],
        ];
    }
}
