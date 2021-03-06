<?php

namespace App\Http\Controllers\Site;

use App;
use App\Models\Item;
use App\Models\SubCategory;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\ItemAttribute;
use App\Models\Attribute;
use App\Models\Tag;
use Exception;

class CSPController extends BaseController
{
    /**
     * String App locale
     */
    private $locale;
    /**
     * @var int  Page count in Pagination
     */
    private $page_count = 6;

    /**
     * @var String second segment in URL
     */
    private $segment;

    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->locale = mb_strtolower(App::getLocale());
        $this->segment = $request->segment(2);
    }

    public function catalog(Request $request)
    {
        $this->data['category'] = DB::table('categories')->select($this->locale . '_name as name', 'cat_url_slug as slug', 'cat_photo as photo')
            ->join($this->locale . '_categories', 'categories.id', '=', $this->locale . '_categories.cat_id')
            ->orderBy('name')
            ->get()->toArray();

        return view('site.catalog', [
            'class' => 'catalog',
            'data' => $this->data,
            'title' => __('seo.catalog-title'),
            'description' => __('seo.catalog-description'),
            'rating' => $this->stars->index($request),
        ]);
    }

    public function category(Request $request)
    {
        $this->data['category'] = DB::table('categories')->select($this->locale . '_name as name', 'cat_url_slug as slug', 'title', $this->locale . '_categories.desc', 'h1', 'seo_text', 'h2', 'seo_text_2')
            ->join($this->locale . '_categories', 'categories.id', '=', $this->locale . '_categories.cat_id')
            ->where('cat_url_slug', $this->segment)
            ->first();
        if (!$this->data['category']) {
            return abort(404);
        }

        $this->data['sub-categories'] = DB::table('sub_categories')->select($this->locale . '_name as name', 'sub_cat_url_slug as slug', 'sub_cat_photo as photo')
            ->join($this->locale . '_sub_categories', 'sub_categories.id', '=', $this->locale . '_sub_categories.sub_cat_id')
            ->join('categories', 'categories.id', '=', 'sub_categories.cat_id')
            ->where('cat_url_slug', $this->segment)
            ->orderBy('name')
            ->get()->toArray();

        return view('site.category', [
            'class' => 'category',
            'data' => $this->data,
            'title' => $this->data['category']->title,
            'description' => $this->data['category']->desc,
            'rating' => $this->stars->index($request),
        ]);
    }

    public function sub_category(Request $request)
    {
        $sort = ($request->sort) ? $request->sort : 'asc_name';
        // brand sort
        $bs = ($request->bs) ? $request->bs : Null;
        $i_model = new Item;
        $brand_model = new Brand();
        $sort_config = $this->setSortConfig($sort);
        // getting all items in SubCategory
        $data = $i_model->getSubCategoryItems($this->getSubCategoryId(), $sort_config, $bs);
        //gettings existing brands via ID

        return view('site.sub-category', [
            'sort' => $sort,
            'class' => 'sub-category',
            'items' => $data['items']->paginate($this->page_count),
            'segment' => $this->segment,
            'i_method' => $sort_config['method'],
            'scat' => $this->getSubCategoryData(),
            'scat_method' => $this->getSubCategoryMethod(),
            'brands' => $brand_model->getBrands($data['brand_ids']),
            'bs' => $bs,
            'rating' => $this->stars->index($request),
            'title' => $this->getSubCategoryData()[$this->getSubCategoryMethod()]['title'],
            'description' => $this->getSubCategoryData()[$this->getSubCategoryMethod()]['description'],
            'cat' => $this->getCategoryData(),
            'cat_method' => $this->getCategoryMethod(),
            'tags' => $this->tagCombine($data['items']),
        ]);
    }

    public function product(Request $request)
    {
        $item_model = new Item();
// with url_slug search item ID
        $item_id = $this->getItemId($this->segment);
        $item_method = $this->getItemMethod();
        $same_ids = $this->getSameProductsIds($item_model->getItemCategoryId($item_id), $item_id);
        $this->data['same_items'] = ($same_ids)
            ? Item::with([$this->getItemMethod(),])->find($same_ids)
            : Null;
        $this->data['item'] = Item::with([
            $item_method,
            $this->getItemTagMethod(),
            'getItemTag',
            'brand',
            'getItemShortcut',
        ])->findOrFail($item_id);
        $this->data['tags'] = $this->itemTagCombine($this->data['item']);

        return view('site.product', [
            'class' => 'product',
            'data' => $this->data,
            'title' => $this->data['item'][$item_method]->name,
            'description' => $this->data['item'][$item_method]->description,
            'rating' => $this->stars->index($request),
            'starts' => false, //hide starts in footer
            'item_method' => $item_method,
            'tag_method' => $this->getItemTagMethod(),
            'column' => $this->getColumn(),
            "attrs" => Attribute::get(['id', $this->getColumn()]),
            "item_attrs" => ItemAttribute::with('attributesLang')->where('item_id', $item_id)->get(),
        ]);
    }

    public function tags(Request $request)
    {
        $sort = ($request->sort) ? $request->sort : 'asc_name';
        $bs = ($request->bs) ? $request->bs : Null;
        $i_model = new Item;
        $brand_model = new Brand();
        $sort_config = $this->setSortConfig($sort);
//        // getting all items with same Tag
        $tag_id = $this->getTagId();
        $tag_method = $this->getTagMethod();
        //current Tag
        $tag = Tag::with($tag_method)->whereId($tag_id)->first();
        $data = $i_model->getTagItems($tag_id, $sort_config, $bs);

        return view('site.tags', [
            'sort' => $sort,
            'class' => 'tags',
            'items' => $data['items']->paginate($this->page_count),
            'segment' => $this->segment,
            'i_method' => $sort_config['method'],
            't_method' => $this->getTagMethod(),
            'column' => $this->getColumn(),
            'brands' => $brand_model->getBrands($data['brand_ids']),
            'bs' => $bs,
            'rating' => $this->stars->index($request),
            'title' => $tag[$tag_method]->title,
            'description' => $tag[$tag_method]->description,
            'tags' => $this->tagCombine($data['items']),
        ]);
    }

    /**
     * getting method 4 conclusion items in specific lang
     * @return String Method in Item Model
     */
    private function getItemMethod()
    {
        $item_methods = array('getRuItem', 'getUkItem');
        switch ($this->locale) {
            case 'uk':
                return $item_methods[1];
                break;
            default:
                return $item_methods[0];
        }
    }

    /**
     * getting item ID
     * @param String $segment
     * @return Integer ID
     */
    private function getItemId($segment)
    {
        try {
            $item_id = Item::where([['item_url_slug', '=', $segment], ['enabled', '=', 1]])->first()->id;
        } catch (Exception $qe) {
            return abort(404);
        }
        return $item_id;
    }


    /** getting SubCategory ID
     * @return Integer
     */
    private function getSubCategoryId()
    {
        $sc = new SubCategory();
        // getting SubCategory ID
        try {
            $sc_id = $sc->getSubCategoryId($this->segment);
        } catch (Exception $e) {
            return abort(404);
        }
        return $sc_id;
    }

    /**
     * getting data only about SubCategory
     * title, desc and so
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    private function getSubCategoryData()
    {
        $sc_data = SubCategory::with($this->getSubCategoryMethod())->
        whereId($this->getSubCategoryId())->first();
        return $sc_data;
    }

    /**
     * getting method existing in SubCategory Model
     * @return String Method
     */
    private function getSubCategoryMethod()
    {
        $sc_methods = array('RuSubCategory', 'UkSubCategory');

        switch ($this->locale) {
            case 'uk':
                return $sc_methods[1];
                break;
            default:
                return $sc_methods[0];
        }
    }

    /**
     * setting sorting parameters
     * @param String $sort
     * @return array
     */
    private function setSortConfig($sort)
    {
        $asc_arr = array('asc_name', 'asc_price');
        $order = (in_array($sort, $asc_arr)) ? 1 : 0;
        $method = $this->getItemMethod();
        $ti_method = $this->getItemTagMethod();
        switch ($sort) {
            case 'asc_price':
            case 'desc_price':
                $orderBy = ([
                    'order' => $order,
                    'sortBy' => "price",
                    'method' => $method,
                    'ti_method' => $ti_method,
                ]);
                break;
            default:
                $orderBy = ([
                    'order' => $order,
                    'sortBy' => $method . ".name",
                    'method' => $method,
                    'ti_method' => $ti_method,
                ]);
        }
        return $orderBy;
    }

    /**
     * getting category ID
     * @return Integer cat ID
     */
    private function getCategoryId()
    {
        try {
            return SubCategory::with('getCategory')->whereId($this->getSubCategoryId())->first()->cat_id;
        } catch (Exception $qe) {
            return abort(404);
        }
    }

    /**
     * getting methods 4 lang from model
     * @return String method
     */
    private function getCategoryMethod()
    {
        $c_methods = array('RuCategoryJustName', 'UkCategoryJustName');
        switch ($this->locale) {
            case 'uk':
                return $c_methods[1];
                break;
            default:
                return $c_methods[0];
        }
    }

    /**
     * Getting all data about SubCategory
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    private function getCategoryData()
    {
        $c_data = Category::with($this->getCategoryMethod())->whereId($this->getCategoryId())->first();
        return $c_data;
    }

    /**
     * getting methods 4 different languages from tag model
     * @return String
     */
    private function getItemTagMethod()
    {
        $ti_methods = array('getItemRuTag', 'getItemUkTag');
        switch ($this->locale) {
            case 'uk':
                return $ti_methods[1];
                break;
            default:
                return $ti_methods[0];
        }
    }

    private function getTagMethod()
    {
        $t_methods = array('getRuTag', 'getUkTag');
        switch ($this->locale) {
            case 'uk':
                return $t_methods[1];
                break;
            default:
                return $t_methods[0];
        }
    }

    /**
     * getting column from DB lang columns
     * @return string column name
     */
    private function getColumn()
    {
        $t_colums = array('ru_name', 'uk_name');
        switch ($this->locale) {
            case 'uk':
                return $t_colums[1];
                break;
            default:
                return $t_colums[0];
        }
    }

    /**
     * 4 items array only
     * combining tags in items 4 excluding repeating values
     * retriev URL as key and Lang name as Value
     * @param $items
     * @return array
     */
    private function tagCombine($items)
    {
        $tag_key = array();
        $tag_value = array();
        foreach ($items as $item) {
            foreach ($item->getItemTag as $tag) {
                $tag_key[] = $tag->tag_url_slug;
            }
            foreach ($item[$this->getItemTagMethod()] as $tm) {
                $tag_value[] = $tm[$this->getColumn()];
            }
        }
        $comb = array_combine($tag_key, $tag_value);
        return $comb;
    }

    /**
     * getting array of URL slug as key and name as Value
     * 4 item only
     * @param $item
     * @return array
     */
    private function itemTagCombine($item)
    {
        $tag_key = array();
        $tag_value = array();
        foreach ($item->getItemTag as $tag) {
            $tag_key[] = $tag->tag_url_slug;
        }
        foreach ($item[$this->getItemTagMethod()] as $tm) {
            $tag_value[] = $tm[$this->getColumn()];
        }
        $comb = array_combine($tag_key, $tag_value);
        return $comb;
    }

    /**
     * getting IDs if exist
     * @param Int $cat_id
     * @param  Int $current_id
     * @return null|Array
     */
    private function getSameProductsIds($cat_id, $current_id)
    {
        /*$ic=new ItemCategory() ;
        $all_ids = $ic->where([['sub_cat_id','=',$cat_id],['item_id','<>',$current_id]])->pluck('item_id');     */
        $sub_cat_ids = DB::table('sub_categories')->where('cat_id', $cat_id)->pluck('id');
        $all_ids = DB::table('item_categories')->
        whereIn('sub_cat_id', $sub_cat_ids)->
        where('item_id', '<>', $current_id)->
        pluck('item_id');
        switch ($all_ids->count()) {
            case 1:
                $count = 1;
                break;
            case 2:
                $count = 2;
                break;
            case 3:
                $count = 3;
                break;
            case 0:
                $count = 0;
                break;
            default:
                $count = 4;
        }
        $same_ids = ($count) ? $all_ids->random($count) : Null;
        return $same_ids;
    }

    /**
     * getting tag ID via segment from URL
     * @return Int tag ID
     */
    private function getTagId()
    {
        $t = new Tag();
        try {
            $tag_id = $t->getTagId($this->segment);
        } catch (Exception $e) {
            return abort(404);
        }
        return $tag_id;
    }
}
