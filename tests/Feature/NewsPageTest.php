<?php

namespace Tests\Feature;

use App\Models\ContentCategory;
use App\Models\Expert;
use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_news_page_is_accessible(): void
    {
        $category = ContentCategory::create(['name' => 'Хирургия', 'slug' => 'hirurgiya']);
        $expert = Expert::create(['name' => 'Dr.Gaja', 'slug' => 'dr-gaja']);

        News::create([
            'content_category_id' => $category->id,
            'expert_id' => $expert->id,
            'type' => 'article',
            'title' => 'Пластический хирург о бьюти-трендах',
            'slug' => 'plasticheskiy-hirurg',
            'excerpt' => 'Весной 2025 года усилилось стремление к естественности',
            'content' => '<p>Текст статьи</p>',
            'published_at' => now(),
            'is_active' => true,
        ]);

        $response = $this->get('/news');

        $response->assertStatus(200);
        $response->assertSee('Новости');
        $response->assertSee('В этом разделе мы собираем всё');
        $response->assertSee('Пластический хирург о бьюти-трендах');
        $response->assertSee('Статья / Хирургия');
    }

    public function test_novosti_redirects_to_news(): void
    {
        $response = $this->get('/novosti');

        $response->assertRedirect('/news');
    }

    public function test_news_detail_page_is_accessible(): void
    {
        $category = ContentCategory::create(['name' => 'Хирургия', 'slug' => 'hirurgiya']);
        $expert = Expert::create(['name' => 'Dr.Gaja', 'slug' => 'dr-gaja']);

        $news = News::create([
            'content_category_id' => $category->id,
            'expert_id' => $expert->id,
            'type' => 'article',
            'title' => 'Пластический хирург о бьюти-трендах',
            'slug' => 'plasticheskiy-hirurg-detail',
            'excerpt' => 'Краткое описание',
            'content' => '<p>Полный текст подробной статьи о трендах</p>',
            'published_at' => now(),
            'is_active' => true,
        ]);

        $response = $this->get('/news/' . $news->slug);

        $response->assertStatus(200);
        $response->assertSee('Пластический хирург о бьюти-трендах');
        $response->assertSee('Полный текст подробной статьи о трендах');
    }
}
