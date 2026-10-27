<?php

use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/uslugi', [ServiceController::class, 'index'])->name('services');
Route::get('/uslugi/{category:slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/prices', [PriceController::class, 'index'])->name('prices');

Route::get('/stock', [PromotionController::class, 'index'])->name('stock');
Route::get('/stock/{promotion:slug}', [PromotionController::class, 'show'])->name('stock.show');

Route::get('/proekty', [ProjectController::class, 'index'])->name('projects');
Route::get('/proekty/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/novosti', fn () => redirect()->route('news'));
Route::get('/novosti/{news:slug}', fn (\App\Models\News $news) => redirect()->route('news.show', $news));

Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/voprosy-i-otvety', fn () => redirect()->route('faq'));

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
