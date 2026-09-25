<?php

namespace App\Models;

use App\Models\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasMedia;

    protected $fillable = [
        'author_name', 'rating', 'history', 'liked',
        'service_id', 'expert_id', 'source', 'published_at', 'is_active',
    ];

    protected $casts = [
        'published_at' => 'date',
        'is_active'    => 'boolean',
    ];

    public function scopeActive($q) { return $q->where('is_active', true); }
    public function service(): BelongsTo { return $this->belongsTo(Service::class); }
    public function expert():  BelongsTo { return $this->belongsTo(Expert::class); }
}