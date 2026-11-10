<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactsPageTest extends TestCase
{
    use RefreshDatabase;
    public function test_contacts_page_returns_successful_response(): void
    {
        $response = $this->get('/kontakty');

        $response->assertStatus(200);
        $response->assertSee('Контакты');
        $response->assertSee('Челябинск');
        $response->assertSee('Телефоны');
        $response->assertSee('E-mail');
        $response->assertSee('Режим работы');
    }

    public function test_contacts_alias_redirects_to_contacts(): void
    {
        $response = $this->get('/contacts');

        $response->assertRedirect('/kontakty');
    }
}
