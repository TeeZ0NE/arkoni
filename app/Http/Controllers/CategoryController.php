<?php

namespace App\Http\Controllers;

use App\Libs\WithImg;
use App\Models\Category;
use App\Models\RuCategory;
use App\Models\UkCategory;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException as QE;
use App\Models\Category as Cat;
use Auth;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Log;
use Exception;

//use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Count of page on paginate
     * @var int
     */
    private $page_count = 10;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $cat = new Cat;
        return view('admin.pages.categories')->with([
            'cats' => $cat->searchAndSort(),
            'count' => $cat::count(),
            'sort' => 'asc',
        ]);
    }

    /**
     * destroy main category
     * @param Int $id category id
     * @return Message return back
     */
    public function destroy($id)
    {
        try {
            $cat = new Cat;
            $photo = $cat::findOrFail($id)->cat_photo;
            $cat::findOrFail($id)->delete();
            $img = new WithImg();
            $img->delete_photo($photo);
        } catch (QE $qe) {
            //TODO: remove debug info below $me
            return redirect()->back()->withErrors(['msg' => 'Виникла помилка з видаленням. Вірогідно використовується в підкатегоріях.' . '<br>' . $qe]);
        }
        session()->flash('msg', 'Категорію видалено з бази');
        return redirect(route('cats.index'));
    }

    /**
     * create new category.
     * Not Used.
     * Adding could just from Tinker or DB instances. Do not forget add nested fields in RuCategory and UkCategory Models or tables!
     * @return Object error message at now
     */
    public function create()
    {
        return view('admin.pages.category_create');
    }

    /**
     * Search name in [RU|UK] Categories
     * @param Request $request
     * @return $this
     */
    public function search(Request $request)
    {
        $request->flash();
        $sort = $request->sort;
        $q = $request->q;
        $cat = new Cat;
        return view('admin.pages.categories')->with([
            'cats' => $cat->searchAndSort($q, $sort),
            'count' => $cat::count(),
            'sort' => $sort,
        ]);
    }

    /**
     * Update info about category
     * @param Integer $id category ID
     * @return $this
     */
    public function edit($id)
    {
        $cat = new Cat;
        return view('admin.pages.category_edit')->with([
            'id' => $id,
            'cat' => $cat::with(['RuCategory', 'UkCategory'])->findOrFail($id),
        ]);
    }

    /**
     * updating existing category
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'uk_name' => 'max:255|required',
            'ru_name' => 'max:255|required',
            'uk_title' => 'max:70|required',
            'ru_title' => 'max:70|required',
            'uk_desc' => 'max:255|required',
            'ru_desc' => 'max:255|required',
            'cat_url_slug' => 'required|max:250',
            'img_upload' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $id = $request->id;
        $cat = new Cat;
        $storeImg = new WithImg;
        $photo = $cat::find($id)->cat_photo;
        if ($request->hasFile('img_upload')) {
            // removing old photo
            $storeImg->delete_photo($photo);
            $photo = $storeImg->getImageFileName($request->file('img_upload'), $request->ru_name, False);
        }
        try {
            $cat::findOrFail($id)->update([
                'cat_url_slug' => 'c-'.$request->cat_url_slug,
                'cat_photo' => $photo,
            ]);
            $this->storeLangCat($request, $id);
        } catch (QE $qe) {
            return redirect()
                ->back()
                ->withErrors(['cat_error' => "Сталась помилка запису змін.\r\n" . $qe]);
        }
        session()->flash('msg', 'Зміни внесено!');
        return redirect()->back();
    }

    /**
     * storing new category
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'uk_name' => 'max:255|unique:uk_categories|required',
            'ru_name' => 'max:255|unique:ru_categories|required',
            'uk_title' => 'max:70|required',
            'ru_title' => 'max:70|required',
            'uk_desc' => 'max:255|required',
            'ru_desc' => 'max:255|required',
            'img_upload' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $photo = config('app.img_default');
        if ($request->hasFile('img_upload')) {
            $img = new WithImg();
            $photo = $img->getImageFileName($request->file('img_upload'), $request->ru_name, False);
        }
        $cat_id = $this->storeNewCat($request->ru_name, $photo);
        try {
            if (!$cat_id) {
                throw new Exception("Основний запис не зроблено");
            }
            // storing RU and UK category
            $res = $this->storeLangCat($request, $cat_id);
            if (!$res) {
                throw new Exception('Язикові файли не було записано');
            }
        } catch (Exception $e) {
            Log::error('Error to write category', ["mes" => $e]);
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }
        session()->flash('msg', 'Категорію створено');
        return redirect(route('cats.index'));
    }


    /**
     * @param String $ru_name retrieve RU name of category
     * @return Int $id ID current ID of stored category
     */
    private function storeNewCat($ru_name, $photo)
    {
        $cat = new Category;
        $cat->cat_url_slug = 'c-'.url_slug($ru_name);
        $cat->cat_photo = $photo;
        $cat->save();
        return $cat->id;
    }

    /**
     * inserting or updating lang files
     * @param Request $request
     * @param Int $cat_id if exist update else update
     * @return Boolean store or  not
     */
    private function storeLangCat(Request $request, $cat_id)
    {
        $ru_cat = new RuCategory;
        $uk_cat = new UkCategory;
        $ru = $ru_cat::updateOrCreate(['cat_id' => $cat_id], [
            'ru_name' => $request->ru_name,
            'title' => $request->ru_title,
            'desc' => $request->ru_desc,
            'h1' => $request->ru_h1,
            'h2' => $request->ru_h2,
            'seo_text' => $request->ru_seo_text,
            'seo_text_2' => $request->ru_seo_text_2,
        ]);
        $uk = $uk_cat::updateOrCreate(['cat_id' => $cat_id], [
            'uk_name' => $request->uk_name,
            'title' => $request->uk_title,
            'desc' => $request->uk_desc,
            'h1' => $request->uk_h1,
            'h2' => $request->uk_h2,
            'seo_text' => $request->uk_seo_text,
            'seo_text_2' => $request->uk_seo_text_2,
        ]);
        return ($ru AND $uk) ? 1 : 0;
    }
}
