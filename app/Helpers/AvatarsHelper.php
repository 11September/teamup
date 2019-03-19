<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 019 19.03.19
 * Time: 16:24
 */

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;

class AvatarsHelper
{
    /**
     * storeBase64Image Method
     *
     * @param  [string] data - base64
     *
     * @return [json] path to image
     */

    public static function storeBase64Image($data)
    {
        $folderPath = "images/uploads/avatars/";
        $image_parts = explode(";base64,", $data);

        if (!$image_parts || !isset($image_parts[1]) || $image_parts[1] == null || $image_parts[1] == "") {
            return null;
        }

        explode("image/", $image_parts[0]);
        $image_base64 = base64_decode($image_parts[1]);
        $imageName = time() . "-" . uniqid() . '.png';

        File::put(storage_path('app/public/images/uploads/avatars/') . $imageName, $image_base64);
        $path = "/" . $folderPath . $imageName;

        return $path;
    }




    /**
     * deletePreviousImage Method
     *
     * @param  [string] data - base64
     *
     * @return [json] path to image
     */

    public static function deletePreviousImage(string $data)
    {
        $preview = storage_path('app/public') . $data;
        if (file_exists($preview)) {
            unlink($preview);
        }

        return true;
    }
}
