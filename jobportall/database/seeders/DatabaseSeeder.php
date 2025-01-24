<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CategoriesTableSeeder::class,
            UsersTableSeeder::class,
            RolesTableSeeder::class,
            JobsTableSeeder::class,
            JobCategoriesTableSeeder::class,
            ApplicationsTableSeeder::class,
        ]);
    }
}
