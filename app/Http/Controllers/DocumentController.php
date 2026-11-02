<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DocumentController extends Controller
{
    /**
     * Страница документации (список документов по категориям)
     */
    public function index(Request $request)
    {
        $documentsGrouped = Document::query()
            ->ordered()
            ->get()
            ->groupBy('category');

        return view('documents', compact('documentsGrouped'));
    }

    /**
     * Скачивание файла документа
     */
    public function download(Document $document)
    {
        $url = $document->file_url;

        if (empty($url)) {
            abort(404, 'Файл не прикреплен к документу');
        }

        // Если это внешний URL (например CDN)
        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            return redirect()->away($url);
        }

        // Проверяем в public/
        $publicPath = public_path($url);
        if (file_exists($publicPath) && is_file($publicPath)) {
            $ext = pathinfo($publicPath, PATHINFO_EXTENSION) ?: 'pdf';
            $downloadName = $document->title . '.' . $ext;
            return response()->download($publicPath, $downloadName);
        }

        // Проверяем в storage/app/public/
        if (Storage::disk('public')->exists($url)) {
            $storagePath = Storage::disk('public')->path($url);
            $ext = pathinfo($storagePath, PATHINFO_EXTENSION) ?: 'pdf';
            $downloadName = $document->title . '.' . $ext;
            return response()->download($storagePath, $downloadName);
        }

        // Фолбэк на sample-document, если файл ещё не загружен
        $fallback = storage_path('app/public/documents/sample-document.pdf');
        if (file_exists($fallback)) {
            return response()->download($fallback, $document->title . '.pdf');
        }

        abort(404, 'Файл документа не найден на сервере');
    }
}
