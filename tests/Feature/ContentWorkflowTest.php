<?php

namespace Tests\Feature;

use App\Jobs\AnalyzeContent;
use App\Jobs\PublishContent;
use App\Models\ContentItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ContentWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_media_upload_creates_pending_content_and_queues_analysis(): void
    {
        Storage::fake('public');
        Queue::fake();

        $response = $this->post(route('content.store'), [
            'media' => UploadedFile::fake()->create('launch.mp4', 100, 'video/mp4'),
            'platforms' => ['youtube', 'tiktok'],
        ]);

        $response->assertSessionHas('success')->assertRedirect();
        $content = ContentItem::firstOrFail();
        $this->assertSame(ContentItem::PENDING_AI, $content->status);
        Storage::disk('public')->assertExists($content->media_path);
        Queue::assertPushed(AnalyzeContent::class);
    }

    public function test_analysis_generates_a_reviewable_draft(): void
    {
        $content = ContentItem::create([
            'title' => 'launch.mp4',
            'media_path' => 'content/launch.mp4',
            'platforms' => ['youtube'],
            'status' => ContentItem::PENDING_AI,
        ]);

        (new AnalyzeContent($content))->handle(app(\App\Services\ContentAnalyzer::class));

        $content->refresh();
        $this->assertSame(ContentItem::PENDING_REVIEW, $content->status);
        $this->assertNotEmpty($content->generated_caption);
        $this->assertNotEmpty($content->generated_hashtags);
    }

    public function test_approved_content_publishes_to_each_selected_platform(): void
    {
        $content = ContentItem::create([
            'title' => 'launch.mp4',
            'media_path' => 'content/launch.mp4',
            'platforms' => ['youtube', 'tiktok'],
            'status' => ContentItem::PENDING_REVIEW,
            'generated_caption' => 'Launch day',
        ]);

        $response = $this->post(route('content.approve', $content));

        $response->assertSessionHas('success')->assertRedirect();
        $content->refresh();
        $this->assertSame(ContentItem::PUBLISHED, $content->status);
        $this->assertCount(2, $content->publishLogs);
        $this->assertSame('published', $content->publishLogs->first()->status);
    }

    public function test_ai_caption_and_hashtags_can_be_edited_before_publishing(): void
    {
        $content = ContentItem::create([
            'title' => 'launch.mp4',
            'media_path' => 'content/launch.mp4',
            'platforms' => ['youtube'],
            'status' => ContentItem::PENDING_REVIEW,
            'generated_caption' => 'AI caption',
            'generated_hashtags' => ['#NewContent'],
        ]);

        $response = $this->patch(route('content.update', $content), [
            'caption' => 'My edited caption',
            'hashtags' => '#launch #summer',
        ]);

        $response->assertSessionHas('success')->assertRedirect();
        $content->refresh();
        $this->assertSame('My edited caption', $content->edited_caption);
        $this->assertSame(['#launch', '#summer'], $content->generated_hashtags);
    }
}
