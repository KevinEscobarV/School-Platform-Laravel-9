<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Eliana',
            'apellido'=> 'Alvarado Lopez',
            'identificacion'=> '32132456421',
            'email' => 'eliana@unisangil.edu.co',
            'email_verified_at' => now(),
            'password' => bcrypt('eliana12345')
        ])->assignRole('Super Admin');

        User::create([
            'name' => 'Juan',
            'apellido'=> 'Perez',
            'identificacion'=> '45421675242864',
            'email' => 'profesor@unisangil.edu.co',
            'email_verified_at' => now(),
            'password' => bcrypt('profesor12345'),
        ])->assignRole('Profesor');
    }
}
