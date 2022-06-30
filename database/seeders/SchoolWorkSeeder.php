<?php

namespace Database\Seeders;

use App\Models\SchoolWork;
use App\Models\Tema;
use App\Models\TemaFile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temas = Tema::all();

        foreach ($temas as $tema) {
            SchoolWork::factory(3)->create([
                'tema_id' => $tema->id,
            ]);
            TemaFile::create([
                'name' => 'test.pdf',
                'tema_id' => $tema->id,
                'file_path' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ]);
            TemaFile::create([
                'name' => 'test_2.pdf',
                'tema_id' => $tema->id,
                'file_path' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ]);

        }

    }
}
