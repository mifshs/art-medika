<?php

namespace Tests\Feature;

use App\Livewire\Services\Accordion;
use App\Models\Media;
use App\Models\ServiceCategory;
use Database\Seeders\MainPageServicesSeeder;
use Database\Seeders\ServiceSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MediaAndHeaderTest extends TestCase
{
    use RefreshDatabase;

    public function test_storage_fallback_route_serves_local_media_and_blocks_traversal(): void
    {
        $this->get('/storage/cover/image%2034.png')->assertStatus(200);
        $this->get('/storage/cover/doctor-performing-physical-check-patient%202@2x.png')->assertStatus(200);
        $this->get('/storage/../../.env')->assertStatus(404);
        $this->get('/storage/%2e%2e/%2e%2e/.env')->assertStatus(404);
    }

    public function test_media_model_rewrites_legacy_cdn_url_to_local_storage(): void
    {
        $media = new Media([
            'disk' => 'github',
            'path' => 'cover/project1.png',
            'url'  => 'https://cdn.jsdelivr.net/gh/mifshs/art-medika-media@main/cover/project1.png',
        ]);

        $this->assertSame('/storage/cover/project1.png', $media->url);
    }

    public function test_home_header_uses_consistent_breakpoints_hover_animation_and_no_abrupt_press(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $html = $response->getContent();

        $this->assertStringContainsString('xl:hidden', $html);
        $this->assertStringContainsString('xl:flex', $html);
        $this->assertStringContainsString('hover:after:scale-x-100', $html);
        $this->assertStringNotContainsString('active:scale-95', $html);
    }

    public function test_main_page_accordion_uses_bw_plastic_surgery_and_cosmo_covers(): void
    {
        $this->seed(ServiceSeeder::class);
        $this->seed(MainPageServicesSeeder::class);

        $component = new Accordion();
        $component->mount();

        $byTitle = collect($component->directions)->keyBy('title');

        $plasticCards = collect($byTitle['Пластическая хирургия']['cards'])->keyBy('title');
        $this->assertStringContainsString('portrait-woman-with-dysmorphia', (string) $plasticCards['Пластика лица']['image']);
        $this->assertStringContainsString('naked-woman-covering-herself1', (string) $plasticCards['Пластика груди']['image']);
        $this->assertStringContainsString('fit-woman-wearing-white-lingerie', (string) $plasticCards['Пластика тела']['image']);
        $this->assertStringContainsString('image%2034.png', (string) $plasticCards['Интимная пластика для мужчин']['image']);
        $this->assertStringContainsString('attractive-woman', (string) $plasticCards['Другие услуги']['image']);
        $this->assertNull($plasticCards['Комбо-операции']['image']);

        $cosmoCards = collect($byTitle['Косметология']['cards'])->keyBy('title');
        $this->assertStringContainsString('view-from-rejuvenation', (string) $cosmoCards['Аппаратная косметология']['image']);
        $this->assertStringContainsString('laser-system.png', (string) $cosmoCards['Лазерная система Fotona SP Dynamis']['image']);
        $this->assertStringContainsString('woman-lifting.png', (string) $cosmoCards['Нитевой лифтинг']['image']);

        // Проверяем, что свёрнутые направления также получили обложку (не null)
        $dermCards = collect($byTitle['Дерматология']['cards']);
        $this->assertNotEmpty($dermCards->first()['image']);

        // Проверяем рендер компонента service-card с ч/б фильтром grayscale
        $rendered = view('components.service-card', [
            'title'    => 'Пластика лица',
            'image'    => $plasticCards['Пластика лица']['image'],
            'services' => $plasticCards['Пластика лица']['services']->all(),
        ])->render();

        $this->assertStringContainsString('grayscale', $rendered);

        // Проверяем, что цветные обложки для /uslugi/plasticheskaya-hirurgiya не затёрты ч/б вариантами
        $plastikaLitsa = ServiceCategory::where('slug', 'plastika-litsa')->with('media')->firstOrFail();
        $this->assertStringContainsString('gallery/service11.png', (string) $plastikaLitsa->coverUrl());
    }

    public function test_accordions_and_dropdowns_use_smooth_collapse_and_no_press_scale(): void
    {
        $this->seed(ServiceSeeder::class);
        $this->seed(MainPageServicesSeeder::class);

        foreach (['/', '/faq', '/documents', '/prices'] as $url) {
            $response = $this->get($url);
            $response->assertStatus(200);
            $html = $response->getContent();

            $this->assertStringContainsString('x-collapse.duration.450ms', $html, "Missing smooth collapse on {$url}");
            $this->assertStringContainsString('no-scale', $html, "Missing no-scale trigger on {$url}");
            $this->assertStringNotContainsString('<details class="price-card', $html);
        }
    }
}
