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
                $unique_id = substr(uniqid(), 0, 13);

                $file_name = $file->getClientOriginalName();
                $file_name = $unique_id . '[]' . $file_name;

                $file_path = public_path('upload');
                $file->move($file_path, $file_name);
                $fileUrls[] = '/upload/' . $file_name;
            }
        }
        return json_encode($fileUrls);
    }

    public static function getOriginalFilename($filename_with_id)
    {
        $parts = explode('[]', $filename_with_id);
        array_shift($parts);
        $original_filename = implode('-', $parts);
        return $original_filename;
    }
}
