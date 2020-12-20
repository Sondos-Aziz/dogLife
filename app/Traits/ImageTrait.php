<?php

namespace App\Traits;


trait ImageTrait
{

    function saveImages($image, $folder)
    {
        // if(Request::hasFile('file')){
        $fileExtension = $image->getClientOriginalExtension();
        $fileName = time() . '.' . $fileExtension;
        $path = $folder;
        $image->move($path, $fileName);
        return $fileName;
    }
}
