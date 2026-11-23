<?php

namespace App\Models\Traits;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasMedia
{
    public function media(): MorphMany
    {
        /** @var Model $this */
        return $this->morphMany(Media::class, 'model')->orderBy('sort_order');
    }

    public function mediaByCollection(string $collection): MorphMany
    {
        return $this->media()->where('collection', $collection);
    }

    public function mediaUrl(string $collection): ?string
    {
        return $this->media->firstWhere('collection', $collection)?->url;
    }

    public function coverUrl(): ?string
    {
        return $this->mediaUrl('cover');
    }

    public function avatarUrl(): ?string
    {
        return $this->mediaUrl('avatar');
    }

    public function gallery(): \Illuminate\Support\Collection
    {
        return $this->media->where('collection', 'gallery')->values();
    }
}