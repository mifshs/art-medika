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

        $project->load(['media', 'formats', 'stages', 'partners']);

        $projects = Project::query()
            ->where('is_active', true)
            ->with(['media', 'formats', 'stages', 'partners'])
            ->orderBy('id', 'asc')
            ->get();

        return view('projects', compact('projects', 'project'));
    }
}
