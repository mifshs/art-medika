<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;

trait SeedsMedia
{
    protected function attachMedia(Model $model, string $collection, string $seed, string $alt = '', string $size = '900/600'): void
    {
        $model->media()->updateOrCreate(
            ['collection' => $collection, 'path' => "seed/$seed"],
            [
                'disk' => 'external',
                'url'  => "https://picsum.photos/seed/$seed/$size",
                'alt'  => $alt,
            ],
        );
    }
}