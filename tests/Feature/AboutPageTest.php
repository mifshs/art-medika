<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\ServiceCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_about_page_is_accessible(): void
    {
        $response = $this->get('/o-centre');

        $response->assertStatus(200);
        $response->assertSee('О клинике');
        $response->assertSee('Превращаем заветные мечты пациентов');
        $response->assertSee('Поликлиническое отделение');
        $response->assertSee('Стационарное отделение');
    }

    public function test_about_aliases_redirect(): void
    {
        $response1 = $this->get('/o-klinike');
        $response1->assertRedirect('/o-centre');

        $response2 = $this->get('/about');
        $response2->assertRedirect('/o-centre');
    }
}
