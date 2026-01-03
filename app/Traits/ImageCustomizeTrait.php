<?php

namespace App\Traits;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
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
        try {
            // Store in public disk to ensure proper symlink access
            $image_name = $image->store("public/$path");
            // Remove 'public/' prefix for the public path since symlink handles it
            $storage_path = str_replace('public/', '', $image_name);
            $image_public_path = public_path('storage/' . $storage_path);

            if ($width != null && $height != null) {
                // Check if file exists and is readable before processing
                if (file_exists($image_public_path) && is_readable($image_public_path)) {
                    try {
                        Image::make($image_public_path)->resize($width, $height)->save();
                    } catch (\Exception $e) {
                        // If resize fails, log the error but continue without resizing
                        Log::error('Image resize failed: ' . $e->getMessage());
                    }
                } else {
                    Log::error('Image file not readable: ' . $image_public_path);
                }
            }

            $image_path = "storage/$storage_path";
            return $image_path;

        } catch (\Exception $e) {
            Log::error('Image upload failed: ' . $e->getMessage());
            throw new \Exception('Failed to upload image: ' . $e->getMessage());
        }
    }



    public static function uploadImageFromBase64($base64Image, $path, $width = null, $height = null)
    {
        try {
            // Validate input
            if (empty($base64Image)) {
                throw new \Exception('Base64 image data is empty');
            }

            $imageName = uniqid() . '.png';
            $storagePath = "storage/$path";
            $fullPath = public_path($storagePath);
            $imagePath = public_path("$storagePath/$imageName");

            // Check if folder exists, if not, create it
            if (!file_exists($fullPath)) {
                if (!mkdir($fullPath, 0777, true)) {
                    throw new \Exception('Failed to create directory: ' . $fullPath);
                }
            }

            // Validate base64 image data format
            if (!preg_match('/^data:image\/(\w+);base64,/', $base64Image, $matches)) {
                throw new \Exception('Invalid base64 image format');
            }

            // Extract image type
            $imageType = $matches[1];
            $allowedTypes = ['jpeg', 'jpg', 'png', 'gif', 'webp'];

            if (!in_array(strtolower($imageType), $allowedTypes)) {
                throw new \Exception('Unsupported image type: ' . $imageType);
            }

            // Decode base64 data
            $decodedImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));

            if ($decodedImage === false || empty($decodedImage)) {
                throw new \Exception('Failed to decode base64 image data');
            }

            // Save the image file
            $result = file_put_contents($imagePath, $decodedImage);
            if ($result === false) {
                throw new \Exception('Failed to save image file to: ' . $imagePath);
            }

            // Verify file was created and is readable
            if (!file_exists($imagePath) || !is_readable($imagePath)) {
                throw new \Exception('Image file not accessible after creation');
            }

            // Resize if dimensions are provided
            if ($width && $height && $width > 0 && $height > 0) {
                try {
                    $image = Image::make($imagePath);
                    $image->resize($width, $height)->save($imagePath);
                } catch (\Exception $e) {
                    // Log resize error but don't fail the upload
                    Log::warning('Image resize failed but upload succeeded: ' . $e->getMessage());
                }
            }

            return "$storagePath/$imageName";

        } catch (\Exception $e) {
            // Clean up any partially created files
            if (isset($imagePath) && file_exists($imagePath)) {
                @unlink($imagePath);
            }

            // Log the error for debugging
            Log::error('Image upload from base64 failed', [
                'error' => $e->getMessage(),
                'path' => $path ?? 'unknown',
                'width' => $width,
                'height' => $height
            ]);

            // Re-throw with more context
            throw new \Exception('Image upload failed: ' . $e->getMessage());
        }
    }    /**
     * Fallback method for base64 upload without resizing
     */
    public static function uploadImageFromBase64Simple($base64Image, $path)
    {
        try {
            if (empty($base64Image)) {
                throw new \Exception('Base64 image data is empty');
            }

            $imageName = uniqid() . '.png';
            $storagePath = "storage/$path";
            $fullPath = public_path($storagePath);
            $imagePath = public_path("$storagePath/$imageName");

            // Create directory if it doesn't exist
            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0777, true);
            }

            // Decode and save
            $decodedImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
            file_put_contents($imagePath, $decodedImage);

            return "$storagePath/$imageName";

        } catch (\Exception $e) {
            Log::error('Simple image upload failed: ' . $e->getMessage());
            throw new \Exception('Image upload failed: ' . $e->getMessage());
        }
    }


}
