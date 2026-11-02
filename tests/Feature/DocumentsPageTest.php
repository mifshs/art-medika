<?php

namespace Tests\Feature;

use App\Models\Document;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DocumentsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_documents_page_is_accessible(): void
    {
        Document::create([
            'category' => 'Нормативно-правовые документы',
            'title' => 'Правила предоставления платных медицинских услуг',
            'file_url' => 'documents/sample-document.pdf',
            'sort_order' => 1,
            'published_at' => now(),
        ]);

        $response = $this->get('/documents');

        $response->assertStatus(200);
        $response->assertSee('Документы');
        $response->assertSee('Нормативно-правовые документы');
        $response->assertSee('Правила предоставления платных медицинских услуг');
    }

    public function test_dokumenty_alias_redirects(): void
    {
        $response = $this->get('/dokumenty');

        $response->assertRedirect('/documents');
    }

    public function test_document_download(): void
    {
        $doc = Document::create([
            'category' => 'Организационные документы',
            'title' => 'Лицензия',
            'file_url' => 'documents/sample-document.pdf',
            'sort_order' => 1,
            'published_at' => now(),
        ]);

        $response = $this->get('/documents/download/' . $doc->id);

        $response->assertStatus(200);
        $response->assertHeader('content-disposition');
    }
}
