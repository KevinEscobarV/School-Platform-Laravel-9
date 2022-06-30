<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntregaImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'entrega_id',
        'user_id',
    ];

    public function entrega()
    {
        return $this->belongsTo(Entrega::class);
    }
}
