<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolWork extends Model
{
    use HasFactory;

    protected $table = 'school_works';

    protected $fillable = [
        'nombre',
        'contenido',
        'fecha_inicio',
        'fecha_fin',
        'files',
        'edit',
        'tema_id',
    ];

    public function tema()
    {
        return $this->belongsTo(Tema::class);
    }

    public function entregas()
    {
        return $this->hasMany(Entrega::class);
    }

    public function getFechaInicioCarbonAttribute()
    {
        return \Carbon\Carbon::parse($this->fecha_inicio); 

    }

    public function getFechaFinCarbonAttribute()
    {
        return \Carbon\Carbon::parse($this->fecha_fin);
    }   

    public function getRouteKeyName()
    {
        return 'nombre';
    }
}
