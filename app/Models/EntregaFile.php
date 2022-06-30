<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class EntregaFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'entrega_id',
    ];

    public function entrega()
    {
        return $this->belongsTo(Entrega::class);
    }
}
