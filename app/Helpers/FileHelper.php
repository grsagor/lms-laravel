<?php

namespace App\Helpers;

class FileHelper
{
    public static function saveFiles($files)
    {
        if (!is_array($files)) {
            $files = [$files];
        }
        $fileUrls = [];
        foreach ($files as $file) {
            if ($file) {
                $file_name = $file->getClientOriginalName();
                $file_path = public_path('upload');
                $file->move($file_path, $file_name);
                $fileUrls[] = '/upload/' . $file_name;
            }
        }
        return $fileUrls;
    }
}
