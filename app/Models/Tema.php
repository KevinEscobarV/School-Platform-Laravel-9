<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'contenido',
        'slug',
        'asignatura_id',
    ];

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    public function school_works()
    {
        return $this->hasMany(SchoolWork::class);
    }

    public function tema_files()
    {
        return $this->hasMany(TemaFile::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d/m/Y - h:i a');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
