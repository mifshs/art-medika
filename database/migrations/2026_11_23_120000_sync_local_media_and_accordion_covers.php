<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Переводим все оставшиеся CDN / github записи в таблице media на локальное хранилище /storage
        $mediaRows = DB::table('media')->get();
        foreach ($mediaRows as $row) {
            if (in_array($row->path, ['review-0', 'review-1'], true)) {
                DB::table('media')->where('id', $row->id)->delete();
                continue;
            }

            $needsUrlUpdate = empty($row->url)
                || str_contains((string) $row->url, 'cdn.jsdelivr.net')
                || str_contains((string) $row->url, 'raw.githubusercontent.com')
                || str_contains((string) $row->url, 'picsum.photos');

            if ($row->disk === 'github' || $needsUrlUpdate) {
                $cleanPath = ltrim((string) $row->path, '/');
                $localUrl  = '/storage/' . implode('/', array_map('rawurlencode', explode('/', $cleanPath)));

                DB::table('media')->where('id', $row->id)->update([
                    'disk'       => 'public',
                    'url'        => $localUrl,
                    'updated_at' => now(),
                ]);
            }
        }

        // 2. Исправляем перепутанные обложки косметологии (Аппаратная косметология и Fotona SP Dynamis)
        $cosmoFix = [
            'apparatnaya-kosmetologiya'           => 'cover/view-from-rejuvenation-beautiful-woman-enjoying-cosmetology-procedures-beauty-salon-dermatology-hands-blue-glows-healthcare-therapy-botox 1.png',
            'lazernaya-sistema-fotona-sp-dynamis' => 'cover/laser-system.png',
        ];
        foreach ($cosmoFix as $slug => $path) {
            $cat = DB::table('service_categories')->where('slug', $slug)->first();
            if ($cat) {
                DB::table('media')
                    ->where('model_type', 'App\\Models\\ServiceCategory')
                    ->where('model_id', $cat->id)
                    ->where('collection', 'cover')
                    ->delete();

                DB::table('media')->insert([
                    'model_type' => 'App\\Models\\ServiceCategory',
                    'model_id'   => $cat->id,
                    'collection' => 'cover',
                    'disk'       => 'public',
                    'path'       => $path,
                    'url'        => '/storage/' . implode('/', array_map('rawurlencode', explode('/', $path))),
                    'alt'        => $cat->name,
                    'sort_order' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // 3. Добавляем ч/б обложки для аккордеона на главной странице (коллекция «accordion»),
        //    сохраняя цветные cover-обложки для страницы /uslugi/plasticheskaya-hirurgiya
        $accordionCovers = [
            'plastika-litsa'                   => 'cover/portrait-woman-with-dysmorphia 1.png',
            'plastika-grudi'                   => 'cover/naked-woman-covering-herself1 1.png',
            'plastika-tela'                    => 'cover/fit-woman-wearing-white-lingerie 1.png',
            'intimnaya-plastika-dlya-muzhchin' => 'cover/image 34.png',
            'drugie-uslugi'                    => 'cover/attractive-woman-apply-facial-cream-anti-aging-product1 2.png',
        ];
        foreach ($accordionCovers as $slug => $path) {
            $cat = DB::table('service_categories')->where('slug', $slug)->first();
            if ($cat) {
                DB::table('media')
                    ->where('model_type', 'App\\Models\\ServiceCategory')
                    ->where('model_id', $cat->id)
                    ->where('collection', 'accordion')
                    ->delete();

                DB::table('media')->insert([
                    'model_type' => 'App\\Models\\ServiceCategory',
                    'model_id'   => $cat->id,
                    'collection' => 'accordion',
                    'disk'       => 'public',
                    'path'       => $path,
                    'url'        => '/storage/' . implode('/', array_map('rawurlencode', explode('/', $path))),
                    'alt'        => $cat->name,
                    'sort_order' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // «Комбо-операции» в аккордеоне без изображения (как на макете)
        $kombo = DB::table('service_categories')->where('slug', 'kombo-operacii')->first();
        if ($kombo) {
            DB::table('media')
                ->where('model_type', 'App\\Models\\ServiceCategory')
                ->where('model_id', $kombo->id)
                ->where('collection', 'accordion')
                ->delete();
        }

        // 4. Привязываем обложки родительских направлений к 8 дочерним категориям *-osnovnoe
        $collapsed = [
            'top-produkty',
            'dermatologiya',
            'otorinolaringologiya',
            'lor-hirurgiya',
            'nevrologiya-i-refleksoterapiya',
            'esteticheskaya-ginekologiya',
            'terapevticheskiy-priem',
            'massazh',
        ];
        foreach ($collapsed as $rootSlug) {
            $root  = DB::table('service_categories')->where('slug', $rootSlug)->first();
            $child = DB::table('service_categories')->where('slug', $rootSlug . '-osnovnoe')->first();
            if (! $root || ! $child) {
                continue;
            }

            $childHasCover = DB::table('media')
                ->where('model_type', 'App\\Models\\ServiceCategory')
                ->where('model_id', $child->id)
                ->where('collection', 'cover')
                ->exists();

            if (! $childHasCover) {
                $rootCover = DB::table('media')
                    ->where('model_type', 'App\\Models\\ServiceCategory')
                    ->where('model_id', $root->id)
                    ->where('collection', 'cover')
                    ->first();

                if ($rootCover) {
                    DB::table('media')->insert([
                        'model_type' => 'App\\Models\\ServiceCategory',
                        'model_id'   => $child->id,
                        'collection' => 'cover',
                        'disk'       => 'public',
                        'path'       => $rootCover->path,
                        'url'        => '/storage/' . implode('/', array_map('rawurlencode', explode('/', ltrim((string) $rootCover->path, '/')))),
                        'alt'        => $root->name,
                        'sort_order' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        // 5. Нормализуем пути social_icons в настройках (кодируем пробелы как %20)
        $socialIconsSetting = DB::table('settings')->where('key', 'social_icons')->first();
        if ($socialIconsSetting) {
            DB::table('settings')->where('key', 'social_icons')->update([
                'value' => json_encode([
                    'vk'       => '/storage/docs/Vk_logo.png',
                    'telegram' => '/storage/docs/Telegram_logo%201.png',
                    'max'      => '/storage/docs/max-messenger-sign-logo%201.png',
                ], JSON_UNESCAPED_UNICODE),
            ]);
        }
    }

    public function down(): void
    {
        // Миграция синхронизации локальных медиафайлов не требует отката данных
    }
};
