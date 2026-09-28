<?php

namespace App\Livewire\Services;

use App\Models\ServiceCategory;
use Livewire\Component;

class Accordion extends Component
{
    public array $directions = [];

    public function mount(): void
    {
        $roots = ServiceCategory::query()
            ->whereNull('parent_id')
            ->with(['children' => function ($q) {
                $q->whereNotIn('slug', ['plasticheskaya-i-esteticheskaya-hirurgiya'])
                  ->orderBy('sort_order')
                  ->with(['services' => fn ($s) => $s->orderBy('sort_order')]);
            }])
            ->orderBy('sort_order')
            ->get();

        $this->directions = $roots->map(fn ($root) => [
            'title' => $root->name,
            'cards' => $root->children->map(fn ($group) => [
                'title'    => $group->name,
                'image'    => $group->coverUrl(),
                'services' => $group->services
                    ->unique('name')          // ← режет дубли по названию, что бы их ни наплодило
                    ->values()
                    ->map(fn ($s) => [
                        'label' => $s->name,
                        'url'   => url('/uslugi/' . $s->slug),
                    ])->values(),
            ])->values(),
        ])->values()->all();
    }

    public function render()
    {
        return view('livewire.services.accordion');
    }
}