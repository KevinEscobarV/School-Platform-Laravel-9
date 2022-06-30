<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $primaria = ['Primero', 'Segundo', 'Tercero', 'Cuarto', 'Quinto'];
        $secundaria = ['Sexto', 'Septimo', 'Octavo', 'Noveno', 'Decimo', 'Onceavo'];

        foreach ($primaria as $curso) {
            \App\Models\Curso::create([
                'nombre' => $curso,
                'nivel' => 'A',
                'modalidad' => 'presencial',
                'jornada' => 'mañana',
                'seccion' => 'primaria',
                'descripcion' => 'Curso de ' . $curso . ' A',
            ]);

            \App\Models\Curso::create([
                'nombre' => $curso,
                'nivel' => 'B',
                'modalidad' => 'presencial',
                'jornada' => 'tarde',
                'seccion' => 'primaria',
                'descripcion' => 'Curso de ' . $curso . ' B',
            ]);
        }

        foreach ($secundaria as $curso){
            \App\Models\Curso::create([
                'nombre' => $curso,
                'nivel' => 'A',
                'modalidad' => 'presencial',
                'jornada' => 'mañana',
                'seccion' => 'secundaria',
                'descripcion' => 'Curso de ' . $curso . ' A',
            ]);

            \App\Models\Curso::create([
                'nombre' => $curso,
                'nivel' => 'B',
                'modalidad' => 'presencial',
                'jornada' => 'tarde',
                'seccion' => 'secundaria',
                'descripcion' => 'Curso de ' . $curso . ' B',
            ]);
        }
    }
}
