<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->text(50);
        return [
            'user_id'           => random_int(1, 10),
            'category_id'       => random_int(1, 10),
            'title'             => $title,
            'content'           => $this->faker->realText(),
            'slug'              => Str::slug($title),
            'thumbnail_path'    => $this->faker->image('public/backend/images')
        ];
    }
}
