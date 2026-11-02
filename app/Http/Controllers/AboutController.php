<?php

namespace App\Http\Controllers;

use App\Models\ServiceCase;
use App\Models\Setting;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Страница «О клинике»
     */
    public function index(Request $request)
    {
        $aboutImage = Setting::get(
            'about_image',
            'https://cdn.jsdelivr.net/gh/mifshs/art-medika-media@main/cover/room.png'
        );

        $aboutStats = Setting::get('about_stats', [
            ['value' => '10+', 'label' => 'обучений в год проходят специалисты центра'],
            ['value' => '20',  'label' => 'проектов уже было реализовано в нашей клинике'],
            ['value' => '90%', 'label' => 'положительных отзывов'],
        ]);

        $introText = Setting::get(
            'about_intro',
            'Превращаем заветные мечты пациентов в реальность, невзирая на сложность задачи'
        );

        // Результаты операций для слайдера Swiper
        $cases = ServiceCase::query()
            ->with(['media', 'service'])
            ->orderBy('sort_order')
            ->get();

        $caseTabs = $cases->map(fn (ServiceCase $c) => $c->service?->name)->filter()->unique()->values();

        return view('about', compact('aboutImage', 'aboutStats', 'introText', 'cases', 'caseTabs'));
    }
}
