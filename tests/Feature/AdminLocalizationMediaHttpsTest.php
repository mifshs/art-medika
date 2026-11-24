<?php

namespace Tests\Feature;

use App\Filament\Resources\DocumentResource\Pages\EditDocument;
use App\Filament\Resources\ExpertResource\Pages\CreateExpert;
use App\Filament\Resources\ExpertResource\Pages\EditExpert;
use App\Filament\Resources\ProjectResource\Pages\EditProject;
use App\Filament\Resources\ProjectResource\RelationManagers\FormatsRelationManager;
use App\Filament\Resources\ServiceResource\RelationManagers\CasesRelationManager;
use App\Filament\Support\MediaUpload;
use App\Models\Appointment;
use App\Models\Document;
use App\Models\Expert;
use App\Models\News;
use App\Models\Project;
use App\Models\Promotion;
use App\Models\Review;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use Database\Seeders\ContentSeeder;
use Database\Seeders\ExpertSeeder;
use Database\Seeders\MainPageServicesSeeder;
use Database\Seeders\MiscSeeder;
use Database\Seeders\ServiceSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class AdminLocalizationMediaHttpsTest extends TestCase
{
    use RefreshDatabase;

    private const TINY_PNG_BASE64 = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==';

    private function createAdmin(): User
    {
        return User::factory()->create([
            'name'     => 'Администратор',
            'email'    => 'admin-test@art-medika.ru',
            'is_admin' => true,
        ]);
    }

    private function seedCatalog(): void
    {
        $this->seed(ServiceSeeder::class);
        $this->seed(MainPageServicesSeeder::class);
        $this->seed(ExpertSeeder::class);
        $this->seed(ContentSeeder::class);
        $this->seed(MiscSeeder::class);
    }

    public function test_admin_panel_uses_russian_locale_and_renders_all_resources_with_previews(): void
    {
        $this->seedCatalog();

        Appointment::create([
            'patient_name' => 'Иван Иванов',
            'phone'        => '+7 (900) 000-00-00',
            'status'       => 'new',
        ]);

        // Страница входа на русском
        $loginHtml = $this->get('/admin/login')->assertStatus(200)->getContent();
        $this->assertStringContainsString('lang="ru"', $loginHtml);
        $this->assertStringContainsString('Войти', $loginHtml);

        $admin = $this->createAdmin();
        $this->actingAs($admin);

        // Дашборд на русском
        $dashboardHtml = $this->get('/admin')->assertStatus(200)->getContent();
        $this->assertStringContainsString('Инфопанель', $dashboardHtml);
        $this->assertStringContainsString('Добро пожаловать', $dashboardHtml);
        $this->assertStringContainsString('Выход', $dashboardHtml);

        // Списки ресурсов с превью из БД
        $expertsHtml = $this->get('/admin/experts')->assertStatus(200)->getContent();
        $this->assertStringContainsString('/storage/avatar/irina.webp', $expertsHtml);
        $this->assertStringContainsString('Создать', $expertsHtml);

        $newsHtml = $this->get('/admin/news')->assertStatus(200)->getContent();
        $this->assertStringContainsString('/storage/gallery/news.webp', $newsHtml);

        $projectsHtml = $this->get('/admin/projects')->assertStatus(200)->getContent();
        $this->assertStringContainsString('/storage/cover/concert.webp', $projectsHtml);

        $promotionsHtml = $this->get('/admin/promotions')->assertStatus(200)->getContent();
        $this->assertStringContainsString('/storage/cover/woman-lifting.webp', $promotionsHtml);

        $categoriesHtml = $this->get('/admin/service-categories')->assertStatus(200)->getContent();
        $this->assertStringContainsString('/storage/gallery/services1.webp', $categoriesHtml);

        $servicesHtml = $this->get('/admin/services')->assertStatus(200)->getContent();
        $this->assertStringContainsString('/storage/', $servicesHtml);

        $docsHtml = $this->get('/admin/documents')->assertStatus(200)->getContent();
        $this->assertStringContainsString('/storage/docs/sertificate1.webp', $docsHtml);

        $reviewsHtml = $this->get('/admin/reviews')->assertStatus(200)->getContent();
        $this->assertStringContainsString('Отзывы', $reviewsHtml);

        // Статусы заявок отображаются по-русски
        $appointmentsHtml = $this->get('/admin/appointments')->assertStatus(200)->getContent();
        $this->assertStringContainsString('Новая', $appointmentsHtml);
    }

    public function test_media_upload_helper_resolves_legacy_cdn_png_and_blocks_traversal(): void
    {
        $this->assertSame(
            'avatar/irina.webp',
            MediaUpload::resolvePublicPath('avatar/irina.png')
        );
        $this->assertSame(
            'docs/sertificate2.webp',
            MediaUpload::resolvePublicPath('https://cdn.jsdelivr.net/gh/mifshs/art-medika-media@main/docs/sertificate2.png')
        );
        $this->assertSame(
            'cover/image 34.webp',
            MediaUpload::resolvePublicPath('/storage/cover/image%2034.png')
        );
        $this->assertNull(MediaUpload::resolvePublicPath('review-0'));
        $this->assertNull(MediaUpload::resolvePublicPath('../../.env'));
        $this->assertSame('/storage/cover/image%2034.webp', MediaUpload::publicUrl('cover/image 34.webp'));
    }

    public function test_edit_pages_hydrate_legacy_media_and_cdn_document_previews_from_db(): void
    {
        $this->seedCatalog();
        $this->actingAs($this->createAdmin());

        // Специалист с legacy .png путём в БД (как на живой БД medika)
        $expert = Expert::where('slug', 'kuznecova-irina')->firstOrFail();
        $expert->media()->where('collection', 'avatar')->update([
            'disk' => 'github',
            'path' => 'avatar/irina.png',
            'url'  => 'https://cdn.jsdelivr.net/gh/mifshs/art-medika-media@main/avatar/irina.png',
        ]);

        $expertTest = Livewire::test(EditExpert::class, ['record' => $expert->getRouteKey()]);
        $avatarState = array_values((array) $expertTest->get('data.media_avatar'));
        $this->assertSame(['avatar/irina.webp'], $avatarState);

        // Проект с обложкой и галереей
        $project = Project::where('slug', 'krasota-v-tebe')->firstOrFail();
        $projectTest = Livewire::test(EditProject::class, ['record' => $project->getRouteKey()]);
        $this->assertSame(['cover/concert.webp'], array_values((array) $projectTest->get('data.media_cover')));
        $this->assertCount(4, array_values((array) $projectTest->get('data.media_gallery')));

        // Документ с legacy CDN URL на .png -> гидрируется в локальный .webp
        $doc = Document::create([
            'category'     => 'Лицензии',
            'title'        => 'Сертификат тест',
            'file_url'     => 'https://cdn.jsdelivr.net/gh/mifshs/art-medika-media@main/docs/sertificate2.png',
            'sort_order'   => 1,
            'published_at' => now(),
        ]);
        $docTest = Livewire::test(EditDocument::class, ['record' => $doc->getRouteKey()]);
        $this->assertSame(['docs/sertificate2.webp'], array_values((array) $docTest->get('data.file_url')));
    }

    public function test_creating_and_updating_records_uploads_and_syncs_media_table(): void
    {
        Storage::fake('public');
        $this->actingAs($this->createAdmin());

        $pngBytes = base64_decode(self::TINY_PNG_BASE64);
        $file1 = UploadedFile::fake()->createWithContent('doctor.png', $pngBytes);

        // 1. Создание специалиста с загрузкой превью
        Livewire::test(CreateExpert::class)
            ->fillForm([
                'name'         => 'Тестовый Специалист',
                'slug'         => 'testovyy-specialist',
                'sort_order'   => 10,
                'is_active'    => true,
                'media_avatar' => $file1,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $expert = Expert::where('slug', 'testovyy-specialist')->with('media')->firstOrFail();
        $avatar = $expert->media->firstWhere('collection', 'avatar');
        $this->assertNotNull($avatar);
        $this->assertSame('public', $avatar->disk);
        $this->assertTrue(Storage::disk('public')->exists($avatar->path));
        $this->assertStringStartsWith('/storage/avatar/', $avatar->url);

        // 2. Замена превью на Edit-странице (как работает FilePond: удаление старого и загрузка нового файла)
        $file2 = UploadedFile::fake()->createWithContent('doctor-new.png', $pngBytes);
        Livewire::test(EditExpert::class, ['record' => $expert->getRouteKey()])
            ->set('data.media_avatar', [])
            ->fillForm([
                'media_avatar' => $file2,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $expert->refresh()->load('media');
        $newAvatar = $expert->media->firstWhere('collection', 'avatar');
        $this->assertNotNull($newAvatar);
        $this->assertNotSame($avatar->path, $newAvatar->path);
        $this->assertTrue(Storage::disk('public')->exists($newAvatar->path));

        // 2b. Удаление превью на Edit-странице очищает media
        Livewire::test(EditExpert::class, ['record' => $expert->getRouteKey()])
            ->set('data.media_avatar', [])
            ->call('save')
            ->assertHasNoFormErrors();

        $expert->refresh()->load('media');
        $this->assertNull($expert->media->firstWhere('collection', 'avatar'));

        // 2c. Загрузка обложки и галереи для проекта
        $project = Project::create([
            'title'     => 'Тест проект',
            'slug'      => 'test-proekt',
            'is_active' => true,
        ]);
        $g1 = UploadedFile::fake()->createWithContent('g1.png', $pngBytes);
        $g2 = UploadedFile::fake()->createWithContent('g2.png', $pngBytes);
        Livewire::test(EditProject::class, ['record' => $project->getRouteKey()])
            ->fillForm([
                'media_cover'   => UploadedFile::fake()->createWithContent('proj.png', $pngBytes),
                'media_gallery' => [$g1, $g2],
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $project->refresh()->load('media');
        $this->assertNotNull($project->media->firstWhere('collection', 'cover'));
        $this->assertCount(2, $project->media->where('collection', 'gallery'));

        // 3. Проверка RelationManagers (проекты -> форматы, услуги -> кейсы)
        Livewire::test(FormatsRelationManager::class, [
            'ownerRecord' => $project,
            'pageClass'   => EditProject::class,
        ])->assertSuccessful();

        $cat = ServiceCategory::create([
            'name'      => 'Тест категория',
            'slug'      => 'test-kat',
            'is_active' => true,
        ]);
        $service = Service::create([
            'service_category_id' => $cat->id,
            'name'                => 'Тест услуга',
            'slug'                => 'test-usluga',
            'is_active'           => true,
        ]);
        Livewire::test(CasesRelationManager::class, [
            'ownerRecord' => $service,
            'pageClass'   => \App\Filament\Resources\ServiceResource\Pages\EditService::class,
        ])->assertSuccessful();
    }

    public function test_https_requests_generate_https_urls_without_mixed_content(): void
    {
        $this->seedCatalog();

        $response = $this->get('https://localhost/');
        $response->assertStatus(200);
        $html = $response->getContent();

        $this->assertStringContainsString('<link rel="canonical" href="https://localhost">', $html);
        $this->assertStringContainsString('<meta property="og:url" content="https://localhost">', $html);
        $this->assertStringContainsString('content="https://localhost/storage/', $html);
        $this->assertStringNotContainsString('href="http://localhost', $html);
        $this->assertStringNotContainsString('src="http://localhost', $html);

        $sitemap = $this->get('https://localhost/sitemap.xml')->assertStatus(200)->getContent();
        $this->assertStringContainsString('<loc>https://localhost</loc>', $sitemap);
        $this->assertStringNotContainsString('<loc>http://localhost', $sitemap);

        // Reverse proxy заголовок X-Forwarded-Proto: https
        $proxied = $this->withHeaders(['X-Forwarded-Proto' => 'https'])
            ->get('http://art-medika.ru/o-centre');
        $proxied->assertStatus(200);
        $this->assertStringContainsString('https://art-medika.ru/o-centre', $proxied->getContent());
    }
}
