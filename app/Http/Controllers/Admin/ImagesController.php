<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Auth;
use App\Libs\WithImg;
use Illuminate\Http\Request;
use Exception;

class ImagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * index page 4 images
     * @return view with images 4 blog
     */
    public function index()
    {
        $path = 'public/img/blog';
        $not_showing = array($path . 'no_image.png', $path . 'wm.png');
        $public_path = Storage::url($path);
        $arr = Storage::files($path);
        $images = array();
        foreach ($arr as $file) {
            if (in_array($file, $not_showing)) {
                continue;
            }
            $images[str_replace($path.'/',Null,$file)] = str_replace($path, $public_path, $file);
        }
        return view('admin.pages.images')->with('images', $images);
    }

    /**
     * storing new image 4 blog
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $request->validate([
            'img_upload' => 'required|mimes:jpeg,png,jpg|max:5120',
        ]);
    $user = Auth::user()->name;
    $file = $request->file('img_upload');
    $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME).'-blog';
    if ($request->hasFile('img_upload')) {
            $img = new WithImg();
            $photo = $img->getImageFileName($file, url_slug( $file_name),False, 825,True);
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

    /**
     * destroying image on server
     * @param $file
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function destroy($file){
        $img = new WithImg();
        $user = Auth::user()->name;
        try {
            $img->delete_photo($file, True);
        }catch(Exception $e){
            Log::error('Image destroy',['msg'=>$e->getMessage(),'user'=>$user]);
            return redirect(route('images'))->withErrors(['msg'=>'Сталась помилка видалення файлу']);
        }
        Log::info('Image destroy',['user'=>$user]);
        return redirect(route('images'))->with('msg','Зображення видалено');
    }
}
