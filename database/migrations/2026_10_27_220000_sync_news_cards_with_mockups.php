<?php

use App\Models\ContentCategory;
use App\Models\Expert;
use App\Models\News;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $hirurgiyaId = ContentCategory::where('slug', 'hirurgiya')->value('id');
        $kosmetologiyaId = ContentCategory::where('slug', 'kosmetologiya')->value('id');
        $krasotaId = ContentCategory::where('slug', 'krasota-v-tebe')->value('id');
        $expertId = Expert::where('slug', 'dr-gaja')->value('id');

        // Дополнительные новости и статьи по макету Figma для заполнения сетки из 10 карточек и пагинации
        $items = [
            [
                'slug' => 'dostupnaya-plasticheskaya-hirurgiya-iz-milana-v-rossii',
                'type' => 'news',
                'content_category_id' => $kosmetologiyaId,
                'expert_id' => null,
                'title' => 'Доступная пластическая хирургия из Милана в России',
                'excerpt' => 'Сертифицированный пластический хирург с правом оперирования на территории нашей страны Dr.Gaja внедряет авторские методики.',
                'content' => '<p>Сертифицированный пластический хирург с правом оперирования на территории нашей страны Dr.Gaja внедряет авторские методики: нитевой лифтинг, мезоботокс.</p>',
                'published_at' => '2025-04-07',
                'cover_path' => 'cover/project1.png',
                'cover_alt' => 'Доступная пластическая хирургия из Милана в России',
            ],
            [
                'slug' => 'otzyvy-pacientov-nasha-gordost-2',
                'type' => 'news',
                'content_category_id' => $kosmetologiyaId,
                'expert_id' => null,
                'title' => 'Отзывы пациентов — наша гордость!',
                'excerpt' => 'Высокий уровень доверия и качества медицинской помощи подтверждает рейтинг нашей клиники — 4.5 на основе 118 отзывов.',
                'content' => '<p>Высокий уровень доверия и качества медицинской помощи подтверждает рейтинг нашей клиники.</p>',
                'published_at' => '2025-04-11',
                'cover_path' => 'cover/project1.png',
                'cover_alt' => 'Отзывы пациентов — наша гордость!',
            ],
            [
                'slug' => 'final-4-sezona-krasota-v-tebe-2',
                'type' => 'news',
                'content_category_id' => $krasotaId,
                'expert_id' => null,
                'title' => 'Финал 4 сезона международного проекта "Красота в тебе"',
                'excerpt' => 'Международный социальный проект-преображение завершился финальным шоу.',
                'content' => '<p>Международный социальный проект-преображение завершился финальным шоу.</p>',
                'published_at' => '2025-03-12',
                'cover_path' => 'cover/concert2.png',
                'cover_alt' => 'Финал 4 сезона международного проекта "Красота в тебе"',
            ],
            [
                'slug' => 'otzyvy-pacientov-nasha-gordost-3',
                'type' => 'news',
                'content_category_id' => $kosmetologiyaId,
                'expert_id' => null,
                'title' => 'Отзывы пациентов — наша гордость!',
                'excerpt' => 'Высокий уровень доверия и качества медицинской помощи подтверждает рейтинг нашей клиники — 4.5 на основе 118 отзывов.',
                'content' => '<p>Высокий уровень доверия и качества медицинской помощи подтверждает рейтинг нашей клиники.</p>',
                'published_at' => '2025-04-11',
                'cover_path' => 'cover/project1.png',
                'cover_alt' => 'Отзывы пациентов — наша гордость!',
            ],
            [
                'slug' => 'final-4-sezona-krasota-v-tebe-3',
                'type' => 'news',
                'content_category_id' => $krasotaId,
                'expert_id' => null,
                'title' => 'Финал 4 сезона международного проекта "Красота в тебе"',
                'excerpt' => 'Международный социальный проект-преображение завершился финальным шоу.',
                'content' => '<p>Международный социальный проект-преображение завершился финальным шоу.</p>',
                'published_at' => '2025-03-12',
                'cover_path' => 'cover/concert2.png',
                'cover_alt' => 'Финал 4 сезона международного проекта "Красота в тебе"',
            ],
            [
                'slug' => 'otzyvy-pacientov-nasha-gordost-4',
                'type' => 'news',
                'content_category_id' => $kosmetologiyaId,
                'expert_id' => null,
                'title' => 'Отзывы пациентов — наша гордость!',
                'excerpt' => 'Высокий уровень доверия и качества медицинской помощи подтверждает рейтинг нашей клиники — 4.5 на основе 118 отзывов.',
                'content' => '<p>Высокий уровень доверия и качества медицинской помощи подтверждает рейтинг нашей клиники.</p>',
                'published_at' => '2025-04-11',
                'cover_path' => 'cover/project1.png',
                'cover_alt' => 'Отзывы пациентов — наша гордость!',
            ],
            [
                'slug' => 'final-4-sezona-krasota-v-tebe-4',
                'type' => 'news',
                'content_category_id' => $krasotaId,
                'expert_id' => null,
                'title' => 'Финал 4 сезона международного проекта "Красота в тебе"',
                'excerpt' => 'Международный социальный проект-преображение завершился финальным шоу.',
                'content' => '<p>Международный социальный проект-преображение завершился финальным шоу.</p>',
                'published_at' => '2025-03-12',
                'cover_path' => 'cover/concert2.png',
                'cover_alt' => 'Финал 4 сезона международного проекта "Красота в тебе"',
            ],
            [
                'slug' => 'osvezhitsya-no-ne-bolee-2',
                'type' => 'article',
                'content_category_id' => $hirurgiyaId,
                'expert_id' => $expertId,
                'title' => '"Освежиться, но не более!" Пластический хирург Dr.Gaja о бьюти-трендах и операциях.',
                'excerpt' => 'Весной 2025 года усилилось стремление к естественности, даже при перманентном макияже предпочтение отдаётся натуральным цветам.',
                'content' => '<p>Погоня за модой в пластической хирургии редко заканчивается хорошо. В индустрии красоты смена трендов происходит стремительно.</p>',
                'published_at' => '2025-04-07',
                'cover_path' => 'gallery/news.png',
                'cover_alt' => '"Освежиться, но не более!" Пластический хирург Dr.Gaja о бьюти-трендах и операциях.',
            ],
            // Несколько записей для пагинации (страницы 2..15)
            [
                'slug' => 'otzyvy-pacientov-nasha-gordost-5',
                'type' => 'news',
                'content_category_id' => $kosmetologiyaId,
                'expert_id' => null,
                'title' => 'Отзывы пациентов — наша гордость!',
                'excerpt' => 'Высокий уровень доверия и качества медицинской помощи подтверждает рейтинг нашей клиники.',
                'content' => '<p>Высокий уровень доверия и качества медицинской помощи.</p>',
                'published_at' => '2025-04-05',
                'cover_path' => 'cover/project1.png',
                'cover_alt' => 'Отзывы пациентов — наша гордость!',
            ],
            [
                'slug' => 'final-4-sezona-krasota-v-tebe-5',
                'type' => 'news',
                'content_category_id' => $krasotaId,
                'expert_id' => null,
                'title' => 'Финал 4 сезона международного проекта "Красота в тебе"',
                'excerpt' => 'Международный социальный проект-преображение завершился финальным шоу.',
                'content' => '<p>Международный социальный проект-преображение завершился финальным шоу.</p>',
                'published_at' => '2025-03-01',
                'cover_path' => 'cover/concert2.png',
                'cover_alt' => 'Финал 4 сезона международного проекта "Красота в тебе"',
            ],
        ];

        foreach ($items as $data) {
            $coverPath = $data['cover_path'];
            $coverAlt = $data['cover_alt'];
            unset($data['cover_path'], $data['cover_alt']);

            $news = News::updateOrCreate(['slug' => $data['slug']], $data);

            DB::table('media')->updateOrInsert(
                [
                    'model_type' => 'App\\Models\\News',
                    'model_id'   => $news->id,
                    'collection' => 'cover',
                ],
                [
                    'disk'       => 'github',
                    'path'       => $coverPath,
                    'url'        => 'https://cdn.jsdelivr.net/gh/mifshs/art-medika-media@main/' . $coverPath,
                    'alt'        => $coverAlt,
                    'sort_order' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }

    public function down(): void
    {
        $slugs = [
            'dostupnaya-plasticheskaya-hirurgiya-iz-milana-v-rossii',
            'otzyvy-pacientov-nasha-gordost-2',
            'final-4-sezona-krasota-v-tebe-2',
            'otzyvy-pacientov-nasha-gordost-3',
            'final-4-sezona-krasota-v-tebe-3',
            'otzyvy-pacientov-nasha-gordost-4',
            'final-4-sezona-krasota-v-tebe-4',
            'osvezhitsya-no-ne-bolee-2',
            'otzyvy-pacientov-nasha-gordost-5',
            'final-4-sezona-krasota-v-tebe-5',
        ];

        $newsIds = News::whereIn('slug', $slugs)->pluck('id');
        DB::table('media')->where('model_type', 'App\\Models\\News')->whereIn('model_id', $newsIds)->delete();
        News::whereIn('id', $newsIds)->delete();
    }
};
