<?php

namespace Database\Factories;

use App\Models\Sub_category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class Sub_categoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sub_category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = $this->faker->name;
        return [
            'category_id'   => random_int(1, 20),
            'name'          => $category,
            'slug'          => Str::slug($category),
            'status'        => random_int(0, 1)
        ];
    }
}