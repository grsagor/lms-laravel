<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
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

        static::deleting(function ($assignment) {
            $files = json_decode($assignment->files);
            foreach ($files as $file) {
                $filePath = public_path($file);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
        });
    }

    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }
}
