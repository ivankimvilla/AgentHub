<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PublishLog extends Model
{
    protected $fillable = ['content_item_id', 'platform', 'status', 'external_id', 'error_message', 'published_at'];

    protected function casts(): array { return ['published_at' => 'datetime']; }

    public function contentItem(): BelongsTo { return $this->belongsTo(ContentItem::class); }
}
