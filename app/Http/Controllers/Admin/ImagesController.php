<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Auth;
use App\Libs\WithImg;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
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

    public function store(Request $request){
        $request->validate([
            'img_upload' => 'mimes:jpeg,png,jpg|max:5120',
        ]);
    $user = Auth::user()->name;
    $file = $request->file('img_upload');
    $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME).'-blog';
    if ($request->hasFile('img_upload')) {
            $img = new WithImg();
            $photo = $img->getImageFileName($file, url_slug( $file_name),False, 825);
        }
        if(!$photo){
        Log::info('Image store',['user'=>$user]);
        return redirect(route('images'))->withErrors(['msg'=>'Виникла помилка запису фото']);
        }
        else{
        Log::error('Image store',['user'=>$user]);
        return redirect(route('images'))->with('msg','Фото завантажено');
        }
    }
}
