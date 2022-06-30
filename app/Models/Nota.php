<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nota',
        'school_work_id',
        'student_id',
    ];

    public function school_work()
    {
        return $this->belongsTo(SchoolWork::class, 'school_work_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function getNotaAttribute($value)
    {
        return number_format($value, 2);
    }
}
