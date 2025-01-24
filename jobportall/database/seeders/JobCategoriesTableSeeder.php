<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('job_categories')->insert([
            'job_id' => 1,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
