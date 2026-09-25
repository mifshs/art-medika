<?php

namespace App\Models;

use App\Models\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasMedia;

    protected $table = 'news';
    protected $fillable = [
        'content_category_id', 'expert_id', 'type', 'title', 'slug',
        'excerpt', 'content', 'published_at', 'is_active',
    ];

    protected $casts = [
        'published_at' => 'date',
        'is_active'    => 'boolean',
    ];

    public function scopeActive($q)    { return $q->where('is_active', true); }
    public function scopePublished($q) { return $q->active()->whereNotNull('published_at'); }

    public function category(): BelongsTo { return $this->belongsTo(ContentCategory::class, 'content_category_id'); }
    public function author(): BelongsTo   { return $this->belongsTo(Expert::class, 'expert_id'); }

    public function readingTime(): int
    {
        $words = str_word_count(strip_tags($this->content));
        return max(1, (int) round($words / 200));
    }
}