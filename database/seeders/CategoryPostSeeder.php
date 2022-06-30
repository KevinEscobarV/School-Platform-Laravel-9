<?php

namespace Database\Seeders;

use App\Models\CategoryPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Entretenimiento', 'Deportes', 'Ciencia', 'Tecnología', 'Otros'];

        foreach ($categories as $category) {
            CategoryPost::create([
                'name' => $category,
                'slug' => Str::slug($category)
            ]);
        }
    }
}
