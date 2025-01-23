<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobCategory;

class JobCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        \App\Models\JobCategory::create([
            'job_id' => 1,
            'category_id' => 1,
        ]);
        \App\Models\JobCategory::create([
            'job_id' => 2,
            'category_id' => 2,
        ]);
    }
}
