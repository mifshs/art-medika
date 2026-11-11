<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::query()
            ->where('is_active', true)
            ->with(['media', 'formats', 'stages', 'partners'])
            ->orderBy('id', 'asc')
            ->get();

        return view('projects', compact('projects'));
    }

    public function show(Project $project)
    {
        abort_unless($project->is_active, 404);

        $project->load([
            'media',
            'formats.media',
            'stages',
            'partners' => fn ($q) => $q->orderBy('sort_order')->orderBy('id'),
        ]);

        $partners = $project->partners()->orderBy('sort_order')->orderBy('id')->paginate(12);

        $gallery = $project->gallery();

        return view('projects-show', compact('project', 'partners', 'gallery'));
    }
}
