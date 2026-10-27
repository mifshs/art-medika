<?php

namespace Tests\Feature;

use App\Models\Faq;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaqPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_faq_page_is_accessible(): void
    {
        Faq::create([
            'question' => 'Насколько безопасны методы и оборудование?',
            'answer' => 'Мы используем только сертифицированные технологии.',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $response = $this->get('/faq');

        $response->assertStatus(200);
        $response->assertSee('Вопросы и ответы');
        $response->assertSee('Прозрачность медицинской помощи начинается с понятных ответов');
        $response->assertSee('Насколько безопасны методы и оборудование?');
        $response->assertSee('Мы используем только сертифицированные технологии.');
    }

    public function test_voprosy_i_otvety_redirects_to_faq(): void
    {
        $response = $this->get('/voprosy-i-otvety');

        $response->assertRedirect('/faq');
    }
}
