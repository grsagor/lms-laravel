<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();

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
    public function assignment() {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }
}
