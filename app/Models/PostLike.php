<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    use HasFactory;

    public function post()
    {
        return $this->belongsTo(AllPost::class, 'post_id' , 'id');
    }
}
