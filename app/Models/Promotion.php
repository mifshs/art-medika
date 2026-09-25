<?php

namespace App\Models;

use App\Models\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Promotion extends Model
{
    use HasMedia;

    protected $fillable = [
        'service_id', 'title', 'slug', 'excerpt', 'content',
        'discount_percent', 'valid_until', 'published_at', 'is_active',
    ];

    protected $casts = [
        'valid_until'  => 'date',
        'published_at' => 'date',
        'is_active'    => 'boolean',
    ];

    public function scopeActive($q)    { return $q->where('is_active', true); }
    public function scopePublished($q) { return $q->active()->whereNotNull('published_at'); }
    public function scopeValid($q)     { return $q->where(fn ($qq) => $qq->whereNull('valid_until')->orWhere('valid_until', '>=', today())); }

    public function service(): BelongsTo { return $this->belongsTo(Service::class); }
}