<?php

namespace App\Filament\Support;

use App\Models\Media;
use Closure;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class MediaUpload
{
    /**
     * Разрешает путь из БД (в т.ч. legacy CDN URL и .png -> .webp) в путь на диске `public`.
     */
    public static function resolvePublicPath(?string $rawPath): ?string
    {
        if (blank($rawPath)) {
            return null;
        }

        $path = trim($rawPath);

        if (preg_match('#art-medika-media@[^/]+/(.+)$#i', $path, $matches)) {
            $path = rawurldecode($matches[1]);
        } elseif (preg_match('#^https?://#i', $path)) {
            return null;
        }

        $path = rawurldecode(ltrim($path, '/'));
        $path = preg_replace('#^storage/#i', '', $path) ?? $path;

        if ($path === '' || str_contains($path, '..')) {
            return null;
        }

        $disk = Storage::disk('public');

        if ($disk->exists($path)) {
            return $path;
        }

        if (preg_match('/\.png$/i', $path)) {
            $webpPath = preg_replace('/\.png$/i', '.webp', $path);
            if ($webpPath !== null && $disk->exists($webpPath)) {
                return $webpPath;
            }
        }

        return null;
    }

    public static function isImagePath(?string $path): bool
    {
        if (blank($path)) {
            return false;
        }

        $clean = (string) parse_url($path, PHP_URL_PATH);

        return (bool) preg_match('/\.(webp|png|jpe?g|gif|svg|avif)$/i', $clean);
    }

    public static function encodePath(string $path): string
    {
        $clean = ltrim($path, '/');

        return implode('/', array_map('rawurlencode', explode('/', $clean)));
    }

    public static function publicUrl(string $path): string
    {
        $base = rtrim((string) (config('media.base_url') ?: '/storage'), '/');

        return $base . '/' . self::encodePath($path);
    }

    /**
     * Колбэк для FileUpload::getUploadedFileUsing — корректно отдаёт превью из /storage на HTTP и HTTPS.
     */
    public static function uploadedFileCallback(): Closure
    {
        return static function (Forms\Components\BaseFileUpload $component, string $file, string | array | null $storedFileNames): ?array {
            $storage = $component->getDisk();
            $resolved = self::resolvePublicPath($file) ?? $file;

            if (! $storage->exists($resolved)) {
                return null;
            }

            return [
                'name' => ($component->isMultiple() ? ($storedFileNames[$file] ?? null) : $storedFileNames) ?? basename($resolved),
                'size' => $storage->size($resolved),
                'type' => $storage->mimeType($resolved),
                'url'  => self::publicUrl($resolved),
            ];
        };
    }

    /**
     * Все локально доступные пути коллекции `media` для записи.
     *
     * @return list<string>
     */
    public static function getRecordPublicPaths(Model $record, string $collection): array
    {
        if (! method_exists($record, 'media')) {
            return [];
        }

        $items = $record->relationLoaded('media')
            ? $record->media->where('collection', $collection)->sortBy('sort_order')->values()
            : $record->media()->where('collection', $collection)->orderBy('sort_order')->orderBy('id')->get();

        $paths = [];

        foreach ($items as $media) {
            /** @var Media $media */
            $resolved = self::resolvePublicPath($media->path)
                ?? self::resolvePublicPath($media->getRawOriginal('url'));

            if ($resolved !== null && ! in_array($resolved, $paths, true)) {
                $paths[] = $resolved;
            }
        }

        return $paths;
    }

    /**
     * Значение состояния для ImageColumn (disk-relative encoded path или валидный внешний image URL).
     */
    public static function getRecordPreviewState(Model $record, string $collection): ?string
    {
        $localPaths = self::getRecordPublicPaths($record, $collection);

        if ($localPaths !== []) {
            return self::encodePath($localPaths[0]);
        }

        if (! method_exists($record, 'media')) {
            return null;
        }

        $first = $record->relationLoaded('media')
            ? $record->media->firstWhere('collection', $collection)
            : $record->media()->where('collection', $collection)->orderBy('sort_order')->first();

        if (! $first) {
            return null;
        }

        $rawUrl = $first->getRawOriginal('url');

        if (is_string($rawUrl) && preg_match('#^https?://#i', $rawUrl) && self::isImagePath($rawUrl)) {
            return $rawUrl;
        }

        return null;
    }

    /**
     * Колонка превью в таблице Filament, берущая картинку из таблицы `media`.
     */
    public static function column(
        string $name,
        string $collection = 'cover',
        string $label = 'Превью',
        bool $circular = false,
        int $size = 48,
    ): Tables\Columns\ImageColumn {
        $column = Tables\Columns\ImageColumn::make($name)
            ->label($label)
            ->disk('public')
            ->height($size)
            ->width($circular ? $size : (int) round($size * 1.35))
            ->getStateUsing(static fn (Model $record): ?string => self::getRecordPreviewState($record, $collection))
            ->checkFileExistence(false);

        if ($circular) {
            $column->circular();
        } else {
            $column->extraImgAttributes(['class' => 'rounded object-cover']);
        }

        return $column;
    }

    /**
     * Поле загрузки изображения с живым превью, синхронизируемое с полиморфной таблицей `media`.
     */
    public static function field(
        string $name,
        string $collection = 'cover',
        string $directory = 'cover',
        string $label = 'Изображение (превью)',
        bool $multiple = false,
    ): Forms\Components\FileUpload {
        $upload = Forms\Components\FileUpload::make($name)
            ->label($label)
            ->image()
            ->disk('public')
            ->directory($directory)
            ->visibility('public')
            ->imagePreviewHeight('200')
            ->openable()
            ->downloadable()
            ->dehydrated(false)
            ->getUploadedFileUsing(self::uploadedFileCallback())
            ->loadStateFromRelationshipsUsing(static function (Forms\Components\FileUpload $component, ?Model $record) use ($collection, $multiple): void {
                $current = $component->getState();
                if (
                    $current instanceof TemporaryUploadedFile
                    || (is_array($current) && collect($current)->contains(static fn (mixed $v): bool => $v instanceof TemporaryUploadedFile))
                ) {
                    return;
                }

                if (! $record?->exists) {
                    $component->state($multiple ? [] : null);

                    return;
                }

                $paths = self::getRecordPublicPaths($record, $collection);

                if ($multiple) {
                    $component->state($paths);
                } else {
                    $component->state($paths[0] ?? null);
                }
            })
            ->saveRelationshipsUsing(static function (Forms\Components\FileUpload $component, ?Model $record, mixed $state) use ($collection, $multiple): void {
                if (! $record?->exists) {
                    return;
                }

                self::syncRecordMedia($record, $collection, $state, $multiple);
            });

        if ($multiple) {
            $upload
                ->multiple()
                ->reorderable()
                ->appendFiles()
                ->panelLayout('grid');
        }

        return $upload;
    }

    /**
     * Синхронизирует загруженные файлы с таблицей `media` при сохранении записи.
     */
    public static function syncRecordMedia(Model $record, string $collection, mixed $state, bool $multiple = false): void
    {
        if (! method_exists($record, 'media')) {
            return;
        }

        $paths = array_values(array_filter(
            Arr::wrap($state),
            static fn (mixed $item): bool => is_string($item) && trim($item) !== ''
        ));

        $existingItems = $record->media()
            ->where('collection', $collection)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $existingResolved = [];
        $existingAlts = [];
        foreach ($existingItems as $item) {
            $resolved = self::resolvePublicPath($item->path)
                ?? self::resolvePublicPath($item->getRawOriginal('url'));

            if ($resolved !== null) {
                $existingResolved[] = $resolved;
                $existingAlts[$resolved] = $item->alt;
            }
        }

        if (! $multiple) {
            $newPath = $paths !== [] ? end($paths) : null;

            if ($newPath === null) {
                // Удаляем запись из media только если превью действительно было отображено и удалено пользователем
                if ($existingResolved !== []) {
                    $record->media()->where('collection', $collection)->delete();
                    $record->unsetRelation('media');
                }

                return;
            }

            if (isset($existingResolved[0]) && $existingResolved[0] === $newPath) {
                return;
            }

            $record->media()->where('collection', $collection)->delete();
            $record->media()->create([
                'collection' => $collection,
                'disk'       => 'public',
                'path'       => $newPath,
                'url'        => self::publicUrl($newPath),
                'alt'        => self::defaultAlt($record, $collection),
                'sort_order' => 0,
            ]);
            $record->unsetRelation('media');

            return;
        }

        // Коллекция с несколькими изображениями (например, галерея проекта)
        if ($paths === $existingResolved) {
            return;
        }

        if ($paths === [] && $existingResolved === []) {
            return;
        }

        $record->media()->where('collection', $collection)->delete();

        foreach ($paths as $index => $path) {
            $record->media()->create([
                'collection' => $collection,
                'disk'       => 'public',
                'path'       => $path,
                'url'        => self::publicUrl($path),
                'alt'        => $existingAlts[$path] ?? self::defaultAlt($record, $collection),
                'sort_order' => $index + 1,
            ]);
        }

        $record->unsetRelation('media');
    }

    private static function defaultAlt(Model $record, string $collection): string
    {
        return match ($collection) {
            'before'  => 'До',
            'after'   => 'После',
            'result'  => 'Результат',
            'gallery' => 'Фото ' . ((string) ($record->getAttribute('title') ?: 'проекта')),
            default   => (string) (
                $record->getAttribute('title')
                ?: $record->getAttribute('name')
                ?: $record->getAttribute('author_name')
                ?: ''
            ),
        };
    }
}
