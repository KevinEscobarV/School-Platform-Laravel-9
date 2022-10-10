<?php

namespace Database\Seeders;

use App\Models\Asignatura;
use App\Models\Curso;
use App\Models\Tema;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AsignaturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $primaria = ['Matemáticas', 'Lengua', 'Ciencias', 'Historia', 'Geografía', 'Biología', 'Física', 'Química', 'Artes'];
        $secundaria = ['Matemáticas', 'Lengua', 'Ciencias', 'Historia', 'Geografía', 'Biología', 'Física', 'Química', 'Artes'];

        $cursos = Curso::all();

        foreach ($cursos as $curso) {
            if ($curso->seccion == 'primaria') {
                $profesor = User::factory()->create()->assignRole('Profesor');
                foreach ($primaria as $asignatura) {                 
                    $curso->asignaturas()->create([
                        'nombre' => $asignatura,
                        'codigo' => Str::lower($asignatura . $curso->id . $curso->seccion),
                        'descripcion' => 'Asignatura de ' . $asignatura . ' para el curso de primaria',
                        'profesor_id' => $profesor->id,
                    ]);
                }
            } else {
                $profesor = User::factory()->create()->assignRole('Profesor');
                foreach ($secundaria as $asignatura) {
                    $curso->asignaturas()->create([
                        'nombre' => $asignatura,
                        'codigo' => Str::upper($asignatura . $curso->id . $curso->seccion),
                        'descripcion' => 'Asignatura de ' . $asignatura . ' para el curso de secundaria',
                        'profesor_id' => $profesor->id,
                    ]);
                }
            }
        }

    }
}
