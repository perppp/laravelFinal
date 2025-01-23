<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;

class ApplicationsTableSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Application::factory()->count(10)->create();
    }
}
