<?php

namespace Database\Seeders;

use App\Models\ContentCategory;
use App\Models\Expert;
use App\Models\News;
use App\Models\Promotion;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    use SeedsMedia;

    public function run(): void
    {
        $categories = [];
        foreach (['kosmetologiya' => 'Косметология', 'hirurgiya' => 'Хирургия', 'krasota-v-tebe' => 'Красота в тебе'] as $slug => $name) {
            $categories[$slug] = ContentCategory::updateOrCreate(['slug' => $slug], ['name' => $name]);
        }

        // ── Новости и статьи ──
        $news = [
            [
                'slug' => 'osvezhitsya-no-ne-bolee',
                'type' => 'article',
                'category' => 'hirurgiya',
                'author' => 'dr-gaja',
                'title' => '"Освежиться, но не более!" Пластический хирург Dr.Gaja о бьюти-трендах и операциях.',
                'excerpt' => 'Весной 2025 года усилилось стремление к естественности, даже при перманентном макияже предпочтение отдаётся натуральным цветам.',
                'published_at' => '2025-04-07',
                'content' => '<p>Погоня за модой в пластической хирургии редко заканчивается хорошо. В индустрии красоты смена трендов происходит стремительно, а исправлять последствия неудачных операций приходится годами.</p><p>Сегодня в «Арт-Медика» состоялась закрытая лекция и серия консультаций с приглашенным экспертом — пластическим хирургом Dr.Gaja.</p><ol><li>Антитренды: Хирург категорически против больших объемов гиалуроновой кислоты.</li><li>Золотой стандарт: Липофилинг и эндоскопические методики.</li><li>Осторожность с новинками: «Лучшее — проверенный врач хорошего», — отметил эксперт.</li></ol><blockquote>«Пластическая операция должна быть настолько хороша, чтобы никто вокруг не догадался о вашем визите к хирургу».</blockquote>',
            ],
            [
                'slug' => 'otzyvy-pacientov-nasha-gordost',
                'type' => 'news',
                'category' => 'kosmetologiya',
                'author' => null,
                'title' => 'Отзывы пациентов — наша гордость!',
                'excerpt' => 'Высокий уровень доверия и качества медицинской помощи подтверждает рейтинг нашей клиники — 4.5 на основе 118 отзывов.',
                'published_at' => '2025-04-11',
                'content' => '<p>Высокий уровень доверия и качества медицинской помощи подтверждает рейтинг нашей клиники — 4.5 на основе 118 отзывов о врачах на сайте «Продокторов».</p>',
            ],
            [
                'slug' => 'final-4-sezona-krasota-v-tebe',
                'type' => 'news',
                'category' => 'krasota-v-tebe',
                'author' => null,
                'title' => 'Финал 4 сезона международного проекта "Красота в тебе"',
                'excerpt' => 'Международный социальный проект-преображение завершился финальным шоу.',
                'published_at' => '2025-03-12',
                'content' => '<p>Международный социальный проект-преображение «Красота в тебе» завершился финальным шоу, на котором участницы показали результаты преображения.</p>',
            ],
        ];
        foreach ($news as $item) {
            $model = News::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'content_category_id' => $categories[$item['category']]->id,
                    'expert_id' => $item['author'] ? Expert::where('slug', $item['author'])->value('id') : null,
                    'type' => $item['type'],
                    'title' => $item['title'],
                    'excerpt' => $item['excerpt'],
                    'content' => $item['content'],
                    'published_at' => $item['published_at'],
                ],
            );
            $this->attachMedia($model, 'cover', "news-{$item['slug']}", $item['title']);
        }

        // ── Акции ──
        $promotions = [
            [
                'slug' => 'nitevoy-lifting-lepestok-skidka-50',
                'service' => 'nitevoy-lifting',
                'title' => 'Нитевой лифтинг "Лепесток" скидка 50%',
                'excerpt' => 'Освежить лицо, подчеркнуть красоту и вернуть коже упругость. Уникальная методика "Лепесток" - это авторская методика, позволяющая эффективно подтянуть среднюю и нижнюю треть лица.',
                'discount' => 50,
                'published_at' => '2025-04-11',
                'content' => '<p>Освежить лицо, подчеркнуть красоту и вернуть коже упругость. Уникальная методика "Лепесток" - это авторская методика, позволяющая эффективно подтянуть среднюю и нижнюю треть лица, обеспечивая естественный и свежий вид кожи.</p><p>Dr.Gaja (Гаджимурад Хадисов) — практикующий пластический хирург, специалист по ринопластике и омолаживающим операциям лица.</p>',
            ],
            [
                'slug' => 'pure-molecule',
                'service' => null,
                'title' => 'PURE MOLECULE - инновационная технология омоложения',
                'excerpt' => 'МОЛЕКУЛА - программа комплексного омоложения организма, уникальная разработка европейских врачей-косметологов.',
                'discount' => null,
                'published_at' => '2025-04-07',
                'content' => '<p>МОЛЕКУЛА - программа комплексного омоложения организма, уникальная разработка европейских врачей-косметологов.</p>',
            ],
        ];
        foreach ($promotions as $p) {
            $model = Promotion::updateOrCreate(
                ['slug' => $p['slug']],
                [
                    'service_id' => $p['service'] ? Service::where('slug', $p['service'])->value('id') : null,
                    'title' => $p['title'],
                    'excerpt' => $p['excerpt'],
                    'content' => $p['content'],
                    'discount_percent' => $p['discount'],
                    'published_at' => $p['published_at'],
                ],
            );
            $this->attachMedia($model, 'cover', "promo-{$p['slug']}", $p['title']);
        }

        // ── Проекты ──
        $project = Project::updateOrCreate(
            ['slug' => 'krasota-v-tebe'],
            [
                'title' => 'Социальный проект «Красота в тебе»',
                'excerpt' => '«Красота в тебе» — социальный проект для жителей Челябинской области, которые хотят преобразиться, доверив свое преображение лучшим специалистам в своей сфере.',
                'description' => '«Красота в тебе» - социальный проект для жителей Челябинской области, которые хотят преобразиться, доверив свое преображение лучшим специалистам в своей сфере.',
                'mission' => 'Миссия проекта - показать, как внешние и внутренние перемены отразятся на жизни человека, дадут импульс, который еще и вдохновит других.',
                'stats' => [
                    ['value' => '11', 'label' => 'сезонов проекта'],
                    ['value' => '5026', 'label' => 'участников'],
                    ['value' => '35', 'label' => 'экспертов'],
                    ['value' => '67', 'label' => 'партнеров'],
                ],
                'published_at' => '2025-04-07',
            ],
        );
        $this->attachMedia($project, 'cover', 'project-krasota-v-tebe', 'Красота в тебе', '1600/700');

        foreach ([
            ['Индивидуальное преображение', 'Это отправная точка к новым возможностям, вдохновению и качественным переменам в жизни.'],
            ['Женский клуб «Красота в тебе»', 'Масштабное сообщество, открывающее женщинам широкие возможности для мотивации, вдохновения, самореализации, отдыха общения и развития'],
            ['Women баскет-лига', 'Резиденты клуба «Красота в тебе», успешные бизнес-леди объединяются в команды, тренируются с профессиональным тренером и играют в любительский баскетбол 3х3.'],
        ] as $i => [$title, $desc]) {
            $format = $project->formats()->updateOrCreate(
                ['title' => $title],
                ['description' => $desc, 'sort_order' => $i + 1],
            );
            $this->attachMedia($format, 'cover', "project-format-$i", $title, '700/500');
        }

        foreach ([
            'Оффлайн кастинг', 'Пресс-конференция', 'Работа с психологом',
            'Преображение у пластического хирурга', 'Красивая медицина от Арт-Медики',
            'Красивая улыбка от стоматологии', 'Преображение со стилистом',
            'Мастер-классы от экспертов и партнеров', 'Встречи женского клуба «Красота в тебе»', 'Финал проекта',
        ] as $i => $title) {
            $project->stages()->updateOrCreate(['title' => $title], ['sort_order' => $i + 1]);
        }

        foreach ([
            ['Dr. Gaja', 'Итальянский пластический хирург'],
            ['Ирина Кузнецова', 'Эксперт по красивой медицине'],
            ['Арт-Медика', 'Медицинский центр'],
            ['Гранд Успех', 'Стоматологическая клиника'],
            ['Юлия Капралова', 'Эксперт по стилю'],
            ['Людмила Шаяхметова', 'Психолог'],
        ] as $i => [$name, $role]) {
            $project->partners()->updateOrCreate(['name' => $name], ['role' => $role, 'sort_order' => $i + 1]);
        }

        // Галерея проекта — несколько фото в одной коллекции
        foreach (range(1, 4) as $n) {
            $project->media()->updateOrCreate(
                ['collection' => 'gallery', 'path' => "seed/project-gallery-$n"],
                ['disk' => 'external', 'url' => "https://picsum.photos/seed/project-gallery-$n/1200/800", 'alt' => "Фото проекта $n"],
            );
        }

        foreach ([
            ['dostupnaya-plasticheskaya-hirurgiya-iz-milana', 'Доступная пластическая хирургия из Милана в России', 'Российско-Итальянский проект. Сертифицированный пластический хирург с правом оперирования на территории нашей страны Dr.Gaja внедряет авторские методики.'],
            ['evropeyskaya-blefaroplastika-2025', 'Европейская блефаро-пластика 2025', 'Комплексная программа омоложения верхнего века, в виде хирургической пластики верхнего века и 3-х сеансов реабилитации тканей на европейской лазерной системе Fotona.'],
        ] as [$slug, $title, $excerpt]) {
            $model = Project::updateOrCreate(
                ['slug' => $slug],
                ['title' => $title, 'excerpt' => $excerpt, 'published_at' => '2025-04-07'],
            );
            $this->attachMedia($model, 'cover', "project-$slug", $title);
        }
    }
}