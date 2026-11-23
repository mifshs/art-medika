<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\News;
use App\Models\Project;
use App\Models\Promotion;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Динамическая XML-карта сайта для поисковых систем
     */
    public function index(): Response
    {
        $now = now()->toAtomString();
        $urls = [];

        $addUrl = function (string $loc, string $lastmod, string $changefreq, string $priority) use (&$urls): void {
            $urls[] = [
                'loc'        => $loc,
                'lastmod'    => $lastmod,
                'changefreq' => $changefreq,
                'priority'   => $priority,
            ];
        };

        $staticPages = [
            ['name' => 'home',        'changefreq' => 'weekly',  'priority' => '1.0'],
            ['name' => 'services',    'changefreq' => 'weekly',  'priority' => '0.9'],
            ['name' => 'prices',      'changefreq' => 'weekly',  'priority' => '0.8'],
            ['name' => 'specialists', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['name' => 'about',       'changefreq' => 'monthly', 'priority' => '0.8'],
            ['name' => 'stock',       'changefreq' => 'weekly',  'priority' => '0.8'],
            ['name' => 'projects',    'changefreq' => 'monthly', 'priority' => '0.7'],
            ['name' => 'news',        'changefreq' => 'weekly',  'priority' => '0.7'],
            ['name' => 'faq',         'changefreq' => 'monthly', 'priority' => '0.6'],
            ['name' => 'documents',   'changefreq' => 'monthly', 'priority' => '0.5'],
            ['name' => 'contacts',    'changefreq' => 'monthly', 'priority' => '0.8'],
        ];

        foreach ($staticPages as $page) {
            $addUrl(route($page['name']), $now, $page['changefreq'], $page['priority']);
        }

        // Направления и поднаправления услуг (кроме технической категории, не имеющей своей витрины)
        ServiceCategory::query()->active()
            ->where('slug', '!=', '')
            ->orderBy('sort_order')
            ->get(['slug', 'parent_id', 'updated_at'])
            ->each(function (ServiceCategory $cat) use ($addUrl, $now): void {
                $addUrl(
                    route('services.show', $cat->slug),
                    $cat->updated_at?->toAtomString() ?? $now,
                    'weekly',
                    $cat->parent_id ? '0.8' : '0.9',
                );
            });

        // Услуги
        Service::query()->active()
            ->where('slug', '!=', '')
            ->orderBy('sort_order')
            ->get(['slug', 'updated_at'])
            ->each(function (Service $srv) use ($addUrl, $now): void {
                $addUrl(
                    route('services.show', $srv->slug),
                    $srv->updated_at?->toAtomString() ?? $now,
                    'monthly',
                    '0.8',
                );
            });

        // Специалисты
        Expert::query()->active()
            ->where('slug', '!=', '')
            ->orderBy('sort_order')
            ->get(['slug', 'updated_at'])
            ->each(function (Expert $expert) use ($addUrl, $now): void {
                $addUrl(
                    route('specialists.show', $expert),
                    $expert->updated_at?->toAtomString() ?? $now,
                    'monthly',
                    '0.7',
                );
            });

        // Проекты
        Project::query()->where('is_active', true)
            ->where('slug', '!=', '')
            ->orderBy('id')
            ->get(['slug', 'published_at', 'updated_at'])
            ->each(function (Project $project) use ($addUrl, $now): void {
                $addUrl(
                    route('projects.show', $project),
                    ($project->updated_at ?? $project->published_at)?->toAtomString() ?? $now,
                    'monthly',
                    '0.7',
                );
            });

        // Акции
        Promotion::query()->active()
            ->where('slug', '!=', '')
            ->orderBy('id')
            ->get(['slug', 'published_at', 'updated_at'])
            ->each(function (Promotion $promotion) use ($addUrl, $now): void {
                $addUrl(
                    route('stock.show', $promotion),
                    ($promotion->updated_at ?? $promotion->published_at)?->toAtomString() ?? $now,
                    'weekly',
                    '0.7',
                );
            });

        // Новости и статьи
        News::query()->published()
            ->where('slug', '!=', '')
            ->orderBy('id')
            ->get(['slug', 'published_at', 'updated_at'])
            ->each(function (News $item) use ($addUrl, $now): void {
                $addUrl(
                    route('news.show', $item),
                    ($item->updated_at ?? $item->published_at)?->toAtomString() ?? $now,
                    'monthly',
                    '0.6',
                );
            });

        $lines = [
            '<?xml version="1.0" encoding="UTF-8"?>',
            '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">',
        ];

        foreach ($urls as $u) {
            $lines[] = '  <url>';
            $lines[] = '    <loc>' . e($u['loc']) . '</loc>';
            $lines[] = '    <lastmod>' . e($u['lastmod']) . '</lastmod>';
            $lines[] = '    <changefreq>' . $u['changefreq'] . '</changefreq>';
            $lines[] = '    <priority>' . $u['priority'] . '</priority>';
            $lines[] = '  </url>';
        }

        $lines[] = '</urlset>';

        return response(implode("\n", $lines) . "\n", 200, [
            'Content-Type'  => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
