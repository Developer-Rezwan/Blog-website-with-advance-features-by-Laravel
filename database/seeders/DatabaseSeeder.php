<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* Factory sedeer */
        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(20)->create();
        \App\Models\Sub_category::factory(20)->create();
        \App\Models\Post::factory(50)->create();

        /* Database sedeer */
        /*         $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            PostSeeder::class
        ]); */
    }
}