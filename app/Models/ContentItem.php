<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContentItem extends Model
{
    public const PENDING_AI = 'pending_ai';
    public const PENDING_REVIEW = 'pending_review';
    public const APPROVED = 'approved';
    public const PUBLISHING = 'publishing';
    public const PUBLISHED = 'published';
    public const FAILED = 'failed';

    protected $fillable = ['agent_id', 'user_id', 'title', 'media_path', 'media_type', 'platforms', 'status', 'generated_caption', 'edited_caption', 'generated_hashtags', 'scheduled_at', 'approved_at', 'published_at', 'failure_reason'];

    protected function casts(): array
    {
        return ['platforms' => 'array', 'generated_hashtags' => 'array', 'scheduled_at' => 'datetime', 'approved_at' => 'datetime', 'published_at' => 'datetime'];
    }

    public function agent(): BelongsTo { return $this->belongsTo(Agent::class); }
    public function publishLogs(): HasMany { return $this->hasMany(PublishLog::class); }
}
