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

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = substr(uniqid(), 0, 13).'-stlout-'.random_int(10000000000000000, 99999999999999999);
        });
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
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
}
