<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SpecialistController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/o-centre', [AboutController::class, 'index'])->name('about');
Route::get('/o-klinike', fn () => redirect()->route('about', [], 301));
Route::get('/about', fn () => redirect()->route('about', [], 301));

Route::get('/uslugi', [ServiceController::class, 'index'])->name('services');
Route::get('/uslugi/{slug}', [ServiceController::class, 'resolve'])->name('services.show');

Route::get('/prices', [PriceController::class, 'index'])->name('prices');

Route::get('/stock', [PromotionController::class, 'index'])->name('stock');
Route::get('/stock/{promotion:slug}', [PromotionController::class, 'show'])->name('stock.show');

Route::get('/proekty', [ProjectController::class, 'index'])->name('projects');
Route::get('/proekty/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/spetsialisty', [SpecialistController::class, 'index'])->name('specialists');
Route::get('/spetsialisty/{expert:slug}', [SpecialistController::class, 'show'])->name('specialists.show');
Route::get('/specialists', fn () => redirect()->route('specialists', [], 301));
Route::get('/specialists/{expert:slug}', fn (\App\Models\Expert $expert) => redirect()->route('specialists.show', $expert, 301));

Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/novosti', fn () => redirect()->route('news', [], 301));
Route::get('/novosti/{news:slug}', fn (\App\Models\News $news) => redirect()->route('news.show', $news, 301));

Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/voprosy-i-otvety', fn () => redirect()->route('faq', [], 301));

Route::get('/documents', [DocumentController::class, 'index'])->name('documents');
Route::get('/documents/download/{document}', [DocumentController::class, 'download'])->name('documents.download');
Route::get('/dokumenty', fn () => redirect()->route('documents', [], 301));

Route::get('/kontakty', [ContactController::class, 'index'])->name('contacts');
Route::get('/contacts', fn () => redirect()->route('contacts', [], 301));

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/storage/{path}', function (string $path) {
    $root = realpath(Storage::disk('public')->path(''));
    $full = $root !== false ? realpath($root . DIRECTORY_SEPARATOR . $path) : false;

    if (($full === false || ! is_file($full)) && preg_match('/\.png$/i', $path)) {
        $webpRel = preg_replace('/\.png$/i', '.webp', $path);
        $full = $root !== false && $webpRel !== null
            ? realpath($root . DIRECTORY_SEPARATOR . $webpRel)
            : false;
    }

    abort_unless(
        $root !== false
        && $full !== false
        && str_starts_with($full, $root . DIRECTORY_SEPARATOR)
        && is_file($full),
        404
    );

    return response()->file($full, [
        'Cache-Control' => 'public, max-age=31536000, immutable',
    ]);
})->where('path', '.*');

require __DIR__.'/auth.php';
