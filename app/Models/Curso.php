<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'nivel',
        'modalidad',
        'jornada',
        'seccion',
        'descripcion',
    ];

    public function students()
    {
        return $this->hasMany(User::class);
    }

    public function asignaturas()
    {
        return $this->hasMany(Asignatura::class);
    }

    public function getRouteKeyName()
    {
        return 'nombre';
    }
}
