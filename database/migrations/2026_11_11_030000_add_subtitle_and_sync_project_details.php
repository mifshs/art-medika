<?php

use App\Models\Project;
use App\Models\ProjectPartner;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('projects', 'subtitle')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->string('subtitle')->nullable()->after('title');
            });
        }

        // Обновляем подзаголовки
        Project::where('slug', 'krasota-v-tebe')->update([
            'subtitle' => 'Социальный проект-преображение',
            'description' => '«Красота в тебе» — социальный проект для жителей Челябинской области, которые хотят преобразиться, доверив свое преображение лучшим специалистам в своей сфере.',
            'mission' => 'Миссия проекта — показать, как внешние и внутренние перемены отразятся на жизни человека, дадут импульс, который еще и вдохновит других.',
        ]);

        Project::where('slug', 'dostupnaya-plasticheskaya-hirurgiya-iz-milana')->update([
            'subtitle' => 'Российско-Итальянский проект',
        ]);

        Project::where('slug', 'evropeyskaya-blefaroplastika-2025')->update([
            'subtitle' => 'Комплексная программа омоложения',
        ]);

        // Обновляем партнеров для Проекта 1
        $project1 = Project::where('slug', 'krasota-v-tebe')->first();
        if ($project1) {
            $partners = [
                ['name' => 'Dr. Gaja', 'role' => 'Итальянский пластический хирург'],
                ['name' => 'Ирина Кузнецова', 'role' => 'Эксперт по красивой медицине'],
                ['name' => 'Арт-Медика', 'role' => 'Медицинский центр'],
                ['name' => 'Гранд Успех', 'role' => 'Стоматологическая клиника'],
                ['name' => 'Юлия Капралова', 'role' => 'Эксперт по стилю'],
                ['name' => 'bit_fashion', 'role' => 'Модное пространство'],
                ['name' => 'Людмила Шаяхметова', 'role' => 'Психолог'],
                ['name' => 'Анна Криволапова', 'role' => 'Руководитель клуба «Красота в тебе»'],
                ['name' => 'Елена Исакова', 'role' => 'Ведущая и преподаватель по актерскому мастерству'],
                ['name' => 'Ульяна Гаитова', 'role' => 'Эксперт по коммуникациям'],
                ['name' => 'Анна Заозерова', 'role' => 'Визажист'],
                ['name' => 'Ирина Никулина', 'role' => 'Эксперт по постановке целей'],
            ];

            foreach ($partners as $i => $item) {
                ProjectPartner::updateOrCreate(
                    [
                        'project_id' => $project1->id,
                        'name' => $item['name'],
                    ],
                    [
                        'role' => $item['role'],
                        'sort_order' => $i + 1,
                    ]
                );
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('projects', 'subtitle')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('subtitle');
            });
        }
    }
};
