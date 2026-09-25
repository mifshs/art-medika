<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Expert;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ExpertSeeder extends Seeder
{
    use SeedsMedia;

    public function run(): void
    {
        $i = 1;
        foreach ([
            'rukovodstvo' => 'Руководство',
            'poliklinicheskoe-otdelenie' => 'Поликлиническое отделение',
            'hirurgiya' => 'Хирургия',
            'esteticheskaya-ginekologiya' => 'Эстетическая гинекология',
            'kosmetologiya' => 'Косметология',
            'dermatologiya' => 'Дерматология',
            'lor-hirurgiya' => 'Лор-хирургия',
            'otorinolaringologiya' => 'Оториноларингология',
        ] as $slug => $name) {
            $departments[$slug] = Department::updateOrCreate(
                ['slug' => $slug],
                ['name' => $name, 'sort_order' => $i++],
            );
        }

        $experts = [
            'kuznecova-irina' => [
                'name' => 'Кузнецова Ирина Сергеевна',
                'department' => 'rukovodstvo',
                'position' => 'Директор ООО «МКЦ «Арт-Медика», врач-организатор здравоохранения, дерматовенеролог, косметолог. Руководитель, врач координатор российско-итальянского проекта «Доступная пластическая хирургия из Милана в России».',
            ],
            'busygina-anastasiya' => [
                'name' => 'Бусыгина Анастасия Петровна',
                'department' => 'rukovodstvo',
                'position' => 'Заведующая амбулаторно-поликлиническим отделением ООО «МКЦ«Арт-Медика». Врач дерматовенеролог, косметолог, трихолог, миколог.',
            ],
            'perevezencev-yuriy' => [
                'name' => 'Перевезенцев Юрий Юрьевич',
                'department' => 'hirurgiya',
                'position' => 'Заведующий стационарным отделением пластической хирургии ООО «МКЦ «Арт-Медика», врач пластический хирург, кандидат медицинских наук (к.м.н.), врач высшей категории.',
                'experience_since' => 1998,
                'operations_count' => 1200,
                'positive_percent' => 98,
            ],
            'sergeeva-evgeniya' => [
                'name' => 'Сергеева Евгения Александровна',
                'department' => 'rukovodstvo',
                'position' => 'Заместитель директора по медицинской части, заведующая стационарным отделением «Оториноларингологии и пластической хирургии», врач-эксперт по контролю качества медицинской помощи, врач оториноларинголог, фониатр ООО «МКЦ «Арт-Медика».',
                'experience_since' => 2002,
                'operations_count' => 34,
                'positive_percent' => 90,
                'activities' => [
                    'Диагностика, профилактика и консервативное лечение заболеваний лор-органов у детей и взрослых',
                    'Отоскопия', 'Риноскопия', 'Ларингоскопия',
                    'Ультразвуковое исследование пазух носа с применением европейского оборудования высокого класса безопасности',
                    'Аппаратное лечение: на аппарате «Кавитар», «ТОНЗИЛЛОР», «ФОТОХРОМ»',
                    'Лазеротерапия', 'Криотерапия',
                ],
            ],
            'dr-gaja' => [
                'name' => 'Dr.Gaja (Гаджимурад Хадисов)',
                'department' => 'hirurgiya',
                'position' => 'Практикующий пластический хирург, специалист по ринопластике и омолаживающим операциям лица.',
            ],
        ];

        $models = [];
        foreach ($experts as $slug => $data) {
            $models[$slug] = Expert::updateOrCreate(
                ['slug' => $slug],
                [
                    'department_id'    => $departments[$data['department']]->id,
                    'name'             => $data['name'],
                    'position'         => $data['position'],
                    'experience_since' => $data['experience_since'] ?? null,
                    'operations_count' => $data['operations_count'] ?? null,
                    'positive_percent' => $data['positive_percent'] ?? null,
                    'activities'       => $data['activities'] ?? null,
                ],
            );
            $this->attachMedia($models[$slug], 'avatar', "expert-$slug", $data['name'], '600/800');
        }

        // ── Образование и аккредитация Сергеевой (экран карточки врача) ──
        $sergeeva = $models['sergeeva-evgeniya'];

        foreach ([
            ['Высшее образование', 'Челябинская государственная медицинская академия', 2002, 'Врач, педиатрия'],
            ['Интернатура', 'Челябинская государственная медицинская академия Министерства здравоохранения Российской Федерации', 2003, 'Педиатрия'],
            ['Профессиональная переподготовка', 'Челябинская государственная медицинская академия Министерства здравоохранения Российской Федерации', 2003, 'Оториноларингология'],
            ['Профессиональная переподготовка', 'Челябинская государственная медицинская академия Министерства здравоохранения и социального развития Российской Федерации', 2012, 'Организация здравоохранения и общественное здоровье'],
            ['Сертификационный цикл', '«Современный инновационный университет»', 2020, 'Оториноларингология'],
            ['Сертификационный цикл', '«Современный инновационный университет»', 2020, 'Организация здравоохранения и общественное здоровье'],
            ['Повышение квалификации', '«Центр профессионального образования»', 2025, 'Оториноларингология'],
        ] as $i => [$level, $org, $year, $qual]) {
            $sergeeva->educations()->updateOrCreate(
                ['issued_year' => $year, 'qualification' => $qual],
                ['level' => $level, 'organization' => $org, 'sort_order' => $i + 1],
            );
        }

        foreach ([
            ['Сертификат', 'Оториноларингология', 'Врач-оториноларинголог', '2020-11-17', '2025-11-17', 'Пролонгирован по приказу до 31.12.2026'],
            ['Сертификат', 'Организация здравоохранения и общественное здоровье', 'Специалист в области организации здравоохранения и общественного здоровья', '2020-10-20', '2025-10-20', 'Пролонгирован по приказу до 31.12.2026'],
        ] as $i => [$type, $spec, $pos, $issued, $expires, $note]) {
            $sergeeva->accreditations()->updateOrCreate(
                ['specialty' => $spec],
                [
                    'doc_type' => $type, 'position' => $pos,
                    'issued_at' => $issued, 'expires_at' => $expires,
                    'note' => $note, 'sort_order' => $i + 1,
                ],
            );
        }

        // ── Врачи ↔ услуги (блок «Врачи, проводящие процедуру») ──
        $models['perevezencev-yuriy']->services()->syncWithoutDetaching(
            Service::whereIn('slug', ['blefaroplastika', 'mammo-1', 'mammo-3'])->pluck('id'),
        );
        $models['dr-gaja']->services()->syncWithoutDetaching(
            Service::whereIn('slug', ['rinoplastika', 'nitevoy-lifting', 'feyslifting'])->pluck('id'),
        );
    }
}