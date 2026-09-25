<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpertAccreditation extends Model
{
    protected $table = 'expert_accreditations'; 

    protected $fillable = [
        'expert_id', 'doc_type', 'specialty', 'position',
        'issued_at', 'expires_at', 'note', 'sort_order',
    ];

    protected $casts = ['issued_at' => 'date', 'expires_at' => 'date'];

    public function expert(): BelongsTo { return $this->belongsTo(Expert::class); }

    public function isValid(): bool
    {
        return ! $this->expires_at || $this->expires_at->isFuture();
    }
}