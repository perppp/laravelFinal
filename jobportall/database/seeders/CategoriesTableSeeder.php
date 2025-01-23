<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Category::create(['name' => 'Technology']);
        \App\Models\Category::create(['name' => 'Healthcare']);
        \App\Models\Category::create(['name' => 'Education']);
        \App\Models\Category::create(['name' => 'Finance']);
    }
}
