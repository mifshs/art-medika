<?php

namespace App\Models;

use App\Models\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectFormat extends Model
{
    use HasMedia;
    protected $fillable = ['project_id', 'title', 'description', 'sort_order'];
    public function project(): BelongsTo { return $this->belongsTo(Project::class); }
}