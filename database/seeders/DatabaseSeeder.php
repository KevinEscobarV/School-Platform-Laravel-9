<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('images');
        Storage::makeDirectory('images');

        Storage::deleteDirectory('images_entregas');
        Storage::makeDirectory('images_entregas');

        Storage::deleteDirectory('files_entregas');
        Storage::makeDirectory('files_entregas');

        Storage::deleteDirectory('files_temas');
        Storage::makeDirectory('files_temas');

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            GeneroSeeder::class,
            TipoSangreSeeder::class,
            TipoViviendaSeeder::class,
            CategoryPostSeeder::class,
            CursoSeeder::class,
            AsignaturaSeeder::class,
            TemaSeeder::class,
            SchoolWorkSeeder::class,
        ]);

        \App\Models\User::factory(50)->create();

        \App\Models\Post::factory(50)->create();

        \App\Models\Comment::factory(50)->create();

        $students = User::doesntHave('roles')->get();

        foreach ($students as $student) {
            $student->assignRole('Estudiante');
            $student->curso_id = Curso::all()->random()->id;
            $student->save();
        }
    }
}
