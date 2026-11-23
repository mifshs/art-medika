<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CompressResponse
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (
            $response instanceof StreamedResponse
            || $response instanceof BinaryFileResponse
            || $response->headers->has('Content-Encoding')
            || ! function_exists('gzencode')
            || ! str_contains((string) $request->headers->get('Accept-Encoding', ''), 'gzip')
        ) {
            return $response;
        }

        $contentType = (string) $response->headers->get('Content-Type', '');
        if (! preg_match('#^(text/|application/(javascript|json|xml|xhtml\+xml))#i', $contentType)) {
            return $response;
        }

        $content = $response->getContent();
        if (! is_string($content) || strlen($content) < 1024) {
            return $response;
        }

        // Livewire 3 инжектит свои ассеты в RequestHandled уже после middleware, поэтому не сжимаем ответы с wire:id.
        if (str_contains($content, 'wire:id')) {
            return $response;
        }

        $compressed = gzencode($content, 6);
        if ($compressed === false) {
            return $response;
        }

        $response->setContent($compressed);
        $response->headers->set('Content-Encoding', 'gzip');
        $response->headers->set('Content-Length', (string) strlen($compressed));

        $vary = array_filter(array_map('trim', explode(',', (string) $response->headers->get('Vary', ''))));
        if (! in_array('Accept-Encoding', $vary, true)) {
            $vary[] = 'Accept-Encoding';
        }
        $response->headers->set('Vary', implode(', ', $vary));

        return $response;
    }
}
