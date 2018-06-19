<?php

namespace App\Libs;

use Image; //http://image.intervention.io/getting_started/introduction
use Illuminate\Support\Facades\Storage;

class WithImg
{
    private $blog_path = 'blog/';
    private $public_path = 'public/img/';
    /**
     *
     * @param $file
     * @param $ru_name file name
     * @param $file_ext file extension
     * @param int $width
     * @param Boolean $water_mark boolean set or not watermark
     * @param  String $blog_path blog path
     * @return string
     */
    public function set_image($file, $ru_name, $file_ext,  $water_mark, $width, $blog_path)
    {
        $file_name = time() . url_slug($ru_name) . '.' . $file_ext;
        $public_path = config('app.img_path');
        Storage::putFileAs($this->public_path.$blog_path, $file, $file_name);
        $img = Image::make($public_path.$blog_path . $file_name)
            ->resize($width, $width, function ($constraint) {
                $constraint->AspectRatio();
//                $constraint->upsize();
            });
        if ($water_mark) {
            // ->text('The quick brown fox jumps over the lazy dog.', 50, 150)
            $img->insert($public_path . 'wm.png', 'bottom-right');
        }

        $img->save(null, 75);
        return $file_name;
        // print_r(Storage::allFiles('public/img'));
    }

    /**
     * removing file from disk
     * if file doesn't default file 'no_image.png' remove it
     * @param String $photo image file name
     * @param Boolean $is_blog does it blog image
     * @return null
     */
    public function delete_photo($photo, $is_blog = False)
    {$blog_path =($is_blog)?$this->blog_path:Null;
        if ($photo !== config('app.img_default')) {
            Storage::delete($this->public_path .$blog_path. $photo);
        }
    }

    /**
     * Storing file with name by default it's ru_name transliterate
     * @param File $file img_upload
     * @param String $name
     * @param  boolean $water_mark
     * @param Integer $width image size
     * @param  Boolean $is_blog does is blog image
     * @return string image file name
     */
    public function getImageFileName($file, $name, $water_mark = True, $width = 300,$is_blog = False)
    {
        $blog_path = ($is_blog)?$this->blog_path:Null;
        $file_ext = $file->extension();
        $photo = $this->set_image($file, $name, $file_ext, $water_mark, $width, $blog_path);
        return $photo;
    }

	public function copyImage(String $file){
		#check image and store it with added hash name
		if (Storage::disk('local')->has($this->public_path.$file)){
			preg_match("/(?:[-\w\d]+)\.(?P<ext>\w{3,})$/", $file, $output_array);
			$ext =  !($output_array['ext'])?:$output_array['ext'];
			$new_file = uniqid().".$ext";
			$res = Storage::copy($this->public_path.$file, $this->public_path.$new_file);
			if($res) {
				return $new_file;
			};
		}
		return Null;
	}
}

