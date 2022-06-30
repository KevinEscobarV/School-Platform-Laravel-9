<?php

namespace Database\Seeders;

use App\Models\Genero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $generos = ['Hombre', 'Mujer', 'Otro', 'Prefiero no decirlo'];

        foreach ($generos as $genero) {
            Genero::create([
                'nombre' => $genero
            ]);
        }
    }
}