<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    use SeedsMedia;

    public function run(): void
    {
        // ── Карта обложек для 10 корневых направлений ──
        $rootCovers = [
            'plasticheskaya-hirurgiya'       => 'gallery/services1.png',
            'kosmetologiya'                  => 'gallery/services2.png',
            'top-produkty'                   => 'gallery/services3.png',
            'dermatologiya'                  => 'gallery/services4.png',
            'otorinolaringologiya'           => 'gallery/services5.png',
            'lor-hirurgiya'                  => 'gallery/services6.png',
            'nevrologiya-i-refleksoterapiya' => 'gallery/services7.png',
            'esteticheskaya-ginekologiya'    => 'gallery/services8.png',
            'terapevticheskiy-priem'         => 'gallery/services9.png',
            'massazh'                        => 'gallery/services10.png',
        ];

        // ── Уровень 1: направления (сетка на странице «Услуги» и футер) ──
        $roots = [];
        $rootList = [
            'plasticheskaya-hirurgiya'          => 'Пластическая хирургия',
            'kosmetologiya'                     => 'Косметология',
            'top-produkty'                      => 'Топ-продукты',
            'dermatologiya'                     => 'Дерматология',
            'otorinolaringologiya'              => 'Оториноларингология',
            'lor-hirurgiya'                     => 'ЛОР-хирургия',
            'nevrologiya-i-refleksoterapiya'    => 'Неврология и рефлексотерапия',
            'esteticheskaya-ginekologiya'       => 'Эстетическая гинекология',
            'terapevticheskiy-priem'            => 'Терапевтический приём',
            'massazh'                           => 'Массаж',
        ];
        $i = 1;
        foreach ($rootList as $slug => $name) {
            $roots[$slug] = ServiceCategory::updateOrCreate(
                ['slug' => $slug],
                [
                    'name'       => $name,
                    'subtitle'   => 'Сохраняем молодость и подчеркиваем вашу естественную красоту',
                    'sort_order' => $i++,
                ],
            );
            $this->attachMedia($roots[$slug], 'cover', $rootCovers[$slug], $name);
        }

        // ── Уровень 2: группы пластической хирургии ──
        // техгруппа нужна для консультаций/прайса, в аккордеоне скрыта фильтром в компоненте.
        $groupList = [
            'plastika-litsa'                    => 'Пластика лица',
            'plastika-grudi'                    => 'Пластика груди',
            'plastika-tela'                     => 'Пластика тела',
            'intimnaya-plastika-dlya-muzhchin'  => 'Интимная пластика для мужчин',
            'kombo-operacii'                    => 'Комбо-операции',
            'drugie-uslugi'                     => 'Другие услуги',
            'plasticheskaya-i-esteticheskaya-hirurgiya' => 'Пластическая и эстетическая хирургия',
        ];
        $groups = [];
        $i = 1;
        foreach ($groupList as $slug => $name) {
            $groups[$slug] = ServiceCategory::updateOrCreate(
                ['slug' => $slug],
                [
                    'parent_id'   => $roots['plasticheskaya-hirurgiya']->id,
                    'name'        => $name,
                    'description' => 'С учётом сложившейся международной обстановки, новая модель организационной деятельности влечёт за собой процесс внедрения и модернизации соответствующих условий активизации.',
                    'sort_order'  => $i++,
                ],
            );
        }

        // Обложки групп пластической хирургии
        $groupCovers = [
            'plastika-litsa'                    => 'gallery/service11.png',
            'plastika-grudi'                    => 'gallery/service12.png',
            'plastika-tela'                     => 'gallery/service13.png',
            'intimnaya-plastika-dlya-muzhchin'  => 'gallery/service14.png',
            'kombo-operacii'                    => 'gallery/service15.png',
            'drugie-uslugi'                     => 'gallery/service16.png',
            'plasticheskaya-i-esteticheskaya-hirurgiya' => 'cover/room.png',
        ];
        foreach ($groupCovers as $gSlug => $gPath) {
            $this->attachMedia($groups[$gSlug], 'cover', $gPath, $groups[$gSlug]->name);
        }

        // ── Уровень 3: группы прайса с кодами МИС ──
        $priceGroups = [
            'mammoplastika'    => ['МАММОПЛАСТИКА',   '3.2.4', 'plastika-grudi'],
            'abdominoplastika' => ['АБДОМИНОПЛАСТИКА', '3.2.5', 'plastika-tela'],
            'bodilift'         => ['БОДИЛИФТ',         '3.2.6', 'plastika-tela'],
        ];
        $pg = [];
        foreach ($priceGroups as $slug => [$name, $mis, $parentSlug]) {
            $pg[$slug] = ServiceCategory::updateOrCreate(
                ['slug' => $slug],
                [
                    'parent_id' => $groups[$parentSlug]->id,
                    'name'      => $name,
                    'mis_code'  => $mis,
                ],
            );
        }

        // ── Консультации (крепятся к техгруппе, в карточки не попадают) ──
        $consults = [
            ['b01-057-003', 'B01.057.003', '3.2.1', 'Первичная консультация пластического хирурга', 'up_to', 40, 2500,
                'Прием пациента, сбор анамнеза заболевания, объективный осмотр, определение необходимого объема обследования, выбор концепции ведения и лечения пациента, разъяснение пациенту информации о заболевании, ведение медицинской документации.'],
            ['b01-057-004-povtornaya', 'B01.057.004', '3.2.2', 'Повторная консультация пластического хирурга', 'exact', 30, 2500,
                'Прием пациента, разъяснение пациенту информации о результатах обследования, объективный осмотр, краткое разъяснение пациенту информации о заболевании, возможных методах и этапах лечения.'],
            ['osmotr-posle-lecheniya', 'B01.057.004', '3.2.3', 'Осмотр после лечения в течение 1 месяца', 'up_to', 10, null, null],
        ];
        foreach ($consults as [$slug, $nom, $mis, $name, $dType, $dMin, $price, $desc]) {
            $groups['plasticheskaya-i-esteticheskaya-hirurgiya']->services()->updateOrCreate(
                ['slug' => $slug],
                [
                    'nomenclature_code' => $nom,
                    'mis_code'          => $mis,
                    'name'              => $name,
                    'description'       => $desc,
                    'duration_type'     => $dType,
                    'duration_min'      => $dMin,
                    'price'             => $price,
                    'sort_order'        => (int) substr($mis, -1),
                ],
            );
        }

        // ── Услуги прайса по категориям I/II/III (крепятся к уровню 3) ──
        $priced = [
            ['mammo-1', 'A16.20.085', '3.2.4.1', 'Увеличение молочной железы (Маммопластика) (без стоимости имплантов)', 120, [112000, 137000, 147000], 'mammoplastika'],
            ['mammo-2', 'A16.20.085', '3.2.4.2', 'Увеличение молочной железы (маммопластика) с коррекцией ареол (без стоимости имплантов)', 90, [127000, 147000, 162000], 'mammoplastika'],
            ['mammo-3', 'A16.20.085', '3.2.4.3', 'Редукционная (уменьшение) пластика молочной железы', 120, [140000, 165000, 240000], 'mammoplastika'],
            ['mammo-4', 'A16.20.085', '3.2.4.4', 'Вертикальная Т-образная мастопексия (подтяжка молочной железы)', 120, [130000, 150000, 200000], 'mammoplastika'],
            ['mammo-5', 'A16.20.085', '3.2.4.5', 'Подтяжка с увеличением молочных желез (без стоимости имплантов)', 120, [142000, 162000, 182000], 'mammoplastika'],
            ['abdomino-1', 'A16.30.008', '3.2.5.1', 'Мини-абдоминопластика', 90, [72000, 82000, 97000], 'abdominoplastika'],
            ['abdomino-2', 'A16.30.008', '3.2.5.2', 'Абдоминопластика', 120, [112000, 132000, 182000], 'abdominoplastika'],
            ['abdomino-3', 'A16.30.008', '3.2.5.3', 'Коррекция пупка (формирование пупка)', 60, [15000, 20000, 25000], 'abdominoplastika'],
            ['abdomino-4', 'A16.30.008', '3.2.5.4', 'Устранение грыжи белой линии живота', 60, [52000, 62000, 72000], 'abdominoplastika'],
            ['bodilift-1', 'A16.30.058', '3.2.6.1', 'Верхний бодилифт', 120, [182000, 212000, 262000], 'bodilift'],
            ['bodilift-2', 'A16.30.058', '3.2.6.2', 'Торсопластика (Бодилифт)', null, [262000, 362000, 412000], 'bodilift'],
        ];
        foreach ($priced as $n => [$slug, $nom, $mis, $name, $dMin, $prices, $groupSlug]) {
            $pg[$groupSlug]->services()->updateOrCreate(
                ['slug' => $slug],
                [
                    'nomenclature_code' => $nom,
                    'mis_code'          => $mis,
                    'name'              => $name,
                    'duration_type'     => 'exact',
                    'duration_min'      => $dMin,
                    'price_cat_1'       => $prices[0],
                    'price_cat_2'       => $prices[1],
                    'price_cat_3'       => $prices[2],
                    'sort_order'        => $n + 1,
                ],
            );
        }

        // ════════════════════════════════════════════════════════════
        //  ЕДИНСТВЕННЫЙ блок услуг для карточек аккордеона.
        //  delete() перед созданием гарантирует отсутствие дублей
        //  даже при повторном db:seed без fresh.
        // ════════════════════════════════════════════════════════════

        // Пластика лица
        $groups['plastika-litsa']->services()->delete();
        $face = [
            'blefaroplastika' => 'Блефаропластика',
            'rinoplastika'    => 'Ринопластика',
            'otoplastika'     => 'Отопластика',
            'feyslifting'     => 'Фэйслифтинг',
            'korrekciya-gub'  => 'Коррекция губ',
            'nitevoy-lifting' => 'Нитевой лифтинг',
        ];
        $fi = 1;
        foreach ($face as $slug => $name) {
            $groups['plastika-litsa']->services()->updateOrCreate(
                ['slug' => $slug],
                ['name' => $name, 'sort_order' => $fi++],
            );
        }

        // Остальные группы (slug с префиксом группы — уникальны, ни с чем не коллизируют)
        $groupServices = [
            'plastika-grudi' => [
                'grudi-mammoplastika' => 'Маммопластика',
                'grudi-lipofilling'   => 'Липофилинг',
            ],
            'plastika-tela' => [
                'tela-abdominoplastika' => 'Абдоминопластика',
                'tela-brahioplastika'   => 'Брахиопластика',
                'tela-liposakciya'      => 'Липосакция',
                'tela-podtyazhka-beder' => 'Подтяжка бедер',
            ],
            'intimnaya-plastika-dlya-muzhchin' => [
                'intim-muzhchin' => 'Интимная пластика для мужчин',
            ],
            'kombo-operacii' => [
                'kombo-1' => 'Маммопластика + Абдоминопластика + Лабиопластика',
                'kombo-2' => 'Маммопластика + Абдоминопластика',
                'kombo-3' => 'Маммопластика + Ринопластика',
                'kombo-4' => 'Маммопластика + Блефаропластика',
                'kombo-5' => 'Блефаропластика + Липосакция живота и талии + Липофилинг груди',
            ],
            'drugie-uslugi' => [
                'dr-obsledovanie'  => 'Обследование перед операцией',
                'dr-podgotovka'    => 'Подготовка к операции',
                'dr-pamyatka'      => 'Памятка пациенту перед операцией',
                'dr-reabilitaciya' => 'Программа реабилитации после операции',
                'dr-placenta'      => 'Плацентарные технологии',
            ],
        ];
        foreach ($groupServices as $groupSlug => $list) {
            $groups[$groupSlug]->services()->delete();
            $j = 1;
            foreach ($list as $slug => $name) {
                $groups[$groupSlug]->services()->updateOrCreate(
                    ['slug' => $slug],
                    ['name' => $name, 'sort_order' => $j++],
                );
            }
        }

        // ── Полный контент блефаропластики ──
        $blepharo = Service::where('slug', 'blefaroplastika')->first();
        $blepharo->update([
            'description' => 'Блефаропластика — пластическая операция, направленная на изменение и коррекцию формы век, а также разреза глаз.',
            'problems' => [
                'избыточная кожа в области верхних и нижних век',
                'жировые грыжи нижних век, так называемые «мешки» под глазами',
                'жировые грыжи верхних век',
                'синдром «усталого взгляда» («тяжелые» веки)',
                'опускание верхнего века',
                'изменение формы и разреза глаз',
            ],
            'preparation' => 'Первое, что необходимо сделать — попасть на прием к грамотному и высококвалифицированному хирургу. Он определит план и назначит необходимые анализы, даст рекомендации по предоперационной подготовке. В среднем этот период составляет 1 неделю, и уже после готовности анализов назначается день операции.',
            'execution' => 'Операция выполняется под местным наркозом. Он имеет ряд преимуществ перед общим. От местного наркоза проще и легче отходить, он не несет тяжелых последствий в отличии от общего. Стоимость операции существенно дешевле.',
        ]);

        // ── Кейсы «виды» и «результаты» ──
        $cases = [
            ['type',   'Верхняя блефаропластика',                       'Решение проблем нависание век, изменение разреза глаз.', 'gallery/compare1.png', 'gallery/compare2.png'],
            ['type',   'Нижняя трансконъюнктивальная блефаропластика', 'Избавление от морщин, мешков под глазами.',              'gallery/compare3.png', 'gallery/compare4.png'],
            ['result', null,                                            null,                                                     'gallery/compare5.png', 'gallery/compare6.png'],
            ['result', null,                                            null,                                                     'gallery/compare7.png', 'gallery/facelift.png'],
            ['result', null,                                            null,                                                     'gallery/facelift2.png', 'gallery/facelift2.png'],
            ['result', null,                                            null,                                                     'gallery/compare1.png', 'gallery/compare5.png'],
        ];
        foreach ($cases as $ci => [$kind, $title, $desc, $seed]) {
            $case = $blepharo->cases()->updateOrCreate(
                ['kind' => $kind, 'title' => $title, 'sort_order' => $ci + 1],
                ['description' => $desc],
            );
            $this->attachMedia($case, 'before', $before, 'До');
            $this->attachMedia($case, 'after',  $after,  'После');
        }
    }
}