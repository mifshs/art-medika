<?php

namespace App\Models;

use App\Models\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Expert extends Model
{
    use HasMedia;

    protected $fillable = [
        'department_id', 'name', 'slug', 'position',
        'experience_since', 'operations_count', 'positive_percent',
        'activities', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'activities' => 'array',
        'is_active'  => 'boolean',
    ];

    public function scopeActive($q) { return $q->where('is_active', true); }

    public function department(): BelongsTo        { return $this->belongsTo(Department::class); }
    public function services(): BelongsToMany      { return $this->belongsToMany(Service::class); }
    public function educations(): HasMany          { return $this->hasMany(ExpertEducation::class)->orderBy('sort_order'); }
    public function accreditations(): HasMany      { return $this->hasMany(ExpertAccreditation::class)->orderBy('sort_order'); }

    /** "с 2002 года" → количество лет */
    public function yearsExperience(): ?int
    {
        return $this->experience_since ? now()->year - $this->experience_since : null;
    }
}