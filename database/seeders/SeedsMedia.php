<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;

trait SeedsMedia
{
    protected function attachMedia(Model $model, string $collection, string $repoPath, string $alt = ''): void
    {
        $base = rtrim((string) (config('media.base_url') ?: '/storage'), '/');
        $url  = $base . '/' . implode('/', array_map('rawurlencode', explode('/', ltrim($repoPath, '/'))));

        $model->media()->updateOrCreate(
            ['collection' => $collection, 'path' => $repoPath],
            [
                'disk' => 'public',
                'url'  => $url,
                'alt'  => $alt,
            ],
        );
    }
}