<?php

namespace Database\Seeders;

use App\Models\TipoSangre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoSangreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            [
            'tipo' => 'A',
            'rh' => '+'
            ],
            [
            'tipo' => 'B',
            'rh' => '+'
            ],
            [
            'tipo' => 'AB',
            'rh' => '+'
            ],
            [
            'tipo' => 'O',
            'rh' => '+'
            ],
            [
            'tipo' => 'A',
            'rh' => '-'
            ],
            [
            'tipo' => 'B',
            'rh' => '-'
            ],
            [
            'tipo' => 'AB',
            'rh' => '-'
            ],
            [
            'tipo' => 'O',
            'rh' => '-'
            ]
        ];

        foreach ($tipos as $tipo) {
            TipoSangre::create($tipo);
        }
    }
}
