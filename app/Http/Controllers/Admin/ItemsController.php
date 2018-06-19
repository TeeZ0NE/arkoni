<?php

namespace App\Http\Controllers\Admin;

use App\Libs\WithImg;
use App\Models\{
	RuItem,
	UkItem,
	SubCategory,
	Brand,
	Item,
	ItemCategory,
	Attribute as Attr,
	ItemAttribute,
	Shortcut,
	ItemShortcut,
	Tag,
	ItemTag
};
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException as QE;
use Exception;
use Auth;
use App\Http\Controllers\Controller;

//use PhpParser\Node\Expr\Cast\Bool_;
//use Illuminate\Support\Collection;

class ItemsController extends Controller
{
	/**
	 * count items on page
	 * @var Int
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
		$item = new Item();
		$items = Item::with(['brand', 'getRuItem', 'getUkItem', 'getItemRuTag'])->paginate($this->page_count);
		return view('admin.pages.items')->with([
			'count' => $item::count(),
			'sort' => 'acs',
			//'items' => $item->getAllItems()->paginate($this->pag_count),
			'items' => $items,
			'total' => $items->total(),
			'links' => $items->links(),
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
			'tags' => Tag::with('getRuTagsName')->get(),
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
			'img_upload' => 'mimes:jpeg,png,jpg|max:5120',
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
			if (isset($request->tags)) {
				$res = $this->storeItemTags($request->tags, $item_id);
				if (!$res) {
					throw new Exception('Теги не було записано');
				}
			}
		} catch (Exception $e) {
			Log::error('Item add', ['msg' => $e->getMessage(), 'user' => $user, 'item id' => $item_id]);
			return redirect()
				->back()
				->withErrors(['Error' => $e->getMessage()]);
		}
		Log::info('Item add', ['user' => $user, 'item id' => $item_id]);
		return redirect(route('items.index'))->with('msg', 'Новий товар додано до бази!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		return redirect()->back();
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
		$it = new ItemTag();
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
			'tags' => Tag::with(['getRuTagsName'])->get(),
			'item_tags' => $it->getListOfTags($id),
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
			'img_upload' => 'mimes:jpeg,png,jpg|max:5120',
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
			/*if hasn't any value delete it from DB*/
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
			} else {
				$res = $this->deleteItemShortcuts($id);
			}
			if (!$res) {
				throw new Exception('Ярлики не записано');
			}
			if (isset($request->tags)) {
				$res = $this->storeItemTags($request->tags, $id);
			} else {
				$res = $this->deleteItemTags($id);
			}
			if (!$res) {
				throw new Exception("Теги на записано");
			}
		} catch (Exception $e) {
			Log::error('Item update', ['msg' => $e->getMessage(), 'user' => $user, 'item id' => $id]);
			return redirect()->back()->withErrors(['error' => $e->getMessage()]);
		}
		Log::info('Item update', ['user' => $user, 'item id' => $id]);
		return redirect(route('items.index'))->with('msg', 'Зміни було застосовано');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(int $id)
	{
		$user = Auth::user()->name;
		try {
			$i = new Item();
			$photo = $i::findOrFail($id)->item_photo;
			$i::findOrFail($id)->delete();
			$img = new WithImg();
			$img->delete_photo($photo);
		} catch (ModelNotFoundException $qe) {
			Log::error('Item delete', ['msg' => $qe->getMessage(), 'user' => $user, 'item id' => $id]);
			return redirect()->back()->withErrors(['msg' => 'Виникла помилка з видаленням товара']);
		}
		Log::info('Item destroy', ['user' => $user, 'item id' => $id]);
		return redirect(route('items.index'))->with('msg', ' Товар видалено з бази');
	}

	/**
	 * search method
	 * what going on here
	 * $items = (Item::with(['brand'])->where('id',4)->orWhereHas('brand',function($q){$q->where('name','LIKE','%%');})->get()->sortByDesc('brand.name',0) )->paginate(3)
	 * @param Request $request
	 * @return view with data
	 */
	public function search(Request $request)
	{
//        $request->flash();
		$sort = $request->sort;
		$q = $request->q;
		$item_model = new Item();
		$s_conf = $this->searchConfig($sort);
		$all_items = $item_model->search($s_conf['column'], $s_conf['method'], $q);
		//do order by elements from order method
		$items = ($s_conf['order'])
			? $all_items->sortBy($s_conf['sortBy'])
			: $all_items->sortByDesc($s_conf['sortBy']);
		$items = $items->paginate($this->page_count);
		return view('admin.pages.items')->with([
			'count' => Item::count(),
			'sort' => $sort,
			// TODO::info without appends sorting and pagination doesn't work properly
			'links' => $items->appends(['q' => $q, 'sort' => $sort])->links(),
			'items' => $items,
			'total' => $items->total(),
			'q' => $q,
		]);
	}

	/**
	 * @param int $id
	 * copying item with $id
	 * checking if $idexist -> copy it else return error and log it. Copy image from original with new name as name+copy. In new RU and UK names also plus 'copy" 2 end od title
	 * @return view with result
	 */
	public function copyItem(int $id)
	{
		$item = new Item();
		$user = Auth::user()->name;
		$image = new WithImg();
		$def_photo = config('app.img_default');
		$a_text = "-COPY" . uniqid();
		try {
//			$original = $item::with(['getRuItem', 'getUkItem', 'getItemAttributes', 'getItemShortcut', 'getItemCategories'])->findOrFail($id);
			$original = $item::findOrFail($id);
		} catch (ModelNotFoundException $me) {
			Log::error('Item copy', ['msg' => $me->getMessage(), 'user' => $user, 'item id' => $id]);
			return redirect()->back()->withErrors(['msg' => 'Виникла помилка з копіюванням товара. Такого товара не знайдено в базі']);
		}
		try {
			$new_image = $image->copyImage($original->item_photo);
			$photo = $new_image ?? $def_photo;
			$new_id = $this->copyItemMainData($original, $photo, $a_text);
			$this->copyLang($id, $new_id, $a_text);
			$this->copyItemCategory($id, $new_id);
			$this->copyItemAtrributes($id, $new_id);
				$this->copyItemTags($id, $new_id);
			$this->copyItemShortcuts($id, $new_id);

		} catch (Exception $e) {
			Log::error('Item copy', ['msg' => $e->getMessage(), 'user' => $user, 'item id' => $id]);
			return redirect()->back()->withErrors(['msg' => 'Виникла помилка з копіюванням товара. ' . $e->getMessage()]);
		}
		Log::info('Item copy', ['user' => $user, 'item id' => $id, 'new item id' => $new_id]);

		return redirect(route('items.index'))->
		with('msg', "Товар зкопійовано. Його індентифікатор <b>$new_id</b>.<br>Перейти до <a href=\"".route('items.edit',$new_id)."\">редагування</a>");
	}

	/**
	 * storing main new item to DB
	 * @param  Request $request
	 * @param string $photo
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
	 * @param int $id item ID
	 * @return boolean
	 */
	private function storeLang(Request $request, int $id)
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
	 * @param int[] $sub_categories
	 * @param int $id item ID
	 * @return boolean if store
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
	 * @param  int $id
	 * @return Integer Boolean if strored
	 */
	private function storeItemAttributes(array $attrs, array $values, $id)
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
	 * Storin' item shortcuts
	 * @param int[] $shortcuts
	 * @param int $id item ID
	 * @return Bool
	 */
	private function storeItemShortcuts($shortcuts, int $id)
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
	 * Storin' item tags
	 * @param int[] $tags
	 * @param int $id item ID
	 * @return boolean
	 */
	private function storeItemTags($tags, int $id)
	{
		$item_tag = new ItemTag();
		try {
			$item_tag::where('item_id', $id)->delete();
			foreach ($tags as $tag_id) {
				$item_tag->insert([
					'item_id' => $id,
					'tag_id' => $tag_id,
				]);
			}
		} catch (QE $qe) {
			Log::error('Error to write/delete item tags', ['mes' => $qe->getMessage()]);
			return 0;
		}
		return 1;
	}

	/**
	 * If not set shortcuts or set but deleted delete them all
	 * @param  int $id ID
	 * @return boolean
	 */
	private function deleteItemShortcuts(int $id)
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
	private function deleteItemAttributes(int $id)
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

	/**
	 * deletein' tags of item
	 * @param int $id item ID
	 * @return boolean does it deleted
	 */
	private function deleteItemTags(int $id)
	{
		$item_tags = new ItemTag();
		try {
			$item_tags::where('item_id', $id)->delete();
		} catch (QE $qe) {
			Log::error('Error to delete item tags', ['msg' => $qe->getMessage()]);
			return 0;
		}
		return 1;
	}

	/**
	 * getting methods and sort order 4 next transformation
	 * @param string $sort
	 * @return array methods existing in Item model, which columns will be using and order asc or desc
	 */
	private function searchConfig(string $sort)
	{
		/* 'method' => Null,
			'column' => Null,
			'sortBy' => Null,
			'order' => Null,*/
		$asc_arr = array('asc_iname', 'asc_brand', 'asc_price', 'asc_enabled');
		//gettin' from Item Model
		$methods = array('brand', 'getRuItem');
		$columns = array('name', 'ru_name', 'price', 'enabled');
		$order = (in_array($sort, $asc_arr)) ? 1 : 0;
		switch ($sort) {
			case 'asc_iname':
			case 'desc_iname':
				$orderBy = ([
					'method' => $methods[1],
					'sortBy' => $methods[1] . ".$columns[0]",
					'order' => $order,
					'column' => $columns[1]
				]);
				break;

			case 'asc_brand':
			case 'desc_brand':
				$orderBy = ([
					'method' => $methods[0],
					'sortBy' => $methods[0] . ".$columns[0]",
					'order' => $order,
					'column' => $columns[0]
				]);
				break;

			case 'asc_price':
			case 'desc_price':
				$orderBy = ([
					'method' => Null,
					'sortBy' => $columns[2],
					'order' => $order,
					'column' => $columns[2],
				]);
				break;

			case 'asc_enabled':
			case 'desc_enabled':
				$orderBy = ([
					'method' => Null,
					'sortBy' => $columns[3],
					'order' => $order,
					'column' => $columns[3],
				]);
				break;
			default:
				$orderBy = ([
					'method' => $methods[1],
					'sortBy' => $methods[1] . ".$columns[1]",
					'order' => $order,
					'column' => $columns[1]
				]);
				break;
		}
		return $orderBy;
	}

	/**
	 * copying main data 2 table Items
	 * @param Object $original
	 * @param string $photo String
	 * @param string $a_text String adding uniw text
	 * @return mixed
	 */
	private function copyItemMainData(Object $original, string $photo, string $a_text)
	{
		$copy = $original->replicate();
		$copy->item_photo = $photo;
		$copy->enabled = False;
		$copy->item_url_slug = $original->item_url_slug . $a_text;
		$copy->save();
		return $copy->id;
	}

	/**
	 * copying languages and adding uniqid to the end of text
	 * @param int $id
	 * @param int $new_id
	 * @param  string $a_text adding text
	 */
	private function copyLang(int $id, int $new_id, string $a_text) : void
	{
		$rui = new RuItem();
		$uki = new UkItem();
		try {
			$ru_o = $rui::findOrFail($id)->replicate();
			$uk_o = $uki::findOrFail($id)->replicate();
			$ru_o->item_id = $uk_o->item_id = $new_id;
			$ru_o->ru_name .= $a_text;
			$uk_o->uk_name .= $a_text;
			$ru_o->save();
			$uk_o->save();
		} catch (ModelNotFoundException $me) {
			Log::error("Item copy $id -> $new_id", ["msg" => "Назва продукту не зкопійована!"]);
		}
	}

	/**
	 * copying item subcategories
	 * @param int $id Int
	 * @param int $new_id Int
	 */
	private function copyItemCategory(int $id, int $new_id) : void
	{
		$c = new ItemCategory();
		$c_o = ItemCategory::where('item_id', $id)->get()->pluck('sub_cat_id');
		# count of elements in array less 1
		if (!$c_o->count())
			Log::notice("Item copy $id -> $new_id", ["msg" => "Підкатегоріїї продукту не зкопійовані або скопійовані частково!"]);
		foreach ($c_o as $k) {
			$c->insert(['item_id' => $new_id, 'sub_cat_id' => $k]);
		}
	}

	/**
	 * @param int $id
	 * @param int $new_id
	 */
	private function copyItemAtrributes(int $id, int $new_id) : void
	{
		$ia = new ItemAttribute();
		$ia_o = ItemAttribute::where('item_id', $id)->
		get(['attr_id', 'value']);
		# count elements in array less than 1. Nothing 2 copy
		if (!$ia_o->count())
			Log::notice("Item copy $id -> $new_id", ["msg" => "Атрибути не зкопійовані"]);
		foreach ($ia_o as $obj) {
			$ia->insert([
				'item_id' => $new_id,
				'attr_id' => $obj->attr_id,
				'value' => $obj->value
			]);
		}
	}

	/**
	 * copying item tags if exists
	 * @param int $id
	 * @param int $new_id
	 */
	private function copyItemTags(int $id, int $new_id) : void
	{
		$it = new ItemTag();
		$it_o = ItemTag::where("item_id", $id)->get()->pluck('tag_id');
		if (!$it_o->count()) Log::notice("Item copy $id -> $new_id", ["msg" => "Tags don't copied or not exists"]);
		foreach ($it_o as $tag) {
			$it->insert(['item_id' => $new_id, 'tag_id' => $tag]);
		}
	}

	/**
	 * copying item shortcuts if they are exists
	 * @param int $id copy from
	 * @param int $new_id
	 */
	private function copyItemShortcuts(int $id, int $new_id) : void
	{
		$is = new ItemShortcut();
		$is_o = ItemShortcut::where('item_id', $id)->get()->pluck('shortcut_id');
		if (!$is_o->count()) Log::notice("Item copy $id -> $new_id", ["msg" => "Shortcuts don't copied or not exists"]);
		foreach ($is_o as $shortcut) {
			$is->insert(['item_id' => $new_id, 'shortcut_id' => $shortcut]);
		}
	}
}
