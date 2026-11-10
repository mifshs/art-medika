<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Страница контактов
     */
    public function index(Request $request)
    {
        $introText = Setting::get(
            'contacts_intro',
            'Пишите нам, когда вам удобно — даже в выходные или ночью. Ваш запрос будет обработан в ближайшее рабочее время'
        );

        $contacts = Setting::get('contacts', [
            'address' => '454007, Челябинская область, г. Челябинск, проспект Ленина 12 "А" (рядом Театр ЧТЗ)',
            'phone' => '+7 (351) 775-19-18',
            'phone_hotline' => '+7 (351) 775-19-88',
            'work_hours' => 'ПН-СБ с 9:00 до 20:00',
            'email_tests' => 'sender@artmdc.ru',
            'email_appeals' => 'marketing.art-medica@mail.ru',
            'messages_phone' => '+7 (912) 326-34-60',
            'messages_label' => 'Telegram, MAX',
        ]);

        $mediaBase = rtrim((string) config('media.base_url', 'https://cdn.jsdelivr.net/gh/mifshs/art-medika-media@main'), '/');

        $socialIcons = Setting::get('social_icons', [
            'max'      => $mediaBase . '/docs/max-messenger-sign-logo%201.png',
            'vk'       => $mediaBase . '/docs/Vk_logo.png',
            'telegram' => $mediaBase . '/docs/Telegram_logo%201.png',
        ]);

        $socials = Setting::get('socials', [
            'max'      => 'https://max.ru',
            'vk'       => 'https://vk.com/artmedica',
            'telegram' => 'https://t.me/artmedica',
        ]);

        // Точные координаты центра: г. Челябинск, пр. Ленина, д. 12А (здание 12а на пересечении с ул. 40-летия Октября / Ловина)
        $mapCoordinates = [
            'lat' => 55.161095,
            'lng' => 61.448844,
            'zoom' => 16,
        ];

        return view('contacts', compact(
            'introText',
            'contacts',
            'socials',
            'socialIcons',
            'mapCoordinates'
        ));
    }
}
