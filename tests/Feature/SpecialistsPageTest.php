<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Expert;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SpecialistsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_specialists_index_page_is_accessible(): void
    {
        $dept = Department::create(['name' => 'Руководство', 'slug' => 'rukovodstvo', 'sort_order' => 1]);

        Expert::create([
            'department_id' => $dept->id,
            'name' => 'Сергеева Евгения Александровна',
            'slug' => 'sergeeva-evgeniya',
            'position' => 'Заместитель директора по медицинской части',
            'is_active' => true,
        ]);

        $response = $this->get('/spetsialisty');

        $response->assertStatus(200);
        $response->assertSee('Наши специалисты');
        $response->assertSee('Сергеева Евгения Александровна');
        $response->assertSee('Руководство');
    }

    public function test_specialists_alias_redirects(): void
    {
        $response = $this->get('/specialists');

        $response->assertRedirect('/spetsialisty');
    }

    public function test_specialist_detail_page_is_accessible(): void
    {
        $dept = Department::create(['name' => 'Руководство', 'slug' => 'rukovodstvo', 'sort_order' => 1]);

        $expert = Expert::create([
            'department_id' => $dept->id,
            'name' => 'Сергеева Евгения Александровна',
            'slug' => 'sergeeva-evgeniya',
            'position' => 'Заместитель директора по медицинской части',
            'experience_since' => '2002',
            'operations_count' => 34,
            'positive_percent' => 90,
            'activities' => [
                'Диагностика, профилактика и консервативное лечение заболеваний ЛОР-органов у детей и взрослых',
                'Отоневрология',
            ],
            'is_active' => true,
        ]);

        $response = $this->get('/spetsialisty/' . $expert->slug);

        $response->assertStatus(200);
        $response->assertSee('Сергеева Евгения Александровна');
        $response->assertSee('с 2002 года');
        $response->assertSee('Направление деятельности:');
        $response->assertSee('Отоневрология');
    }
}
