<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException as QE;
use App\Models\Category as Cat;
use App\Models\RuCategory as RuCat;
use App\Models\UkCategory as UkCat;
use Auth;
use Illuminate\Mail\Message;

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
            'cats' => $cat->getNameAndId(),
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
            Cat::findOrFail($id)->delete();
        } catch (ModelFail $me) {
            //TODO: remove debug info below $me
            return redirect()->back()->withErrors(['msg' => 'Виникла помилка з видаленням. Вірогідно використовується в підкатегоріях.' . '<br>' . $me]);
        }
        session()->flash('msg', 'Категорію видалено з бази');
        return redirect()->back();
    }

    /**
     * create new category.
     * Not Used.
     * Adding could just from Tinker or DB instances. Do not forget add nested fields in RuCategory and UkCategory Models or tables!
     * @return Object error message at now
     */
    public function create()
    {
        return redirect()->back()->withErrors(['msg' => 'Неможливо створити нову категорію. Обмежено кількістю категорій!']);
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
            'cats' => $cat->getNameAndId($q, $sort),
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
        return view('admin.parts.components.category')->with([
            'id' => $id,
            'cat' => $cat::with(['RuCategory', 'UkCategory'])->findOrFail($id),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'uk_name'=>'max:255|required',
            'ru_name' => 'max:255|required',
            'uk_title'=>'max:255|required',
            'ru_title'=>'max:255|required',
            'uk_desc'=>'max:255|required',
            'ru_desc'=>'max:255|required',
        ]);

        $id = $request->id;
        /* Valdate the same name
        $uk_same = UkCat::where('name','=',$request->uk_name)->first();
        if ($uk_same and $uk_same->cat_id != $id){
            return redirect()
                ->back()
                ->withErrors(['cat_error'=>'Така категорія в укр версії вже існує']);
        }
        $ru_same = RuCat::where('name','=',$request->ru_name)->first();
        if ($ru_same and $ru_same->cat_id != $id){
            return redirect()
                ->back()
                ->withErrors(['cat_error'=>'Така категорія в рос версії вже існує']);
        }*/
        $uk_cat = UkCat::find($id);
        $ru_cat = RuCat::find($id);
        // updating uk
        $uk_cat->name = $request->uk_name;
        $uk_cat->title = $request->uk_title;
        $uk_cat->desc = $request->uk_desc;
        $uk_cat->h1 = $request->uk_h1;
        $uk_cat->h2 = $request->uk_h2;
        $uk_cat->seo_text =  $request->uk_seo_text;
        // updating ru
        $ru_cat->name = $request->ru_name;
        $ru_cat->title = $request->ru_title;
        $ru_cat->desc = $request->ru_desc;
        $ru_cat->h1 = $request->ru_h1;
        $ru_cat->h2 = $request->ru_h2;
        $ru_cat->seo_text = $request->ru_seo_text;
        try {
            $uk_cat->save();
            $ru_cat->save();
            //TODO::remove debug $qe
        } catch (QE $qe) {
            return redirect()
                ->back()
                ->withErrors(['cat_error' => "Сталась помилка запису змін.\r\n". $qe->getMessage()]);
        }
        session()->flash('msg', 'Зміни внесено!');
        return redirect()->back();

    }
}
