<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'is_draft',
        'user_id',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryPost::class);
    }

    public function isDraft()
    {
        return $this->is_draft;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function getGetLimitBodyAttribute()
    {
        return substr($this->body, 0, 200) . '...';
    }

    public function getGetCreatedAtAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getGetUpdatedAtAttribute()
    {
        return $this->updated_at->diffForHumans();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
