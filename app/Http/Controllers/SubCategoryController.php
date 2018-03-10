<?php

namespace App\Http\Controllers;

use App\Libs\WithImg;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\RuSubCategory;
use App\Models\UkSubCategory;
use Illuminate\Database\QueryException as QE;
use Auth;

class SubCategoryController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sc = new SubCategory();
        return view('admin.pages.subcategories')->with([
            'subcats' => $sc->searchAndSort()->paginate($this->page_count),
            'sort' => 'asc',
            'count' => SubCategory::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_cat = new SubCategory;
        return view('admin.pages.subcategory_create')->with([
            'cats' => $sub_cat->getRuCategories(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ru_name' => 'required|unique:ru_sub_categories|max:255',
            'uk_name' => 'required|unique:uk_sub_categories|max:255',
            'ru_desc' => 'max:255',
            'uk_desc' => 'max:255',
            'cat_id' => 'required',
            'ru_title' => 'max:70',
            'uk_title' => 'max:70',
            'img_upload' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $photo = config('app.img_default');
        if ($request->hasFile('img_upload')) {
            $img = new WithImg;
            $photo = $img->getImageFileName($request->file('img_upload'), $request->ru_name);
        }
        $sub_cat_id = $this->storeNewSubCat($request->cat_id, $request->ru_name, $photo);
        try {
            if (!$sub_cat_id) {
                throw new Exception("Запис підкатегорії не здійснено");
            }
            $res = $this->storeLangSubCat($request, $sub_cat_id);
            if (!$res) {
                throw  new Exception('Язикові файли не було записано');
            }
        } catch (Exception $e) {
            Log::error('Error to write subCategory', ['mes' => $e]);
            return redirect()->back()->withErrors(['Error' => $e->getMessage()]);
        }
        session()->flash('msg', 'Підкатегорію створено');
        return redirect(route('subcategory.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sub_cat = new SubCategory();
        return view('admin.pages.subcategory_edit')->with([
            'id' => $id,
            'cats' => $sub_cat->getRuCategories(),
            'sub_cat' => $sub_cat::with(['RuSubCategory', 'UkSubCategory'])->findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cat_id' => 'required',
            'uk_name' => 'max:255|required',
            'ru_name' => 'max:255|required',
            'ru_title' => 'max:70',
            'uk_title' => 'max:70',
            'uk_desc' => 'max:255',
            'ru_desc' => 'max:255',
            'ru_h1' => 'max:255',
            'uk_h1' => 'max:255',
            'ru_h2' => 'max:255',
            'uk_h2' => 'max:255',
            'sub_cat_url_slug' => 'required|max:255',
            'img_upload' => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);
        $sub_cat = new SubCategory();
        $storeImg = new WithImg();
        $photo = $sub_cat::find($id)->sub_cat_photo;
        if ($request->hasFile('img_upload')) {
            $storeImg->delete_photo($photo);
            $photo = $storeImg->getImageFileName($request->file('img_upload'), $request->ru_name);
        }
        try {
            $sub_cat::findOrFail($id)->update([
                'cat_id' => $request->cat_id,
                'sub_cat_url_slug' => $request->sub_cat_url_slug,
                'sub_cat_photo' => $photo,
                'cat_url_slug' => $request->cat_url_slug,
                'cat_photo' => $photo,
            ]);
            $this->storeLangSubCat($request, $id);
        } catch (QE $qe) {
            return redirect()->back()->withErrors(['sub_cat_error' => 'Сталась помилка запису змін ' . $qe]);
        }
        session()->flash('msg', 'Зміни вненсено');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $sub_cat = new SubCategory();
            $img = new WithImg();
            $photo = $sub_cat::findOrFail($id)->sub_cat_photo;
            $sub_cat::findOrFail($id)->delete();
            $img->delete_photo($photo);
        } catch (QE $qe) {
            //TODO: remove debug info
            return redirect()->back()->withErrors(['msg' => 'Виникла помилка з видаленням ' . $qe]);
        }
        session()->flash('msg', 'Підкатегорію видалено з бази');
        return redirect(route('subcategory.index'));
    }

    /**
     * storin main table of sub categories
     * @param Int $cat_id parent category ID
     * @param  String $ru_name RU name of sub category 4 creating URL
     * @param String $photo image file
     * @return Int if stored True or ID of sub category else null
     */
    private function storeNewSubCat($cat_id, $ru_name, $photo)
    {
        $sub_cat = new SubCategory();
        $sub_cat->sub_cat_url_slug = 's-'.url_slug($ru_name);
        $sub_cat->sub_cat_photo = $photo;
        $sub_cat->cat_id = $cat_id;
        $sub_cat->save();
        return $sub_cat->id;
    }

    /**
     * create new or update
     * crating or updating sub category data
     * @param Request $request
     * @param Int $sub_cat_id sub category ID
     * @return Boolean if stored then ok
     */
    private function storeLangSubCat(Request $request, $sub_cat_id)
    {
        $ru_sub_cat = new RuSubCategory();
        $uk_sub_cat = new UkSubCategory();
        $ru = $ru_sub_cat::updateOrCreate(['sub_cat_id' => $sub_cat_id], [
            'ru_name' => $request->ru_name,
            'title' => $request->ru_title,
            'desc' => $request->ru_desc,
            'h1' => $request->ru_h1,
            'h2' => $request->ru_h2,
            'seo_text' => $request->ru_seo_text,
        ]);
        $uk = $uk_sub_cat::updateOrCreate(['sub_cat_id' => $sub_cat_id], [
            'uk_name' => $request->uk_name,
            'title' => $request->uk_title,
            'desc' => $request->uk_desc,
            'h1' => $request->uk_h1,
            'h2' => $request->uk_h2,
            'seo_text' => $request->uk_seo_text,
        ]);
        return ($ru AND $uk) ? 1 : 0;
    }

    public function search(Request $request)
    {
        $request->flash();
        $sort = $request->sort;
        $q = $request->q;
        $sub_cat = new SubCategory();
        return view('admin.pages.subcategories')->with([
            'subcats' => $sub_cat->searchAndSort($q, $sort)->paginate($this->page_count),
            'count' => $sub_cat::count(),
            'sort' => $sort
        ]);
    }
}
