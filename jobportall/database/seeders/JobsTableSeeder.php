<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Job;
use App\Models\Category;

class JobsTableSeeder extends Seeder
{
    public function run()
    {
        $jobs = Job::factory()->count(10)->create();

        foreach ($jobs as $job) {
            $category = Category::firstOrCreate([
                'name' => 'sit',
            ]);

            DB::table('job_categories')->insert([
                'job_id' => $job->id,
                'category_id' => $category->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
