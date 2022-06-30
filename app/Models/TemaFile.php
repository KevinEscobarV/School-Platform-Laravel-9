<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemaFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_path',
        'tema_id',
    ];

    public function tema()
    {
        return $this->belongsTo(Tema::class);
    }
}
