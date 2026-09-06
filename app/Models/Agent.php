<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agent extends Model
{
    protected $fillable = ['name', 'prompt', 'platforms', 'hashtag_rules', 'active'];

    protected function casts(): array
    {
        return ['platforms' => 'array', 'hashtag_rules' => 'array', 'active' => 'boolean'];
    }

    public function contentItems(): HasMany
    {
        return $this->hasMany(ContentItem::class);
    }
}
