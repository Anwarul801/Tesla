<?php

namespace App\Traits;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Facades\File;


trait ImageCustomizeTrait{

    /**
     * @param $img_name
     * @param null $attribute
     * @param int $width
     * @param string $file_extension
     * @return null|string
     */


    public static function deleteImage($image){
        if ($image == '') {
            return null;
        }
        if (file_exists(public_path()."/".$image)) {
            unlink(public_path()."/$image");
        }
    }

    public static function uploadImage($image, $path, $width = null, $height = null)
    {
        $image_name = $image->store("$path");
        $image_public_path = public_path('storage/' . $image_name);
        if ($width != null && $height != null){
            Image::make($image_public_path)->resize($width, $height)->save();
        }
        $image_path = "storage/$image_name";
        return $image_path;
    }



    public static function uploadImageFromBase64($base64Image, $path, $width = null, $height = null)
    {
        $imageName = uniqid() . '.png';
        $imagePath = public_path("storage/$path/$imageName");

        // Check if folder exists, if not, create it
        if (!file_exists(public_path("storage/$path"))) {
            mkdir(public_path("storage/$path"), 0777, true);
        }

        $decodedImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));

        // Store and resize
        file_put_contents($imagePath, $decodedImage);
        if ($width && $height) {
            Image::make($imagePath)->resize($width, $height)->save();
        }

        return "storage/$path/$imageName";
    }


}
