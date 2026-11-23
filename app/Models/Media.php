<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property string $collection
 * @property string $disk
 * @property string $path
 * @property string|null $url
 * @property string|null $alt
 * @property int $sort_order
 * @property array|null $meta
 */
class Media extends Model
{
    protected $fillable = [
        'model_type', 'model_id', 'collection', 'disk',
        'path', 'url', 'alt', 'sort_order', 'meta',
    ];

    protected $casts = ['meta' => 'array'];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function getUrlAttribute(?string $value): string
    {
        $path = ltrim((string) $this->path, '/');

        if ($path !== ''
            && Storage::disk('public')->exists($path)
            && (empty($value) || str_contains($value, 'art-medika-media'))) {
            $base = rtrim((string) (config('media.base_url') ?: '/storage'), '/');

            return $base . '/' . implode('/', array_map('rawurlencode', explode('/', $path)));
        }

        if (! empty($value)) {
            return $value;
        }

        /** @var FilesystemAdapter $disk */
        $disk = Storage::disk($this->disk === 'github' ? 'public' : $this->disk);

        return $disk->url($this->path);
    }
}