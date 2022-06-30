<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment', 'user_id', 'post_id'
    ];

    public function getGetCreatedAtAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getGetUpdatedAtAttribute()
    {
        return $this->updated_at->diffForHumans();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
