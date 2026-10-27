<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Синхронизация страницы «Услуги» с макетами:
 *  1) порядок корневых направлений как на десктопном макете;
 *  2) обложки (cover) корневых направлений — файлы CDN services1..10.png,
 *     переклеенные на те категории, чьи изображения они по факту содержат;
 *  3) уникальные подзаголовки направлений для мобильного макета (description).
 */
return new class extends Migration
{
    /** Десктопный порядок макета «Услуги-2» */
    private const DESKTOP_ORDER = [
        'kosmetologiya'                  => 1,
        'top-produkty'                   => 2,
        'otorinolaringologiya'           => 3,
        'lor-hirurgiya'                  => 4,
        'esteticheskaya-ginekologiya'    => 5,
        'dermatologiya'                  => 6,
        'massazh'                        => 7,
        'plasticheskaya-hirurgiya'       => 8,
        'nevrologiya-i-refleksoterapiya' => 9,
        'terapevticheskiy-priem'         => 10,
    ];

    /** Прежний порядок (для down) */
    private const INITIAL_ORDER = [
        'plasticheskaya-hirurgiya'       => 1,
        'kosmetologiya'                  => 2,
        'top-produkty'                   => 3,
        'dermatologiya'                  => 4,
        'otorinolaringologiya'           => 5,
        'lor-hirurgiya'                  => 6,
        'nevrologiya-i-refleksoterapiya' => 7,
        'esteticheskaya-ginekologiya'    => 8,
        'terapevticheskiy-priem'         => 9,
        'massazh'                        => 10,
    ];

    /** Уникальные подзаголовки мобильного макета */
    private const MOBILE_SUBTITLES = [
        'kosmetologiya'                  => 'Сохраняем молодость и подчеркиваем вашу естественную красоту.',
        'otorinolaringologiya'           => 'Экспертная диагностика и лечение заболеваний лор-органов.',
        'lor-hirurgiya'                  => 'Профессиональная забота о здоровье уха, горла и носа',
        'massazh'                        => 'Оздоровление организма и глубокое расслабление через тело.',
        'esteticheskaya-ginekologiya'    => 'Деликатные решения для женского здоровья и уверенности.',
        'dermatologiya'                  => 'Экспертные решения для здоровья и безупречного вида вашей кожи.',
        'top-produkty'                   => 'Селективный уход для поддержания красоты в домашних условиях.',
        'plasticheskaya-hirurgiya'       => 'Эстетическая коррекция для гармонии вашей внешности.',
        'nevrologiya-i-refleksoterapiya' => 'Восстановление функций нервной системы методами классической и восточной медицины.',
        'terapevticheskiy-priem'         => 'Профессиональная оценка состояния организма и эффективное лечение.',
    ];

    /** Файл CDN → слаг направления, чьё изображение в этом файле (сверено с содержимым файлов) */
    private const COVER_MAP = [
        'services1'  => 'kosmetologiya',
        'services2'  => 'top-produkty',
        'services3'  => 'lor-hirurgiya',
        'services4'  => 'otorinolaringologiya',
        'services5'  => 'dermatologiya',
        'services6'  => 'plasticheskaya-hirurgiya',
        'services7'  => 'esteticheskaya-ginekologiya',
        'services8'  => 'massazh',
        'services9'  => 'nevrologiya-i-refleksoterapiya',
        'services10' => 'terapevticheskiy-priem',
    ];

    public function up(): void
    {
        $type = DB::table('media')
            ->where('collection', 'gallery')
            ->where('path', 'gallery/services1.png')
            ->value('model_type');

        if (!$type) {
            $type = DB::table('media')->where('collection', 'cover')->value('model_type') ?: 'App\Models\ServiceCategory';
        }

        // 1. Порядок направлений
        foreach (self::DESKTOP_ORDER as $slug => $sort) {
            DB::table('service_categories')
                ->where('slug', $slug)
                ->whereNull('parent_id')
                ->update(['sort_order' => $sort, 'updated_at' => now()]);
        }

        // 2. Уникальные мобильные подзаголовки
        foreach (self::MOBILE_SUBTITLES as $slug => $text) {
            DB::table('service_categories')
                ->where('slug', $slug)
                ->whereNull('parent_id')
                ->update(['description' => $text, 'updated_at' => now()]);
        }

        // 3. Обложки корневых направлений (дублируем строки gallery как cover)
        foreach (self::COVER_MAP as $file => $slug) {
            $category = DB::table('service_categories')
                ->where('slug', $slug)
                ->whereNull('parent_id')
                ->first(['id', 'name']);
            $categoryId = $category->id ?? null;
            if (!$categoryId) {
                continue;
            }

            $exists = DB::table('media')
                ->where('collection', 'cover')
                ->where('model_type', $type)
                ->where('path', 'gallery/' . $file . '.png')
                ->exists();
            if ($exists) {
                DB::table('media')
                    ->where('collection', 'cover')
                    ->where('model_type', $type)
                    ->where('path', 'gallery/' . $file . '.png')
                    ->update([
                        'model_id'   => $categoryId,
                        'alt'        => $category->name,
                        'updated_at' => now(),
                    ]);
                continue;
            }

            $src = DB::table('media')
                ->where('collection', 'gallery')
                ->where('model_type', $type)
                ->where('path', 'gallery/' . $file . '.png')
                ->first();

            if (!$src) {
                continue;
            }

            DB::table('media')->insert([
                'model_type' => $src->model_type,
                'model_id'   => $categoryId,
                'collection' => 'cover',
                'disk'       => $src->disk,
                'path'       => $src->path,
                'url'        => $src->url,
                'alt'        => 'Направление клиники Арт-Медика',
                'sort_order' => 0,
                'meta'       => $src->meta,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        $type = DB::table('media')
            ->where('collection', 'gallery')
            ->where('path', 'gallery/services1.png')
            ->value('model_type') ?: 'App\Models\ServiceCategory';

        foreach (self::INITIAL_ORDER as $slug => $sort) {
            DB::table('service_categories')
                ->where('slug', $slug)
                ->whereNull('parent_id')
                ->update(['sort_order' => $sort, 'updated_at' => now()]);
        }

        foreach (array_keys(self::MOBILE_SUBTITLES) as $slug) {
            DB::table('service_categories')
                ->where('slug', $slug)
                ->whereNull('parent_id')
                ->update(['description' => null, 'updated_at' => now()]);
        }

        /** Только вставленные нами строки cover: исходные cover-строки
            (cover/room.png, cover/laser-system.png и т.д.) имеют другие пути. */
        DB::table('media')
            ->where('collection', 'cover')
            ->where('model_type', $type)
            ->whereIn('path', array_map(fn (string $f): string => 'gallery/' . $f . '.png', array_keys(self::COVER_MAP)))
            ->delete();
    }
};
