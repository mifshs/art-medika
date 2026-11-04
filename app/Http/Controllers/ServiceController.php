<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\Setting;

class ServiceController extends Controller
{
    /** Страница «Услуги»: все направления клиники */
    public function index()
    {
        $categories = ServiceCategory::query()->roots()
            ->active()
            ->with('media')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        // Текст-описание редактируется из админки: settings.services_page_intro
        $intro = Setting::get('services_page_intro')
            ?? 'В клинике «Арт-Медика» мы объединили многолетний опыт врачей и современные технологии, чтобы предложить вам максимально широкий спектр медицинских и эстетических услуг.';

        return view('services', compact('categories', 'intro'));
    }

    /** Определение: категория или конкретная услуга */
    public function resolve(string $slug)
    {
        $category = ServiceCategory::where('slug', $slug)->first();
        if ($category) {
            return $this->show($category);
        }

        $service = Service::where('slug', $slug)->firstOrFail();
        return $this->showService($service);
    }

    /** Детальная страница конкретной услуги (например, Блефаропластика) */
    public function showService(Service $service)
    {
        abort_unless($service->is_active, 404);

        $service->load(['category.parent', 'cases.media', 'experts.media', 'experts.department']);

        $category = $service->category;

        // Если это не блефаропластика (нет контента проблем/подготовки/кейсов)
        $hasFullContent = !empty($service->problems) || !empty($service->preparation) || $service->cases->isNotEmpty();

        return view('service-detail', [
            'service'        => $service,
            'category'       => $category,
            'hasFullContent' => $hasFullContent,
        ]);
    }

    /** Направление: поднаправления с ценами и длительностью услуг */
    public function show(ServiceCategory $category)
    {
        abort_unless($category->is_active, 404);

        $category->load('media');

        // Если это подкатегория второго уровня (например, plastika-litsa или другие группы)
        if ($category->parent_id) {
            $services = $category->allServices()->active()->orderBy('sort_order')->orderBy('id')->get();

            return view('service-subgroup', [
                'category' => $category,
                'services' => $services,
            ]);
        }

        // Все услуги направления в одном запросе, раскладываем по поднаправлениям
        $services = $category->allServices()->active()->orderBy('sort_order')->orderBy('id')->get();

        $childIds = [];
        $groups = $category->children()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(function (ServiceCategory $child) use ($services, &$childIds) {
                $ids   = $child->descendantIds();
                $ids[] = $child->id;
                $childIds = array_merge($childIds, $ids);

                $rows = $services->filter(fn (Service $s) => in_array($s->service_category_id, $ids))
                    ->values()
                    ->all();

                return ['category' => $child, 'services' => $rows];
            });

        // Услуги, закреплённые за самим направлением, а не за его поднаправлениями
        $own = $services->reject(fn (Service $s) => in_array($s->service_category_id, $childIds))->values();
        if ($own->isNotEmpty()) {
            $groups = collect([['category' => null, 'services' => $own->all()]])
                ->merge($groups);
        }

        return view('services-show', [
            'category' => $category,
            'groups'   => $groups,
            'total'    => $services->count(),
        ]);
    }
}
