<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Profesor']);
        Role::create(['name' => 'Estudiante']);

        Permission::create(['name' => 'blog.index', 'description' => 'Ver listado de blogs']);
        Permission::create(['name' => 'blog.create', 'description' => 'Crear blogs']);
        Permission::create(['name' => 'blog.edit', 'description' => 'Editar blogs']);
        Permission::create(['name' => 'blog.destroy', 'description' => 'Eliminar blogs']);

    }
}
