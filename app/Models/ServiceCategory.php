<?php

namespace App\Models;

use App\Models\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceCategory extends Model
{
    use HasMedia;

    protected $fillable = [
        'parent_id', 'name', 'slug', 'subtitle', 'description',
        'mis_code', 'note', 'sort_order', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($q) { return $q->where('is_active', true); }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('sort_order');
    }

    /** Корневые направления (нет parent_id) */
    public function scopeRoots($q) { return $q->whereNull('parent_id'); }

    /** Услуги, принадлежащие именно этой категории (без детей) */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class)->orderBy('sort_order');
    }

    /** Все услуги из категории и её потомков */
    public function allServices()
    {
        $ids = $this->descendantIds();
        $ids[] = $this->id;
        return Service::whereIn('service_category_id', $ids);
    }

    public function descendantIds(): array
    {
        $ids = [];
        foreach ($this->children as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $child->descendantIds());
        }
        return $ids;
    }

    /** «от X ₽» — считается из минимальной цены услуг потомков */
    public function priceFrom(): ?string
    {
        $min = $this->allServices()->active()->get()
            ->flatMap(fn (Service $s) => collect([
                $s->price, $s->price_cat_1, $s->price_cat_2, $s->price_cat_3,
            ])->filter())          // выкидываем NULL
            ->min();

        return $min !== null ? number_format((float) $min, 0, ',', ' ') : null;
    }
}