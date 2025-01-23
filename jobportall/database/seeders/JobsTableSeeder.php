<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Job;

class JobsTableSeeder extends Seeder
{
    public function run()
{
    $categories = Category::factory()->count(10)->create();

    Job::factory()->count(10)->create();
}
}
