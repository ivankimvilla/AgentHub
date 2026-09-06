<?php

namespace App\Http\Controllers;

use App\Jobs\AnalyzeContent;
use App\Jobs\PublishContent;
use App\Models\Agent;
use App\Models\ContentItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'media' => ['required', 'file', 'mimes:jpg,jpeg,png,mp4,mov', 'max:2097152'],
            'agent_id' => ['nullable', 'exists:agents,id'],
            'platforms' => ['required', 'array', 'min:1'],
            'platforms.*' => ['in:youtube,facebook,tiktok'],
        ]);

        $path = $request->file('media')->store('content', 'public');
        $agent = Agent::find($data['agent_id'] ?? null);
        $content = ContentItem::create([
            'agent_id' => $agent?->id,
            'title' => $request->file('media')->getClientOriginalName(),
            'media_path' => $path,
            'media_type' => $request->file('media')->getMimeType(),
            'platforms' => array_values($data['platforms']),
            'status' => ContentItem::PENDING_AI,
        ]);

        AnalyzeContent::dispatch($content);

        return back()->with('success', 'Media uploaded. AI caption and hashtag suggestions have been queued for review.');
    }

    public function update(Request $request, ContentItem $content): RedirectResponse
    {
        $data = $request->validate([
            'caption' => ['required', 'string', 'max:5000'],
            'hashtags' => ['nullable', 'string', 'max:1000'],
        ]);
        $hashtags = collect(preg_split('/[\s,]+/', trim($data['hashtags'] ?? '')))->filter()->map(fn ($tag) => str_starts_with($tag, '#') ? $tag : '#'.$tag)->values()->all();
        $content->update(['edited_caption' => $data['caption'], 'generated_hashtags' => $hashtags, 'status' => ContentItem::PENDING_REVIEW]);

        return back()->with('success', 'Content changes saved.');
    }

    public function approve(ContentItem $content): RedirectResponse
    {
        abort_unless($content->status === ContentItem::PENDING_REVIEW, 422, 'Only content awaiting review can be approved.');
        $content->update(['status' => ContentItem::APPROVED, 'approved_at' => now()]);
        PublishContent::dispatch($content);

        return back()->with('success', 'Content approved and publishing has been queued.');
    }
}
