<?php

namespace App\Models;

use App\Models\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasMedia;

    protected $fillable = [
        'title', 'subtitle', 'slug', 'excerpt', 'description', 'mission',
        'stats', 'published_at', 'is_active',
    ];

    protected $casts = [
        'stats'        => 'array',
        'published_at' => 'date',
        'is_active'    => 'boolean',
    ];

    public function formats(): HasMany  { return $this->hasMany(ProjectFormat::class)->orderBy('sort_order'); }
    public function stages(): HasMany   { return $this->hasMany(ProjectStage::class)->orderBy('sort_order'); }
    public function partners(): HasMany { return $this->hasMany(ProjectPartner::class)->orderBy('sort_order'); }

    /** Название проекта для страницы детального просмотра */
    public function getDetailTitleAttribute(): string
    {
        if (preg_match('/«([^»]+)»/u', $this->title, $m)) {
            return $m[1];
        }
        return $this->title;
    }

    /** Проверка наличия полного контента (по аналогии со страницей услуг) */
    public function hasFullContent(): bool
    {
        return !empty($this->description)
            || !empty($this->mission)
            || $this->formats->isNotEmpty()
            || $this->stages->isNotEmpty();
    }
}