<?php

namespace App\Models;

use App\Models\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectPartner extends Model
{
    use HasMedia;
    protected $fillable = ['project_id', 'name', 'role', 'sort_order'];
    public function project(): BelongsTo { return $this->belongsTo(Project::class); }
}