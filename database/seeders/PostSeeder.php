<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'user_id'           => 1,
            'category_id'       => 1,
            'title'             => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta, laudantium?',
            'content'           => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta, laudantium? Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero dicta esse quo tempora qui animi voluptates ipsa aliquid quaerat nemo! ',
            'thumbnail_path'    => 'photo_607e7f3a9bf4b4.345608964wZDRynhq9.png'
        ]);
    }
}