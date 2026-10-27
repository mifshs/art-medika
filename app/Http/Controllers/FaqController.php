<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Страница «Вопросы и ответы»
     */
    public function index(Request $request)
    {
        $faqs = Faq::query()
            ->active()
            ->get();

        return view('faq', compact('faqs'));
    }
}
