<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    protected $fillable = ['category', 'title', 'file_url', 'published_at', 'sort_order'];
    protected $casts = ['published_at' => 'date'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Ссылка на файл для скачивания или просмотра
     */
    public function getDownloadUrlAttribute(): string
    {
        if (empty($this->file_url)) {
            return route('documents.download', $this->id);
        }

        if (str_starts_with($this->file_url, 'http://') || str_starts_with($this->file_url, 'https://')) {
            return $this->file_url;
        }

        if (file_exists(public_path($this->file_url))) {
            return asset($this->file_url);
        }

        if (Storage::disk('public')->exists($this->file_url)) {
            return Storage::disk('public')->url($this->file_url);
        }

        return asset($this->file_url);
    }
}
