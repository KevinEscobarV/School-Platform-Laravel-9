<?php

namespace Database\Seeders;

use App\Models\TipoVivienda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoViviendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = ['Casa independiente', 'Vivienda aislada', 'Vivienda pareada', 'Vivienda adosada', 'Estudio', 'Apartamento', 'Piso', 'Dúplex', 'Ático', 'Bajo', 'Buhardilla', 'Loft',];

        foreach ($tipos as $tipo) {
            TipoVivienda::create([
                'tipo' => $tipo
            ]);
        }
    }
}
