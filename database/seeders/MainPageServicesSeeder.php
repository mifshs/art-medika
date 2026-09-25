<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MainPageServicesSeeder extends Seeder
{
    use SeedsMedia;

    public function run(): void
    {
        // ── 1. Развёрнутые карточки пластической хирургии: ссылки = услуги-заглушки ──
        $groupServices = [
            'plastika-grudi' => [
                'Липофилинг', // «Маммопластика» — уже существующая категория 3 уровня, не дублируем
            ],
            'plastika-tela' => [
                'Брахиопластика', 'Липосакция', 'Подтяжка бедер', // «Абдоминопластика» — существующая категория
            ],
            'intimnaya-plastika-dlya-muzhchin' => [
                'Интимная пластика для мужчин',
            ],
            'kombo-operacii' => [
                'Маммопластика + Абдоминопластика + Лабиопластика',
                'Маммопластика + Абдоминопластика',
                'Маммопластика + Ринопластика',
                'Маммопластика + Блефаропластика',
                'Блефаропластика + Липосакция живота и талии + Липофилинг груди',
            ],
            'drugie-uslugi' => [
                'Обследование перед операцией',
                'Подготовка к операции',
                'Памятка пациенту перед операцией',
                'Программа реабилитации после операции',
                'Плацентарные технологии',
            ],
        ];

        foreach ($groupServices as $groupSlug => $services) {
            $group = ServiceCategory::where('slug', $groupSlug)->firstOrFail();
            foreach ($services as $i => $name) {
                $group->services()->updateOrCreate(
                    ['slug' => $groupSlug . '-' . Str::slug($name)],
                    ['name' => $name, 'sort_order' => $i + 1],
                );
            }
        }

        // ── 2. Косметология: новые карточки-группы + их ссылки ──
        $cosmetology = ServiceCategory::where('slug', 'kosmetologiya')->firstOrFail();

        $cosmoGroups = [
            'apparatnaya-kosmetologiya' => ['Аппаратная косметология', [
                'Лазерная коррекция дефектов кожи', 'Лазерная шлифовка', 'Фотоэпиляция',
            ]],
            'inekcionnaya-kosmetologiya' => ['Инъекционная косметология', [
                'Ботокс/Диспорт', 'Биоревитализация', 'Мезотерапия', 'Контурная пластика', 'Плацентарные технологии',
            ]],
            'uhody-za-licom-i-telom' => ['Уходы за лицом и телом', [
                'Чистка', 'Уходовые комплексы', 'Пилинг', 'Массаж лица и тела',
            ]],
            'lazernaya-sistema-fotona-sp-dynamis' => ['Лазерная система Fotona SP Dynamis', [
                'Лазерная система Fotona SP Dynamis',
            ]],
            'nitevoy-lifting-kosmetologiya' => ['Нитевой лифтинг', [
                'Итальянский нитевой лифтинг Happy lift', 'Нитевые технологии Gruzdev Trend',
            ]],
        ];
        $i = 1;
        foreach ($cosmoGroups as $slug => [$name, $services]) {
            $group = ServiceCategory::updateOrCreate(
                ['slug' => $slug],
                [
                    'parent_id'  => $cosmetology->id,
                    'name'       => $name,
                    'sort_order' => $i++,
                ],
            );
            $this->attachMedia($group, 'cover', "cat-$slug", $name);

            foreach ($services as $n => $serviceName) {
                $group->services()->updateOrCreate(
                    ['slug' => $slug . '-' . Str::slug($serviceName)],
                    ['name' => $serviceName, 'sort_order' => $n + 1],
                );
            }
        }

        // ── 3. Свёрнутые направления: заголовок уже есть, добавляем заглушки внутрь ──
        $collapsed = [
            'top-produkty', 'dermatologiya', 'otorinolaringologiya', 'lor-hirurgiya',
            'nevrologiya-i-refleksoterapiya', 'esteticheskaya-ginekologiya',
            'terapevticheskiy-priem', 'massazh',
        ];

        foreach ($collapsed as $rootSlug) {
            $root = ServiceCategory::where('slug', $rootSlug)->firstOrFail();

            $child = ServiceCategory::updateOrCreate(
                ['slug' => $rootSlug . '-osnovnoe'],
                [
                    'parent_id'  => $root->id,
                    'name'       => $root->name,   // заглушка: имя как у направления
                    'sort_order' => 1,
                ],
            );

            $child->services()->updateOrCreate(
                ['slug' => $rootSlug . '-osnovnoe-usluga'],
                ['name' => $root->name, 'sort_order' => 1],
            );
        }
    }
}