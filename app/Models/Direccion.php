<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = "direcciones";

    protected $guarded =['id'];

    // Relacion pertenece a un Usuario
    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
