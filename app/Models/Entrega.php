<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'contenido',
        'school_work_id',
        'student_id',
    ];

    public function school_work()
    {
        return $this->belongsTo(SchoolWork::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function entrega_files()
    {
        return $this->hasMany(EntregaFile::class);
    }

    public function entrega_comments()
    {
        return $this->hasMany(EntregaComment::class);
    }

    public function entrega_images()
    {
        return $this->hasMany(EntregaImage::class);
    }

    public function getRouteKeyName()
    {
        return 'titulo';
    }
}
