<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RouteTest extends TestCase
{
    /** @test */
    public function it_tests_a_public_route()
    {
        $response = $this->get('/api/public-jobs');
        $response->assertStatus(200);
    }

    /** @test */
    public function it_tests_a_404_response_for_an_invalid_route()
    {
        $response = $this->get('/api/invalid-route');
        $response->assertStatus(404);
    }

    /** @test */
    public function it_returns_a_successful_response_on_home()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
