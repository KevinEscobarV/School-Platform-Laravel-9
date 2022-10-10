<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Asignatura extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion',
        'banner_path',
        'curso_id',
        'profesor_id',
    ];

    public function getBannerUrlAttribute()
    {
        return $this->banner_path
                    ? Storage::url($this->banner_path)
                    : $this->defaultBannerUrl();
    }

    protected function defaultBannerUrl()
    {
        return asset('img/default-banner.jpg');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'profesor_id');
    }

    public function temas()
    {
        return $this->hasMany(Tema::class);
    }

    public function getRouteKeyName()
    {
        return 'codigo';
    }
}
