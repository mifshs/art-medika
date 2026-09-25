<?php

namespace App\Models;

use App\Models\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasMedia;

    protected $fillable = [
        'service_category_id', 'nomenclature_code', 'mis_code', 'name', 'slug',
        'description', 'unit', 'duration_type', 'duration_min',
        'price', 'price_cat_1', 'price_cat_2', 'price_cat_3',
        'problems', 'preparation', 'execution', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'problems'    => 'array',
        'price'       => 'decimal:2',
        'price_cat_1' => 'decimal:2',
        'price_cat_2' => 'decimal:2',
        'price_cat_3' => 'decimal:2',
    ];

    public function scopeActive($q) { return $q->where('is_active', true); }

    public function category(): BelongsTo { return $this->belongsTo(ServiceCategory::class); }
    public function cases(): HasMany      { return $this->hasMany(ServiceCase::class)->orderBy('sort_order'); }
    public function experts(): BelongsToMany { return $this->belongsToMany(Expert::class); }

    public function beforeAfter(): HasMany
    {
        return $this->cases()->where('kind', 'result');
    }

    public function types(): HasMany
    {
        return $this->cases()->where('kind', 'type');
    }

    /** "до 40" или "30" */
    public function getDurationLabelAttribute(): ?string
    {
        return $this->duration_min === null ? null
            : ($this->duration_type === 'up_to' ? 'до ' . $this->duration_min : (string)$this->duration_min);
    }
}