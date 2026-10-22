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
            ->orderBy('id')
            ->get();

        return view('projects', compact('projects'));
    }
}
