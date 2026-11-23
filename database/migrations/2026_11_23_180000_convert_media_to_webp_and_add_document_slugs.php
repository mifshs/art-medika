<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Переводим записи media с .png на оптимизированные .webp (если файл существует на диске)
        $mediaRows = DB::table('media')->get();
        foreach ($mediaRows as $row) {
            $path = ltrim((string) $row->path, '/');
            if ($path !== '' && preg_match('/\.png$/i', $path)) {
                $webpPath = preg_replace('/\.png$/i', '.webp', $path);
                if ($webpPath !== null && Storage::disk('public')->exists($webpPath)) {
                    $webpUrl = '/storage/' . implode('/', array_map('rawurlencode', explode('/', $webpPath)));
                    DB::table('media')->where('id', $row->id)->update([
                        'disk'       => 'public',
                        'path'       => $webpPath,
                        'url'        => $webpUrl,
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        // 2. Обновляем сохранённые в settings пути к картинкам (.png -> .webp)
        foreach (['hero_image', 'about_image', 'work_image', 'logo'] as $key) {
            $setting = DB::table('settings')->where('key', $key)->first();
            if ($setting && is_string($setting->value) && preg_match('/\.png(["\s]|$)/i', $setting->value)) {
                $updated = preg_replace('/\.png\b/i', '.webp', $setting->value);
                if ($updated !== null && $updated !== $setting->value) {
                    DB::table('settings')->where('key', $key)->update(['value' => $updated]);
                }
            }
        }

        $socialIconsSetting = DB::table('settings')->where('key', 'social_icons')->first();
        if ($socialIconsSetting && is_string($socialIconsSetting->value)) {
            $updated = preg_replace('/\.png\b/i', '.webp', $socialIconsSetting->value);
            if ($updated !== null && $updated !== $socialIconsSetting->value) {
                DB::table('settings')->where('key', 'social_icons')->update(['value' => $updated]);
            }
        }

        // 3. Добавляем ЧПУ slug для документов и заполняем существующие записи
        if (! Schema::hasColumn('documents', 'slug')) {
            Schema::table('documents', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('title');
            });
        }

        $usedSlugs = DB::table('documents')
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->pluck('slug')
            ->flip()
            ->all();

        $docs = DB::table('documents')->orderBy('id')->get();
        foreach ($docs as $doc) {
            if (! empty($doc->slug)) {
                continue;
            }
            $base = Str::slug((string) $doc->title) ?: ('document-' . $doc->id);
            $slug = $base;
            $n = 2;
            while (isset($usedSlugs[$slug])) {
                $slug = $base . '-' . $n++;
            }
            $usedSlugs[$slug] = true;

            DB::table('documents')->where('id', $doc->id)->update(['slug' => $slug]);
        }

        // Обновляем file_url документов с .png на .webp, если файл в public-диске уже конвертирован
        foreach (DB::table('documents')->where('file_url', 'like', '%.png')->get() as $doc) {
            $relative = preg_replace('#^/?storage/#', '', ltrim((string) $doc->file_url, '/'));
            $webpRel  = preg_replace('/\.png$/i', '.webp', (string) $relative);
            if ($webpRel !== null && Storage::disk('public')->exists($webpRel)) {
                $newUrl = preg_replace('/\.png$/i', '.webp', (string) $doc->file_url);
                DB::table('documents')->where('id', $doc->id)->update(['file_url' => $newUrl]);
            }
        }

        $hasUnique = collect(Schema::getIndexes('documents'))->contains(
            fn (array $idx): bool => ($idx['unique'] ?? false) && in_array('slug', $idx['columns'] ?? [], true)
        );
        if (! $hasUnique) {
            Schema::table('documents', function (Blueprint $table) {
                $table->unique('slug');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('documents', 'slug')) {
            Schema::table('documents', function (Blueprint $table) {
                $table->dropUnique(['slug']);
                $table->dropColumn('slug');
            });
        }
    }
};
