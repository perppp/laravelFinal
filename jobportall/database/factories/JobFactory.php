<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition()
    {
        $category = Category::inRandomOrder()->first();

        if (!$category) {
            $category = Category::factory()->create();
        }

        return [
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraph,
            'category_id' => $category->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
