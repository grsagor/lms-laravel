<?php

namespace App\Models;

use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function getFilesAttribute($value) {
        $files = json_decode($value);
        $results = [];
        foreach ($files as $file) {
            $filePath = $file;
            $filename = pathinfo($filePath, PATHINFO_BASENAME);
            $extension = pathinfo($filename, PATHINFO_EXTENSION);

            $results[] = [
                'path' => $file,
                'name' => FileHelper::getOriginalFilename($filename),
                'extension' => $extension
            ];
        }

        return $results;
    }
}
