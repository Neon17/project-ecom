<?php

namespace Tests\Feature;

use Tests\TestCase;

class PageTest extends TestCase
{
    public function test_guest_can_visit_about_page()
    {
        $response = $this->get(route('about'));
        $response->assertStatus(200);
        $response->assertSee('About Us');
    }

    public function test_guest_can_visit_contact_page()
    {
        $response = $this->get(route('contact'));
        $response->assertStatus(200);
        $response->assertSee('Get in Touch');
    }

    public function test_guest_can_submit_contact_form()
    {
        $response = $this->post(route('contact.submit'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Test Subject',
            'message' => 'Test Message'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }

    public function test_contact_form_validation()
    {
        $response = $this->post(route('contact.submit'), []);
        $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
    }
}
