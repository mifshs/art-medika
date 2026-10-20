<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\Project;
use App\Models\Review;
use App\Models\ServiceCase;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $contacts = Setting::get('contacts', [
            'address'    => '',
            'phone'      => '',
            'email'      => '',
            'work_hours' => '',
        ]);

        $heroStats  = Setting::get('hero_stats', []);
        $aboutStats = Setting::get('about_stats', []);
        $disclaimer = Setting::get('disclaimer');
        $videoUrl   = Setting::get('video_url', '#');

        // Специалисты: активные, с отделениями — для слайдера и табов
        $experts      = Expert::active()->with('department')->orderBy('sort_order')->get();
        $expertTabs   = $experts->map(fn (Expert $e) => $e->department?->name)->filter()->unique()->values();

        // Проекты: первый — большой блок, остальные — маленькие; форматы — отдельная сетка
        $projects   = Project::where('is_active', true)->with('formats')->orderBy('id')->get();
        $projectBig = $projects->first();
        $projectSmall = $projects->slice(1);
        $projectFormats = $projectBig?->formats ?? collect();

        // Отзывы
        $reviews = Review::active()->orderBy('id')->get();

        // Результаты операций: пары «до/после» + табы по услугам
        $cases    = ServiceCase::query()->with('service')->orderBy('sort_order')->get();
        $caseTabs = $cases->map(fn (ServiceCase $c) => $c->service?->name)->filter()->unique()->values();

        // Декоративные изображения: берутся из settings, если ключ добавлен в админке,
        // иначе — фолбэки на репозиторий медиа
        $heroImage  = Setting::get('hero_image')
            ?? 'https://raw.githubusercontent.com/mifshs/art-medika-media/main/cover/doctor-performing-physical-check-patient%202@2x.png';
        $aboutImage = Setting::get('about_image')
            ?? config('media.base_url') . '/cover/room.png';
        $workImage  = Setting::get('work_image')
            ?? config('media.base_url') . '/gallery/perchatki.png';

        return view('welcome', compact(
            'contacts',
            'heroStats',
            'aboutStats',
            'disclaimer',
            'videoUrl',
            'experts',
            'expertTabs',
            'projectBig',
            'projectSmall',
            'projectFormats',
            'reviews',
            'cases',
            'caseTabs',
            'heroImage',
            'aboutImage',
            'workImage',
        ));
    }
}
