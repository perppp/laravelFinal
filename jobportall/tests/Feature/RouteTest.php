<?php

namespace Tests\Feature;

use Tests\TestCase;

class RouteTest extends TestCase
{
    /** @test */
    public function it_tests_a_public_route()
    {
        $response = $this->get('/api/public-jobs');
        $response->assertStatus(200);
    }

    /** @test */
    public function it_tests_a_protected_route_for_employers()
    {
        // Obtain a valid token here, either from a login method or a predefined token
        $token = 'some-valid-token'; // Replace with actual token generation logic

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->post('/api/employer/post-job', [
            'title' => 'New Job Posting',
            'description' => 'Looking for an experienced Laravel developer.',
            'salary' => 60000,
        ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_tests_a_404_response_for_an_invalid_route()
    {
        $response = $this->get('/api/invalid-route');
        $response->assertStatus(404);
    }
}
