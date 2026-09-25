<?php

namespace App\Models;

use App\Models\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceCase extends Model
{
    use HasMedia;

    protected $fillable = ['service_id', 'kind', 'title', 'description', 'sort_order'];

    public function service(): BelongsTo { return $this->belongsTo(Service::class); }

    public function beforeUrl(): ?string { return $this->media->firstWhere('collection', 'before')?->url; }
    public function afterUrl():  ?string { return $this->media->firstWhere('collection', 'after')?->url;  }
}