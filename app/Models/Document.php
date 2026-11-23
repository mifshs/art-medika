<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Document extends Model
{
    protected $fillable = ['category', 'title', 'slug', 'file_url', 'published_at', 'sort_order'];
    protected $casts = ['published_at' => 'date'];

    protected static function booted(): void
    {
        static::creating(function (Document $document) {
            if (empty($document->slug) && Schema::hasColumn($document->getTable(), 'slug')) {
                $base = Str::slug((string) $document->title) ?: 'document';
                $slug = $base;
                $suffix = 2;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $base . '-' . $suffix++;
                }
                $document->slug = $slug;
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function resolveRouteBinding($value, $field = null): ?Model
    {
        if ($field === null) {
            $bySlug = $this->where('slug', $value)->first();
            if ($bySlug) {
                return $bySlug;
            }
            if (ctype_digit((string) $value)) {
                return $this->where('id', (int) $value)->first();
            }

            return null;
        }

        return $this->where($field, $value)->first();
    }

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
            return route('documents.download', $this);
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
