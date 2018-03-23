<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ImagesController extends Controller
{
    public function __invoke()
    {
        $path = 'public/img/';
        $not_showing = array($path . 'no_image.png', $path . 'wm.png');
        $public_path = Storage::url($path);
        $arr = Storage::files($path);
        foreach ($arr as $file) {
            if (in_array($file, $not_showing)) {
                continue;
            }
            $images[] = str_replace($path, $public_path, $file);
        }
        return view('admin.pages.images')->with('images', $images);
    }
}
