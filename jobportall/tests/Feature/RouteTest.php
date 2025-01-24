<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_tests_a_public_route()
    {
        $response = $this->get('/api/public-jobs');
        $response->assertStatus(200);
    }

    /** @test */
    public function it_tests_a_protected_route_for_employers()
    {
        $user = User::factory()->create([
            'email' => 'employer@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Generate Sanctum token
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->postJson('/api/employer/post-job', [
            'title' => 'New Job Posting',
            'description' => 'Looking for an experienced Laravel developer.',
            'salary' => 60000,
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'title' => 'New Job Posting',
            'salary' => 60000
        ]);
    }

    /** @test */
    public function it_tests_a_protected_route_for_job_seekers()
    {
        $user = User::factory()->create([
            'email' => 'jobseeker@example.com',
            'password' => Hash::make('password123'),
        ]);

        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->getJson('/api/job-seeker/jobs');

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
