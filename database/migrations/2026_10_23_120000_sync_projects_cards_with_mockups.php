<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Привязываем правильную обложку cover/project1.png к Проекту 1 (Социальный проект «Красота в тебе»)
        DB::table('media')
            ->where('model_type', 'App\\Models\\Project')
            ->where('model_id', 1)
            ->where('collection', 'cover')
            ->update([
                'path' => 'cover/project1.png',
                'url'  => 'https://cdn.jsdelivr.net/gh/mifshs/art-medika-media@main/cover/project1.png',
                'alt'  => 'Социальный проект «Красота в тебе»',
                'updated_at' => now(),
            ]);

        // 2. Обновляем описания проектов в точности по макету
        DB::table('projects')
            ->where('slug', 'krasota-v-tebe')
            ->update([
                'excerpt' => '«Красота в тебе» — социальный проект для жителей Челябинской области, которые хотят преобразиться, доверив свое преображение лучшим специалистам в своей сфере. Проект имеет международный статус, так как в проекте участвует итальянский пластический хирург Dr. Ivan Gaja.',
                'published_at' => '2025-04-07',
                'is_active' => true,
                'updated_at' => now(),
            ]);

        DB::table('projects')
            ->where('slug', 'dostupnaya-plasticheskaya-hirurgiya-iz-milana')
            ->update([
                'excerpt' => 'В Челябинске на протяжении многих лет успешно реализуется Российско-Итальянский проект «Доступная пластическая хирургия из Милана в России». Сертифицированный пластический хирург с правом оперирования на территории нашей страны Dr.Gaja внедряет авторские методики: нитевой лифтинг, мезоботокс (...',
                'published_at' => '2025-04-07',
                'is_active' => true,
                'updated_at' => now(),
            ]);

        DB::table('projects')
            ->where('slug', 'evropeyskaya-blefaroplastika-2025')
            ->update([
                'excerpt' => '«Европейская блефаропластика» - комплексная программа омоложения верхнего века, в виде хирургической пластики верхнего века и 3-х сеансов реабилитации тканей на европейской лазерной системе Fotona. Комплексная программа осуществляется пластическим хирургом, прошедшим специализацию у членов Евр...',
                'published_at' => '2025-04-07',
                'is_active' => true,
                'updated_at' => now(),
            ]);
    }

    public function down(): void
    {
        DB::table('media')
            ->where('model_type', 'App\\Models\\Project')
            ->where('model_id', 1)
            ->where('collection', 'cover')
            ->update([
                'path' => 'cover/concert.png',
                'url'  => 'https://cdn.jsdelivr.net/gh/mifshs/art-medika-media@main/cover/concert.png',
                'alt'  => 'Красота в тебе',
                'updated_at' => now(),
            ]);
    }
};
