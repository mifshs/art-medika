<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Expert;
use App\Models\ServiceCase;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    /**
     * Список специалистов с фильтрацией по отделениям
     */
    public function index(Request $request)
    {
        $departments = Department::query()
            ->orderBy('sort_order')
            ->get();

        $experts = Expert::query()
            ->active()
            ->with(['department', 'media'])
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('specialists', compact('experts', 'departments'));
    }

    /**
     * Страница конкретного специалиста
     */
    public function show(Expert $expert, Request $request)
    {
        abort_unless($expert->is_active, 404);

        $expert->load(['department', 'media', 'educations', 'accreditations', 'services']);

        // Результаты операций для слайдера внизу страницы
        $cases = ServiceCase::query()
            ->with(['media', 'service'])
            ->orderBy('sort_order')
            ->get();

        $caseTabs = $cases->map(fn (ServiceCase $c) => $c->service?->name)->filter()->unique()->values();

        return view('specialist-detail', compact('expert', 'cases', 'caseTabs'));
    }
}
