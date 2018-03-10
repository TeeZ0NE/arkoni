<?php

namespace App\Libs;

use Image; //http://image.intervention.io/getting_started/introduction
use Illuminate\Support\Facades\Storage;

class WithImg
{
    /**
     *
     * @param $file
     * @param $ru_name file name
     * @param $file_ext file extension
     * @param int $width
     * @return string
     */
    public function set_image($file, $ru_name, $file_ext, $width = 300)
    {
        $file_name = time() . url_slug($ru_name) . '.' . $file_ext;
        $public_path = config('app.img_path');
        Storage::putFileAs('public/img', $file, $file_name);
        $img = Image::make($public_path . $file_name)
            ->resize($width, null, function ($constraint) {
                $constraint->AspectRatio();
//                $constraint->upsize();
            })
            // ->text('The quick brown fox jumps over the lazy dog.', 50, 150)
            ->insert($public_path . 'wm.png', 'center');
            $img->save();
        return $file_name;
        // print_r(Storage::allFiles('public/img'));
    }
    /**
     * removing file from disk
     * if file doesn't default file 'no_image.png' remove it
     * @param String $photo image file name
     * @return null
     */
    public function delete_photo($photo)
    {
        if ($photo !== 'no_image.png') {
            Storage::delete('public/img/' . $photo);
        }
    }
}

