@props([
    'title',
    'description',
    'keywords',
    'canonical' => null,
    'ogType' => 'website',
    'ogImage' => null,
    'robots' => 'index, follow',
    'preloadFonts' => ['onest-cyrillic-wght-normal.woff2'],
    'preloadImage' => null,
    'preloadImageSrcset' => null,
    'preloadImageSizes' => null,
])
@php
    $cleanText = static fn (?string $text): string => (string) preg_replace('/\s+/u', ' ', trim(strip_tags((string) $text)));
    $metaTitle = $cleanText($title);
    $metaDescription = \Illuminate\Support\Str::limit($cleanText($description), 160);
    $metaKeywords = \Illuminate\Support\Str::limit($cleanText($keywords), 255);
    $canonicalUrl = $canonical ?: url()->current();
    $rawImage = $ogImage ?: '/storage/cover/doctor-performing-physical-check-patient%202@2x.webp';
    $ogImageUrl = \Illuminate\Support\Str::startsWith($rawImage, ['http://', 'https://']) ? $rawImage : url($rawImage);
@endphp
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $metaTitle }}</title>
<meta name="description" content="{{ $metaDescription }}">
<meta name="keywords" content="{{ $metaKeywords }}">
<meta name="robots" content="{{ $robots }}">
<link rel="canonical" href="{{ $canonicalUrl }}">
<meta property="og:locale" content="ru_RU">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:site_name" content="Медико-косметологический центр «Арт-Медика»">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:image" content="{{ $ogImageUrl }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
<meta name="twitter:image" content="{{ $ogImageUrl }}">
<x-favicon></x-favicon>
@foreach ((array) $preloadFonts as $fontFile)
<link rel="preload" href="{{ asset('fonts/' . ltrim($fontFile, '/')) }}" as="font" type="font/woff2" crossorigin>
@endforeach
@if ($preloadImage)
<link rel="preload" as="image" href="{{ $preloadImage }}"@if ($preloadImageSrcset) imagesrcset="{{ $preloadImageSrcset }}"@endif @if ($preloadImageSizes) imagesizes="{{ $preloadImageSizes }}"@endif fetchpriority="high">
@endif
@vite(['resources/css/app.css', 'resources/js/app.js'])
{{ $slot }}
