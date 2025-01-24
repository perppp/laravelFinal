<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $job = Job::inRandomOrder()->first();
        
        return [
            'job_id' => $job ? $job->id : null,
            'user_id' => User::inRandomOrder()->first()->id,
            'cover_letter' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['pending', 'accepted', 'rejected']),
            'created_at' => now(),
        ];
    }
}
