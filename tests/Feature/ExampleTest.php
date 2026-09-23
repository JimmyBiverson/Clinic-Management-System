<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Guest hitting the root is redirected toward login.
     */
    public function test_the_application_returns_a_redirect_for_guests(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(route('dashboard'));
    }
}
