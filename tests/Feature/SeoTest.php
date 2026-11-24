<?php

namespace Tests\Feature;

use App\Models\Document;
use App\Models\Expert;
use App\Models\News;
use App\Models\Project;
use App\Models\Promotion;
use App\Models\Service;
use Database\Seeders\ContentSeeder;
use Database\Seeders\ExpertSeeder;
use Database\Seeders\MainPageServicesSeeder;
use Database\Seeders\MiscSeeder;
use Database\Seeders\ServiceSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoTest extends TestCase
{
    use RefreshDatabase;

    private function seedCatalog(): void
    {
        $this->seed(ServiceSeeder::class);
        $this->seed(MainPageServicesSeeder::class);
        $this->seed(ExpertSeeder::class);
        $this->seed(ContentSeeder::class);
        $this->seed(MiscSeeder::class);
    }

    public function test_all_public_and_content_pages_render_full_seo_opengraph_and_local_fonts(): void
    {
        $this->seedCatalog();

        $expert = Expert::where('is_active', true)->firstOrFail();
        $news = News::published()->firstOrFail();
        $project = Project::where('is_active', true)->firstOrFail();
        $promotion = Promotion::active()->firstOrFail();

        $urls = [
            '/',
            '/o-centre',
            '/uslugi',
            '/uslugi/plasticheskaya-hirurgiya',
            '/uslugi/plastika-litsa',
            '/uslugi/blefaroplastika',
            '/prices',
            '/stock',
            '/stock/' . $promotion->slug,
            '/proekty',
            '/proekty/' . $project->slug,
            '/spetsialisty',
            '/spetsialisty/' . $expert->slug,
            '/news',
            '/news/' . $news->slug,
            '/faq',
            '/documents',
            '/kontakty',
        ];

        $seenTitles = [];

        foreach ($urls as $url) {
            $response = $this->get($url);
            $response->assertStatus(200);
            $html = $response->getContent();

            $this->assertMatchesRegularExpression('/<title>.+<\/title>/s', $html, "Missing <title> on {$url}");
            $this->assertMatchesRegularExpression('/<meta\s+name="description"\s+content="[^"]+"/i', $html, "Missing meta description on {$url}");
            $this->assertMatchesRegularExpression('/<meta\s+name="keywords"\s+content="[^"]+"/i', $html, "Missing meta keywords on {$url}");
            $this->assertStringContainsString('<meta name="robots" content="index, follow">', $html, "Missing robots meta on {$url}");
            $this->assertMatchesRegularExpression('/<link\s+rel="canonical"\s+href="[^"]+"/i', $html, "Missing canonical on {$url}");
            $this->assertMatchesRegularExpression('/<meta\s+property="og:title"\s+content="[^"]+"/i', $html, "Missing og:title on {$url}");
            $this->assertMatchesRegularExpression('/<meta\s+property="og:description"\s+content="[^"]+"/i', $html, "Missing og:description on {$url}");
            $this->assertMatchesRegularExpression('/<meta\s+property="og:image"\s+content="https?:\/\/[^"]+"/i', $html, "Missing absolute og:image on {$url}");
            $this->assertMatchesRegularExpression('/<meta\s+property="og:url"\s+content="https?:\/\/[^"]+"/i', $html, "Missing og:url on {$url}");
            $this->assertStringContainsString('id="main-content"', $html, "Missing main-content landmark on {$url}");

            $h1Count = preg_match_all('/<h1[\s>]/i', $html);
            $this->assertSame(1, $h1Count, "Expected exactly 1 <h1> on {$url}, found {$h1Count}");

            $this->assertStringNotContainsString('fonts.googleapis.com', $html, "External Google Fonts link found on {$url}");
            $this->assertStringNotContainsString('fonts.gstatic.com', $html, "External Google Fonts static link found on {$url}");
            $this->assertStringNotContainsString('fonts.bunny.net', $html, "External Bunny Fonts link found on {$url}");

            preg_match('/<title>(.*?)<\/title>/s', $html, $m);
            $title = trim($m[1] ?? '');
            $this->assertNotContains($title, $seenTitles, "Duplicate title '{$title}' on {$url}");
            $seenTitles[] = $title;
        }
    }

    public function test_content_pages_vary_seo_tags_by_record(): void
    {
        $this->seedCatalog();

        $blef = $this->get('/uslugi/blefaroplastika')->assertStatus(200)->getContent();
        $mammo = $this->get('/uslugi/mammo-1')->assertStatus(200)->getContent();

        $this->assertNotSame($blef, $mammo);
        $this->assertStringContainsString('Блефаропластика', $blef);
        $this->assertStringContainsString('Маммопластика', $mammo);
    }

    public function test_sitemap_xml_lists_static_and_active_content_slugs(): void
    {
        $this->seedCatalog();

        $response = $this->get('/sitemap.xml');
        $response->assertStatus(200);
        $this->assertStringContainsString('application/xml', (string) $response->headers->get('Content-Type'));

        $xml = $response->getContent();
        $this->assertStringContainsString('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', $xml);
        $this->assertStringContainsString('/uslugi/blefaroplastika</loc>', $xml);
        $this->assertStringContainsString('/spetsialisty/kuznecova-irina</loc>', $xml);
        $this->assertStringContainsString('/proekty/krasota-v-tebe</loc>', $xml);
        $this->assertStringContainsString('/news/osvezhitsya-no-ne-bolee</loc>', $xml);
        $this->assertStringContainsString('/stock/nitevoy-lifting-lepestok-skidka-50</loc>', $xml);

        $parsed = @simplexml_load_string($xml);
        $this->assertNotFalse($parsed, 'sitemap.xml must be valid XML');
    }

    public function test_robots_txt_blocks_private_sections_and_links_sitemap(): void
    {
        $robots = file_get_contents(public_path('robots.txt'));
        $this->assertNotFalse($robots);
        $this->assertStringContainsString('Disallow: /admin', $robots);
        $this->assertStringContainsString('Disallow: /dashboard', $robots);
        $this->assertStringContainsString('Disallow: /login', $robots);
        $this->assertStringContainsString('Disallow: /livewire/', $robots);
        $this->assertStringContainsString('Sitemap:', $robots);
    }

    public function test_alias_routes_return_permanent_301_redirects(): void
    {
        $this->seedCatalog();

        foreach ([
            '/about'          => '/o-centre',
            '/o-klinike'      => '/o-centre',
            '/specialists'    => '/spetsialisty',
            '/novosti'        => '/news',
            '/voprosy-i-otvety' => '/faq',
            '/dokumenty'      => '/documents',
            '/contacts'       => '/kontakty',
        ] as $from => $to) {
            $res = $this->get($from);
            $res->assertStatus(301);
            $this->assertStringEndsWith($to, (string) $res->headers->get('Location'));
        }
    }

    public function test_documents_use_slug_routes_and_preserve_id_fallback(): void
    {
        $doc = Document::create([
            'category'     => 'Лицензии',
            'title'        => 'Лицензия на медицинскую деятельность',
            'file_url'     => 'docs/sertificate1.webp',
            'sort_order'   => 1,
            'published_at' => now(),
        ]);

        $this->assertSame('licenziia-na-medicinskuiu-deiatelnost', $doc->slug);

        $page = $this->get('/documents')->assertStatus(200)->getContent();
        $this->assertStringContainsString('/documents/download/' . $doc->slug, $page);

        $this->get('/documents/download/' . $doc->slug)
            ->assertStatus(200)
            ->assertHeader('content-disposition');

        $this->get('/documents/download/' . $doc->id)
            ->assertStatus(200)
            ->assertHeader('content-disposition');

        // Fallback на id, если у записи в БД на хостинге пустой slug
        Document::whereKey($doc->id)->update(['slug' => null]);
        $fallbackPage = $this->get('/documents')->assertStatus(200)->getContent();
        $this->assertStringContainsString('/documents/download/' . $doc->id, $fallbackPage);
    }

    public function test_auth_pages_are_noindex_and_have_no_external_fonts(): void
    {
        $html = $this->get('/login')->assertStatus(200)->getContent();
        $this->assertStringContainsString('<meta name="robots" content="noindex, nofollow">', $html);
        $this->assertStringContainsString('Вход — Арт-Медика', $html);
        $this->assertStringNotContainsString('fonts.bunny.net', $html);
    }

    public function test_home_renders_services_accordion_without_livewire_bloat(): void
    {
        $this->seed(\Database\Seeders\ServiceSeeder::class);
        $this->seed(\Database\Seeders\MainPageServicesSeeder::class);

        $plain = $this->get('/');
        $plain->assertStatus(200)
            ->assertSee('acc-item', false)
            ->assertSee('x-collapse.duration.450ms', false)
            ->assertDontSee('/livewire/livewire', false)
            ->assertDontSee('wire:snapshot', false);

        $gzipped = $this->withHeaders(['Accept-Encoding' => 'gzip'])->get('/');
        $gzipped->assertStatus(200)
            ->assertHeader('Content-Encoding', 'gzip');

        $decoded = gzdecode((string) $gzipped->getContent());
        $this->assertNotFalse($decoded);
        $this->assertStringContainsString('acc-item', $decoded);
        $this->assertStringContainsString('x-collapse.duration.450ms', $decoded);

        $middleware = new \App\Http\Middleware\CompressResponse();
        $req = \Illuminate\Http\Request::create('/', 'GET', server: ['HTTP_ACCEPT_ENCODING' => 'gzip']);
        $wireRes = $middleware->handle($req, fn () => response(
            '<html><body><div wire:id="1"></div>' . str_repeat('x', 2000) . '</body></html>',
            200,
            ['Content-Type' => 'text/html; charset=UTF-8']
        ));
        $this->assertFalse($wireRes->headers->has('Content-Encoding'));
    }

    public function test_contacts_renders_immediate_interactive_yandex_map_iframe(): void
    {
        $html = $this->get('/kontakty')->assertStatus(200)->getContent();

        $this->assertStringContainsString('id="yandex-map"', $html);
        $this->assertStringContainsString('https://yandex.ru/map-widget/v1/', $html);
        $this->assertStringNotContainsString('Показать интерактивную карту', $html);
        $this->assertStringNotContainsString('x-data="{ loaded: false }"', $html);
    }
}
