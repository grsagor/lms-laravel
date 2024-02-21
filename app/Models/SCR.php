<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class SCR extends Model
{
    use HasFactory;
    protected $table = 'scr';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = substr(uniqid(), 0, 13).'-stlout-'.random_int(10000000000000000, 99999999999999999);
        });
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
