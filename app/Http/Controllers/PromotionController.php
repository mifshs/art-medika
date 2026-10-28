<?php

namespace App\Http\Controllers;

use App\Models\Promotion;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::query()
            ->active()
            ->with(['media', 'service'])
            ->orderByRaw('published_at IS NULL, published_at DESC, id DESC')
            ->get();

        return view('project-stock', compact('promotions'));
    }

    public function show(Promotion $promotion)
    {
        abort_unless($promotion->is_active, 404);

        $promotion->load(['media', 'service']);

        $promotions = Promotion::query()
            ->active()
            ->with(['media', 'service'])
            ->where('id', '!=', $promotion->id)
            ->orderByRaw('published_at IS NULL, published_at DESC, id DESC')
            ->get();

        return view('stock-detail', ['promotion' => $promotion, 'promotions' => $promotions]);
    }
}
