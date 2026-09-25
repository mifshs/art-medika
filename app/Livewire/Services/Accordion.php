<?php

namespace App\Livewire\Services;

use App\Models\ServiceCategory;
use Livewire\Component;

class Accordion extends Component
{
    public array $directions = [];

    public function mount(): void
    {
        // 1 запрос: корни + их группы + услуги групп (без N+1 на услуги)
        $roots = ServiceCategory::query()
            ->whereNull('parent_id')          // уровень 1 = плашки
            ->with('children.services')       // уровень 2 = карточки, их услуги = пункты
            ->orderBy('sort_order')
            ->get();

        // маппим в чистые скалярные массивы — Livewire сериализует их без проблем
        $this->directions = $roots->map(fn ($root) => [
            'title' => $root->name,
            'cards' => $root->children->map(fn ($group) => [
                'title'    => $group->name,
                'image'    => $group->coverUrl(),     // null, если фото нет
                'services' => $group->services->map(fn ($s) => [
                    'label' => $s->name,
                    'url'   => url('/uslugi/' . $s->slug), // подставь свой роут, когда будет
                ])->values(),
            ])->values(),
        ])->values()->all();
    }

    public function render()
    {
        return view('livewire.services.accordion');
    }
}