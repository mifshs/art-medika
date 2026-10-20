<?php

namespace App\Livewire\Stock;

use App\Models\Project;
use Livewire\Component;

class ProjectList extends Component
{
    public function render()
    {
        $projects = Project::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->get()
            ->map(function ($project) {
                // ВАЖНО: Укажите правильное название колонки из таблицы projects.
                // Если колонка называется 'image', замените 'cover' на 'image'.
                $imagePath = $project->cover ?? $project->image ?? null;

                return [
                    'id' => $project->id,
                    'slug' => $project->slug,
                    'title' => $project->title,
                    'description' => $project->excerpt,
                    'date' => $project->published_at?->format('d.m.Y'),
                    
                    // Формируем полный URL к картинке
                    'image' => $imagePath ? asset('storage/' . $imagePath) : null,
                ];
            })
            ->toArray();

        return view('livewire.stock.project-list', [
            'projects' => $projects,
        ]);
    }
}