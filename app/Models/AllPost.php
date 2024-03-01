<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Assignment;
use App\Models\Quiz;
use App\Models\Post;
use App\Models\User;

class AllPost extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }
    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'post_id');
    }
    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'post_id');
    }
    public function likes()
    {
        return $this->hasMany(PostLike::class, 'post_id', 'id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id')->orderBy('created_at', 'desc');
    }
}
