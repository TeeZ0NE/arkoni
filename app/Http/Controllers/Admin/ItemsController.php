<?php

namespace App\Http\Controllers\Admin;

use App\Libs\WithImg;
use App\Models\RuItem;
use App\Models\SubCategory;
use App\Models\UkItem;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Attribute as Attr;
use Illuminate\Support\Facades\Log;
use App\Models\ItemAttribute;
use App\Models\Shortcut;
use App\Models\ItemShortcut;
use Illuminate\Database\QueryException as QE;
use Exception;
use Auth;
use App\Http\Controllers\Controller;

class ItemsController extends Controller
{
    /**
     * count items on page
     * @var Int
     */
    private $pag_count = 10;

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
        $item = new Item();
        return view('admin.pages.items')->with([
            'count' => $item::count(),
            'sort' => 'acs',
            'items' => $item->getAllItems()->paginate($this->pag_count),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sc = new SubCategory();
        return view('admin.pages.item_create')->with([
            "brands" => Brand::all(),
            "sub_cats" => $sc->getRuSubCategoryIdAndName(),
            "attrs" => Attr::get(['id', 'ru_name']),
            'shortcuts' => Shortcut::all(),
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
        request()->validate([
            'img_upload' => 'image|mimes:jpeg,png,jpg|max:2048',
            'uk_name' => 'max:255|required|unique:uk_items',
            'ru_name' => 'max:200|required|unique:ru_items',
            'ru_desc' => 'required',
            'uk_desc' => 'required',
            'brand_id' => 'required|numeric',
            'price' => 'numeric|required',
            'old_price' => 'numeric|required',
            'sub_categories' => 'required',
        ]);
        $user = Auth::user()->name;
        $photo = config('app.img_default');
        if ($request->hasFile('img_upload')) {
            $img = new WithImg();
            $photo = $img->getImageFileName($request->file('img_upload'), $request->ru_name);
        }
        $item_id = $this->storeNewItem($request, $photo);
        try {
            if (!$item_id) {
                throw new Exception('Основні дані про продукт не було записано');
            }
            $res = $this->storeLang($request, $item_id);
            if (!$res) {
                throw new Exception('Язикові файли не було записано');
            }
            $res = $this->storeItemSubCategories($request->sub_categories, $item_id);
            if (!$res) {
                throw  new Exception('Виникла помилка з записом підкатегорій');
            }
            if (isset($request->attrs)) {
                $res = $this->storeItemAttributes($request->attrs, $request->values, $item_id);
                if (!$res) {
                    throw new Exception('Виникла помилка з записом атрибутів');
                }
            }
            if (isset($request->shortcuts)) {
                $res = $this->storeItemShortcuts($request->shortcuts, $item_id);
                if (!$res) {
                    throw new Exception('Ярлики не записано');
                }
            }
        } catch (Exception $e) {
            Log::error('Item add', ['msg' => $e->getMessage(), 'user' => $user]);
            return redirect()
                ->back()
                ->withErrors(['Error' => $e->getMessage()]);
        }
        Log::info('Item add', ['user' => $user]);
        return redirect(route('items.index'))->with('msg', 'Новий товар додано до бази!');
    }


    /**
     * storing main new item to DB
     * @param  Request $request
     * @param  String $namame getting name from get_name method
     * @param  String $file_name generated file name of image
     * @return Int             if stored return item's ID else false
     */
    private function storeNewItem(Request $request, $photo)
    {
        $item = new Item();
        $item->item_url_slug = 'p-' . url_slug($request->ru_name);
        $item->price = $request->price;
        $item->old_price = $request->old_price;
        $item->brand_id = $request->brand_id;
        $item->enabled = $request->enabled;
        $item->item_photo = $photo;
        $item->save();
        return $item->id;
    }

    /**
     * Storing item languages
     * @param Request $request
     * @param $id item ID
     * @return boolean
     */
    private function storeLang(Request $request, $id)
    {
        $uk_item = new UkItem();
        $ru_item = new RuItem();
        $ru = $ru_item::updateOrCreate(['item_id' => $id], [
            'ru_name' => $request->ru_name,
            'desc' => $request->ru_desc,
        ]);
        $uk = $uk_item::updateOrCreate(['item_id' => $id], [
            'uk_name' => $request->uk_name,
            'desc' => $request->uk_desc,
        ]);
        return ($ru AND $uk) ? 1 : 0;
    }

    /**
     * storing Item Sub-categor-y(-ies)
     * first of all deleting existing subcategories then deleting them and store new subcategories
     * @param mixed $sub_categories
     * @param Int $id item ID
     * @return Boolean if store
     */
    private function storeItemSubCategories($sub_categories, $id)
    {
        $isc = new ItemCategory();
        try {
            $isc::where('item_id', $id)->delete();
            foreach ($sub_categories as $sc) {
                $isc->insert([
                    'item_id' => $id,
                    'sub_cat_id' => $sc,
                ]);
            }
        } catch (QE $qe) {
            Log::error('Error to write/delete item sub-categories', ['mes' => $qe->getMessage()]);
            return 0;
        }
        return 1;
    }

    /**
     * Storing item attributes
     * @param array $attrs
     * @param array $values
     * @param $id
     * @return Integer Boolean if strored
     */
    private function storeItemAttributes(Array $attrs, Array $values, $id)
    {
        $ia = new ItemAttribute();
        # merge 2 arrays. One are keys of another array
        $attrs_vals_arr = [];
        foreach ($attrs as $keys => $key) {
            $attrs_vals_arr[$key] = $values[$keys];
        }
        try {
            $ia::where('item_id', $id)->delete();
            foreach ($attrs_vals_arr as $attr => $value) {
                $ia::insert([
                    'item_id' => $id,
                    'attr_id' => $attr,
                    'value' => $value
                ]);
            }
        } catch (QE $qe) {
            Log::error('Error to write/delete attributes', ['msg' => $qe->getMessage()]);
            return 0;
        }
        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sc = new SubCategory();
        $ic = new ItemCategory();
        $ia = new ItemAttribute();
        $ishortc = new ItemShortcut();
        $i = new Item();
        return view('admin.pages.item_edit')->with([
            "brands" => Brand::all(),
            "sub_cats" => $sc->getRuSubCategoryIdAndName(),
            "attrs" => Attr::get(['id', 'ru_name']),
            "item_attrs" => $ia::with('attributesLang')->where('item_id', $id)->get(),
            'item' => $i::with(['getUkItem', 'getRuItem'])->findOrFail($id),
            'item_cats' => $ic->getListOfCategories($id),
            'id' => $id,
            'item_shortcuts' => $ishortc->getListOfShortcuts($id),
            'shortcuts' => Shortcut::all(),
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
        request()->validate([
            'img_upload' => 'image|mimes:jpeg,png,jpg|max:2048',
            'uk_name' => 'max:255|required',
            'ru_name' => 'max:200|required',
            'uk_desc' => 'required',
            'ru_desc' => 'required',
            'brand_id' => 'required|numeric',
            'price' => 'numeric',
            'old_price' => 'numeric',
            'sub_categories' => 'required',
            'item_url_slug' => 'required|max:250',
        ]);
        $user = Auth::user()->name;
        $item = new Item();
        $photo = $item::find($id)->item_photo;
        $storeImg = new WithImg();
        if ($request->hasFile('img_upload')) {
            $storeImg->delete_photo($photo);
            $photo = $storeImg->getImageFileName($request->file('img_upload'), $request->ru_name, True);
        }
        try {
//            if($request->price - floor($request->price)>0) {return 'has decimals';} else {return 'no decimals';}
            $item::findOrFail($id)->update([
                'price' => $request->price,
                'old_price' => $request->old_price,
                'brand_id' => $request->brand_id,
                'enabled' => $request->enabled,
                'item_url_slug' => 'p-' . $request->item_url_slug,
                'item_photo' => $photo,
            ]);
            $res = $this->storeLang($request, $id);
            if (!$res) {
                throw new Exception('Язикові файли не було записано');
            }
            $res = $this->storeItemSubCategories($request->sub_categories, $id);
            if (!$res) {
                throw  new Exception('Виникла помилка з записом підкатегорій');
            }
            if (isset($request->attrs)) {
                $res = $this->storeItemAttributes($request->attrs, $request->values, $id);
            } else {
                $res = $this->deleteItemAttributes($id);
            }
            if (!$res) {
                throw new Exception('Виникла помилка з записом атрибутів');
            }
            if (isset($request->shortcuts)) {
                $res = $this->storeItemShortcuts($request->shortcuts, $id);
                if (!$res) {
                    throw new Exception('Ярлики не записано');
                }
            } else {
                $res = $this->deleteItemShortcuts($id);
            }
            if (!$res) {
                throw new Exception('Ярлики не записано');
            }
        } catch (Exception $e) {
            Log::error('Item update', ['msg' => $e->getMessage(), 'user' => $user]);
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        Log::info('Item update', ['user' => $user]);
        return redirect(route('items.index'))->with('msg', 'Зміни було застосовано');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user()->name;
        try {
            $i = new Item();
            $photo = $i::findOrFail($id)->item_photo;
            $i::findOrFail($id)->delete();
            $img = new WithImg();
            $img->delete_photo($photo);
        } catch (QE $qe) {
            Log::error('Item delete', ['msg' => $qe->getMessage(), 'user' => $user]);
            //TODO:: delete $qe debug
            return redirect()->back()->withErrors(['msg' => 'Виникла помилка з видаленням товара' . $qe->getMessage()]);
        }
        Log::info('Item destroy', ['user' => $user]);
        return redirect(route('items.index'))->with('msg', ' Товар видалено з бази');
    }

    /**
     * search method
     * @param Request $request
     * @return view with data
     */
    public function search(Request $request)
    {
        $request->flash();
        $sort = $request->sort;
        $q = $request->q;
        $item = new Item();
        return view('admin.pages.items')->with([
            'count' => $item::count(),
            'sort' => 'acs',
            'items' => $item->searchAndSort($q, $sort)->paginate($this->pag_count),
        ]);
    }

    private function storeItemShortcuts($shortcuts, $id)
    {
        $ishrt = new ItemShortcut();
        try {
            $ishrt::where('item_id', $id)->delete();
            foreach ($shortcuts as $shortcut) {
                $ishrt::insert([
                    'item_id' => $id,
                    'shortcut_id' => $shortcut,
                ]);
            }
        } catch (QE $qe) {
            Log::error('Error to write/delete shortcuts', ['msg' => $qe->getMessage()]);
            return 0;
        }
        return 1;
    }

    /**
     * If not set shortcuts or set but deleted delete them all
     * @param  int $id ID
     * @return boolean
     */
    private function deleteItemShortcuts($id)
    {
        $ishrt = new ItemShortcut();
        try {
            $ishrt::where('item_id', $id)->delete();
        } catch (QE $qe) {
            Log::error('Error to write/delete shortcuts', ['msg' => $qe->getMessage()]);
            return 0;
        }
        return 1;
    }

    /**
     * delete item attributes if exist
     * @param int $id item ID
     * @return boolean
     */
    private function deleteItemAttributes($id)
    {
        $ia = new ItemAttribute();
        try {
            $ia::where('item_id', $id)->delete();
        } catch (QE $qe) {
            Log::error('Error to write/delete attributes', ['msg' => $qe->getMessage()]);
            return 0;
        }
        return 1;
    }
}
