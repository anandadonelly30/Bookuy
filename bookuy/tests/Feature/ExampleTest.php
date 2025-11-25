<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        // Root now redirects first to /dashboard (auth protected). We assert that initial redirect.
        $response->assertStatus(302)->assertRedirect('/dashboard');

        // Follow redirects and ensure we land on login page eventually
        $final = $this->followingRedirects()->get('/');
        $final->assertStatus(200)->assertSee('Log in');
    }
}
