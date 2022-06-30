<?php

namespace Database\Seeders;

use App\Models\Asignatura;
use App\Models\Tema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $asignaturas = Asignatura::all();

        foreach ($asignaturas as $asignatura) {
            Tema::factory(5)->create([
                'asignatura_id' => $asignatura->id,
            ]);
        }
    }
}
