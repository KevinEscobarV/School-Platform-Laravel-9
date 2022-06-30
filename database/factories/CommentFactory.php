<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    public function definition()
    {
        $autor = User::all()->random();
        $post = Post::all()->random();

        return [
            'comment' => $this->faker->sentence(),
            'user_id' => $autor->id,
            'post_id' => $post->id,
        ];
    }
}
