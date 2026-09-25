<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpertEducation extends Model
{
    protected $table = 'expert_educations';  

    protected $fillable = ['expert_id', 'level', 'organization', 'issued_year', 'qualification', 'sort_order'];

    public function expert(): BelongsTo { return $this->belongsTo(Expert::class); }
}