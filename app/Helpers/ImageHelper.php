<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;

class ImageHelper
{
    public static function saveImage(UploadedFile $image)
    {
        if ($image) {
            $image_name = rand(123456, 999999) . '.' . $image->getClientOriginalExtension();
            $image_path = public_path('upload');
            $image->move($image_path, $image_name);
            return '/upload/' . $image_name;
        }
        return null;
    }
    public static function saveImages($images)
    {
        if (!is_array($images)) {
            $images = [$images];
        }
        $imageUrls = [];
        foreach ($images as $image) {
            if ($image) {
                $image_name = rand(123456, 999999) . '.' . $image->getClientOriginalExtension();
                $image_path = public_path('upload');
                $image->move($image_path, $image_name);
                $imageUrls[] = '/upload/' . $image_name;
            }
        }
        return $imageUrls;
    }
}
