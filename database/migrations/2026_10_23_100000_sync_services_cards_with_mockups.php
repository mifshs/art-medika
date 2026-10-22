<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Приводит карточки страницы «Услуги» к макетам:
 *  - десктопный порядок направлений и обложки (image-6.png / Услуги.png);
 *  - уникальные подписи мобильного макета (image-7.png).
 *
 * Предыдущая миграция 2026_10_21_120000 выполнялась до сидеров,
 * поэтому на существующей базе её данные не применились.
 */
return new class extends Migration
{
    private const ORDER = [
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

    /** Подписи под карточками в мобильном макете (image-7.png) */
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

    /** Файл обложки → направление, которому он соответствует на макете */
    private const COVER_MAP = [
        'gallery/services1.png'  => 'kosmetologiya',
        'gallery/services2.png'  => 'top-produkty',
        'gallery/services4.png'  => 'otorinolaringologiya',
        'gallery/services3.png'  => 'lor-hirurgiya',
        'gallery/services7.png'  => 'esteticheskaya-ginekologiya',
        'gallery/services5.png'  => 'dermatologiya',
        'gallery/services8.png'  => 'massazh',
        'gallery/services6.png'  => 'plasticheskaya-hirurgiya',
        'gallery/services9.png'  => 'nevrologiya-i-refleksoterapiya',
        'gallery/services10.png' => 'terapevticheskiy-priem',
    ];

    /** Исходный порядок сидера — для отката */
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

    /** Исходная привязка обложек сидера — для отката */
    private const INITIAL_COVERS = [
        'gallery/services1.png'  => 'plasticheskaya-hirurgiya',
        'gallery/services2.png'  => 'kosmetologiya',
        'gallery/services3.png'  => 'top-produkty',
        'gallery/services4.png'  => 'dermatologiya',
        'gallery/services5.png'  => 'otorinolaringologiya',
        'gallery/services6.png'  => 'lor-hirurgiya',
        'gallery/services7.png'  => 'nevrologiya-i-refleksoterapiya',
        'gallery/services8.png'  => 'esteticheskaya-ginekologiya',
        'gallery/services9.png'  => 'terapevticheskiy-priem',
        'gallery/services10.png' => 'massazh',
    ];

    public function up(): void
    {
        $type = 'App\\Models\\ServiceCategory';

        foreach (self::ORDER as $slug => $sort) {
            DB::table('service_categories')
                ->where('slug', $slug)
                ->whereNull('parent_id')
                ->update(['sort_order' => $sort, 'updated_at' => now()]);
        }

        foreach (self::MOBILE_SUBTITLES as $slug => $text) {
            DB::table('service_categories')
                ->where('slug', $slug)
                ->whereNull('parent_id')
                ->update(['description' => $text, 'updated_at' => now()]);
        }

        foreach (self::COVER_MAP as $path => $slug) {
            $category = DB::table('service_categories')
                ->where('slug', $slug)
                ->whereNull('parent_id')
                ->first(['id', 'name']);

            if (!$category) {
                continue;
            }

            DB::table('media')
                ->where('model_type', $type)
                ->where('collection', 'cover')
                ->where('path', $path)
                ->update([
                    'model_id'   => $category->id,
                    'alt'        => $category->name,
                    'updated_at' => now(),
                ]);
        }
    }

    public function down(): void
    {
        $type = 'App\\Models\\ServiceCategory';

        foreach (self::INITIAL_ORDER as $slug => $sort) {
            DB::table('service_categories')
                ->where('slug', $slug)
                ->whereNull('parent_id')
                ->update(['sort_order' => $sort, 'updated_at' => now()]);
        }

        DB::table('service_categories')
            ->whereNull('parent_id')
            ->whereIn('slug', array_keys(self::MOBILE_SUBTITLES))
            ->update(['description' => null, 'updated_at' => now()]);

        foreach (self::INITIAL_COVERS as $path => $slug) {
            $category = DB::table('service_categories')
                ->where('slug', $slug)
                ->whereNull('parent_id')
                ->first(['id', 'name']);

            if (!$category) {
                continue;
            }

            DB::table('media')
                ->where('model_type', $type)
                ->where('collection', 'cover')
                ->where('path', $path)
                ->update([
                    'model_id'   => $category->id,
                    'alt'        => $category->name,
                    'updated_at' => now(),
                ]);
        }
    }
};
