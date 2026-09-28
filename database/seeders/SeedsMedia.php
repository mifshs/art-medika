<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;

trait SeedsMedia
{
    protected function attachMedia(Model $model, string $collection, string $repoPath, string $alt = ''): void
    {
        $base = config('media.base_url');

        $url = $base
            ? rtrim($base, '/') . '/' . implode('/', array_map('rawurlencode', explode('/', $repoPath)))
            : 'https://picsum.photos/seed/' . md5($repoPath) . '/900/600';

        $model->media()->updateOrCreate(
            ['collection' => $collection, 'path' => $repoPath],
            [
                'disk' => 'github',
                'url'  => $url,
                'alt'  => $alt,
            ],
        );
    }
}