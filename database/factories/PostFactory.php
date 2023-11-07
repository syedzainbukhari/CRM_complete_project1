<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Post;
use App\Models\User;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Post::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Use the new factory() method to create a User model instance
            'title' => $this->faker->sentence,
            'post_image' => $this->faker->imageUrl('900', '300'),
            'body' => $this->faker->paragraph,
        ];
    }
}
