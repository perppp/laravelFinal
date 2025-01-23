<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            RolesTableSeeder::class,
            JobsTableSeeder::class,
            ApplicationsTableSeeder::class,
            CategoriesTableSeeder::class,
            JobCategoriesTableSeeder::class,
        ]);
    }
}
