<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Contracts\View\View;

class PriceController extends Controller
{
    /** Страница «Цены на услуги»: направления из БД с раскрывающимися прайс-таблицами */
    public function index(): View
    {
        $servicesByCat = Service::query()
            ->active()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->groupBy('service_category_id');

        $categories = ServiceCategory::query()
            ->active()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $childrenByParent = $categories
            ->filter(fn (ServiceCategory $category) => $category->parent_id !== null)
            ->groupBy('parent_id');

        $sections = $categories
            ->filter(fn (ServiceCategory $category) => $category->parent_id === null)
            ->map(fn (ServiceCategory $root) => [
                'id'    => $root->id,
                'name'  => $root->name,
                'cards' => $childrenByParent->get($root->id, collect())
                    ->map(fn (ServiceCategory $child) => $this->card(
                        $child->id,
                        $child->name,
                        $servicesByCat,
                        $childrenByParent
                    ))
                    ->filter(fn (array $card) => $card['simple'] !== [] || $card['cat'] !== [])
                    ->values(),
            ])
            ->filter(fn (array $section) => $section['cards']->isNotEmpty())
            ->values();

        return view('prices', ['sections' => $sections]);
    }

    /**
     * Одна карточка-аккордеон: собственные услуги + вложенные поднаправления.
     * Все услуги дерева собираются одним запросом и раскладываются здесь.
     */
    private function card(int $categoryId, string $name, $servicesByCat, $childrenByParent): array
    {
        $items = $this->items($categoryId, $servicesByCat, $childrenByParent, []);

        $simple = [];
        $cat = [];
        $min = null;

        $adjustMin = function (Service $service) use (&$min) {
            foreach ([$service->price, $service->price_cat_1, $service->price_cat_2, $service->price_cat_3] as $value) {
                if ($value === null) {
                    continue;
                }
                $value = (float) $value;
                $min = $min === null ? $value : min($min, $value);
            }
        };

        $walk = null;
        $walk = function (array $items, bool $inCat, int $group) use (&$walk, &$simple, &$cat, $adjustMin) {
            foreach ($items as $item) {
                if ($item['type'] === 'svc') {
                    $service = $item['service'];
                    if ($inCat) {
                        $cat[$group]['rows'][] = $service;
                    } elseif ($service->price_cat_1 !== null) {
                        $cat[] = ['banner' => null, 'rows' => [$service]];
                        $group = count($cat) - 1;
                        $inCat = true;
                    } else {
                        $simple[] = $service;
                    }
                    $adjustMin($service);
                    continue;
                }

                /* поднаправление: если внутри есть цены по категориям — таблица с категориями, иначе простая */
                if ($inCat || $this->hasCategoryPrices($item['items'])) {
                    $cat[] = ['banner' => $item['category'], 'rows' => []];
                    $group = count($cat) - 1;
                    $walk($item['items'], true, $group);
                    continue;
                }

                /* беспрайсовое поднаправление — строки без баннера в общую таблицу */
                $walk($item['items'], false, $group);
            }
        };

        $walk($items, false, -1);

        return [
            'id'     => $categoryId,
            'name'   => $name,
            'simple' => $simple,
            'cat'    => array_values($cat),
            'min'    => $min,
        ];
    }

    /** Дерево карточки: услуги (с дедупликацией по названию) и вложенные поднаправления */
    private function items(int $categoryId, $servicesByCat, $childrenByParent, array $seen): array
    {
        $items = [];

        foreach ($servicesByCat->get($categoryId, collect()) as $service) {
            if (isset($seen[$service->name])) {
                continue;
            }
            $seen[$service->name] = true;
            $items[] = ['type' => 'svc', 'service' => $service];
        }

        foreach ($childrenByParent->get($categoryId, collect()) as $child) {
            $childItems = $this->items($child->id, $servicesByCat, $childrenByParent, $seen);
            if ($childItems !== []) {
                $items[] = ['type' => 'group', 'category' => $child, 'items' => $childItems];
            }
        }

        return $items;
    }

    /** Есть ли в ветке услуги с ценами по категориям сложности */
    private function hasCategoryPrices(array $items): bool
    {
        foreach ($items as $item) {
            if ($item['type'] === 'svc' && $item['service']->price_cat_1 !== null) {
                return true;
            }
            if ($item['type'] === 'group' && $this->hasCategoryPrices($item['items'])) {
                return true;
            }
        }

        return false;
    }
}
