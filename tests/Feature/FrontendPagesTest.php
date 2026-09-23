<?php

namespace Tests\Feature;

use Tests\TestCase;

class FrontendPagesTest extends TestCase
{
    public function test_public_frontend_pages_render(): void
    {
        $this->get('/')->assertRedirect(route('dashboard'));
        $this->get('/home')->assertStatus(200)->assertSee('Where Compassion and Healing Come Together');
        $this->get('/home/doctors')->assertStatus(200)->assertSee('Doctors Of All Departments');
        $this->get('/home/about_us')->assertStatus(200)->assertSee('About Us');
        $this->get('/home/appointment')->assertStatus(200)->assertSee('Make An Appointment');
        $this->get('/home/blog')->assertStatus(200)->assertSee('Blog');
        $this->get('/home/contact_us')->assertStatus(200)->assertSee('Contact Us');
    }
}
