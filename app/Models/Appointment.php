<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $fillable = [
        'patient_name', 'phone', 'email',
        'service_id', 'expert_id',
        'desired_date', 'desired_time', 'comment', 'status',
    ];

    protected $casts = ['desired_date' => 'date'];

    public function service(): BelongsTo { return $this->belongsTo(Service::class); }
    public function expert():  BelongsTo { return $this->belongsTo(Expert::class); }

    public function isNew(): bool { return $this->status === 'new'; }
}