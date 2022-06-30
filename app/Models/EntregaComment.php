<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntregaComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'entrega_id',
        'user_id',
        'comment',
    ];

    public function entrega()
    {
        return $this->belongsTo(Entrega::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
