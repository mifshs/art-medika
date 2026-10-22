<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::query()
            ->where('is_active', true)
            ->with('media')
            ->orderByRaw('published_at IS NULL, published_at DESC, id DESC')
            ->get();

        return view('projects', compact('projects'));
    }
}
