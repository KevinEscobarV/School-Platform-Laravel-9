<?php

namespace Database\Factories;

use App\Models\CategoryPost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{

    protected $model = Post::class;

    public function definition()
    {
        $title = $this->faker->sentence(2);

        $autor = User::all()->random();

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => $this->faker->text(3000),
            'category_id' => CategoryPost::all()->random()->id,
            'user_id' => $autor->id,
            'is_draft' => false,
        ];
    }
}
