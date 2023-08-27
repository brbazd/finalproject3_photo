<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublic($query)
    {
        $query->where('is_private',false);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likers()
    {
        return $this->belongsToMany(User::class, 'likes', 'photo_id', 'user_id');
    }
}
