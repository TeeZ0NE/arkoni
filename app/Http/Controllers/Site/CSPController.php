<?php

namespace App\Http\Controllers\Site;

use App;
use App\Models\Item;
use App\Models\SubCategory;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Site\StarsController;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CSPController extends BaseController
{
    /**
     * String App locale
     */
    private $locale;
    /**
     * @var int  Page count in Pagination
     */
    private $page_count = 3;

    /**
     * @var String second segment in URL
     */
    private $sc_segment;

    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->locale = mb_strtolower(App::getLocale());
        $this->sc_segment = $request->segment(2);
    }

    public function catalog(Request $request)
    {
        try {
            $this->data['category'] = DB::table('categories')->select(config('app.locale') . '_name as name', 'cat_url_slug as slug', 'cat_photo as photo')
                ->join(config('app.locale') . '_categories', 'categories.id', '=', config('app.locale') . '_categories.cat_id')
                ->orderBy('name')
                ->get()->toArray();
        } catch (\Exception $e) {
            abort(404);
        }

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
        try {
            $this->data['category'] = DB::table('categories')->select(config('app.locale') . '_name as name', 'cat_url_slug as slug', 'title', config('app.locale') . '_categories.desc', 'h1', 'seo_text', 'h2', 'seo_text_2')
                ->join(config('app.locale') . '_categories', 'categories.id', '=', config('app.locale') . '_categories.cat_id')
                ->where('cat_url_slug', $request->segment(2))
                ->get()->toArray()[0];

            $this->data['sub-categories'] = DB::table('sub_categories')->select(config('app.locale') . '_name as name', 'sub_cat_url_slug as slug', 'sub_cat_photo as photo')
                ->join(config('app.locale') . '_sub_categories', 'sub_categories.id', '=', config('app.locale') . '_sub_categories.sub_cat_id')
                ->join('categories', 'categories.id', '=', 'sub_categories.cat_id')
                ->where('cat_url_slug', $request->segment(2))
                ->orderBy('name')
                ->get()->toArray();

        } catch (\Exception $e) {
            abort(404);
        }

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
        //TODO:: DELETE ME
//        try {
//            $this->data['sub-category'] = DB::table('sub_categories')->select(
//                config('app.locale') . '_sub_categories.' . config('app.locale') . '_name as name',
//                config('app.locale') . '_sub_categories.title',
//                config('app.locale') . '_sub_categories.desc',
//                config('app.locale') . '_sub_categories.h1',
//                config('app.locale') . '_sub_categories.seo_text',
//                config('app.locale') . '_sub_categories.h2',
//                config('app.locale') . '_sub_categories.seo_text_2',
//                config('app.locale') . '_categories.ru_name as category_name',
//                'categories.cat_url_slug as category_slug'
//            )
//                ->join(config('app.locale') . '_sub_categories', config('app.locale') . '_sub_categories.sub_cat_id', '=', 'sub_categories.id')
//                ->join('categories', 'categories.id', '=', 'sub_categories.cat_id')
//                ->join(config('app.locale') . '_categories', config('app.locale') . '_categories.cat_id', '=', 'categories.id')
//                ->where('sub_cat_url_slug', $request->segment(2))
//                ->get()->toArray()[0];
//
//            $this->data['products'] = DB::table('items')->select(
//                config('app.locale') . '_name as name',
//                config('app.locale') . '_items.desc',
//                'item_photo as photo',
//                'item_url_slug as slug',
//                'price',
//                'old_price')
//                ->join(config('app.locale') . '_items', 'id', '=', 'item_id')
//                ->join('item_categories', 'item_categories.item_id', '=', 'items.id')
//                ->join('sub_categories', 'sub_categories.id', '=', 'item_categories.sub_cat_id')
//                ->join('categories', 'categories.id', '=', 'sub_categories.cat_id')
//                ->where([
//                    ['sub_categories.sub_cat_url_slug', '=', $request->segment(2)],
//                    ['enabled', '=', 1]
//                ])
//                ->paginate(10);
//        } catch (\Exception $e) {
//            abort(404);
//        }

        $sort = ($request->sort) ? $request->sort : 'asc_name';
        $bs = ($request->bs) ? $request->bs : Null;
        $i_model = new Item;
        $brand_model = new Brand();
        $sort_config = $this->setSortConfig($sort);
        // getting all items in SubCategory
        $data = $i_model->getSubCategoryItems($this->getSubCategoryId(), $sort_config, $bs);
        //gettings existing brands via ID

        //TODO:DELETE
//        return view('site.sub-category', [
//            'class' => 'sub-category',
//            'data' => $this->data,
//            'title' => $this->data['sub-category']->title,
//            'description' => $this->data['sub-category']->desc,
//            'rating' => $this->stars->index($request),
//        ]);

        return view('site.sub-category', [
            'sort' => $sort,
            'class' => 'sub-category',
            'items' => $data['items']->paginate($this->page_count),
            'segment' => $this->sc_segment,
            'i_method' => $sort_config['method'],
            'scat' => $this->getSubCategoryData(),
            'scat_method' => $this->getSubCategoryMethod(),
            'brands' => $brand_model->getSubCategoryBrands($data['brand_ids']),
            'bs' => $bs,
            'rating' => $this->stars->index($request),
            'title' => $this->getSubCategoryData()[$this->getSubCategoryMethod()]['title'],
            'description' => $this->getSubCategoryData()[$this->getSubCategoryMethod()]['description'],
            'cat'=>$this->getCategoryData(),
            'cat_method'=>$this->getCategoryMethod(),
        ]);
    }

    public function product(Request $request)
    {
        //DELETE ME
        try {
            $this->data['product'] = DB::table('items')->select(
                'items.id as id',
                config('app.locale') . '_name as name',
                config('app.locale') . '_items.desc',
                'item_photo as photo',
                'item_url_slug as slug',
                'price',
                'old_price')
                ->join(config('app.locale') . '_items', 'id', '=', 'item_id')
                ->where([
                    ['item_url_slug', '=', $request->segment(2)],
                    ['enabled', '=', 1],
                ])
                ->get()->toArray()[0];



            $this->data['product']->attrs = DB::table('item_attributes')->select(
                config('app.locale') . '_name as name',
                'value')
                ->join('attributes', 'attributes.id', '=', 'item_attributes.attr_id')
                ->where('item_id', '=', $this->data['product']->id)
                ->get()->toArray();
        } catch (\Exception $e) {
            abort(404);
        }

        return view('site.product', [
            'class' => 'product',
            'data' => $this->data,
            'title' => '',
            'description' => '',
            'rating' => $this->stars->index($request),
            'starts' => false, //hide starts in footer
        ]);
    }

    //TODO:: DELETE ME
    /** Getting all Items in current SubCategory
     * If exist filters (brand ID) then filter and sort else, if request hasn't filter do sort only
     * @param Request $request
     * @return $this
     */
//    public function getSubCategoryItems(Request $request)
//    {
//        $sort = ($request->sort) ? $request->sort : 'asc_name';
//        $bs = ($request->bs)?$request->bs:Null;
//        $i_model = new Item;
//        $brand_model = new Brand();
//        $sort_config = $this->setSortConfig($sort);
//        // getting all items in SubCategory
//        $data = $i_model->getSubCategoryItems($this->getSubCategoryId(), $sort_config, $bs);
//        //gettings existing brands via ID
//
//        return view('getSubCategory-test')->with([
//            'sort' => $sort,
//            'items' => $data['items']->paginate($this->page_count),
//            'segment' => $this->sc_segment,
//            'i_method' => $sort_config['method'],
//            'scat' => $this->getSubCategoryData(),
//            'scat_method' => $this->getSubCategoryMethod(),
//            'brands'=>$brand_model->getSubCategoryBrands($data['brand_ids']),
//            'bs'=>$bs,
//            'cat'=>$this->getCategoryData(),
//            'cat_method'=>$this->getCategoryMethod(),
//        ]);
//    }

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

    /** getting SubCategory ID
     * @return Integer
     */
    private function getSubCategoryId()
    {
        $sc = new SubCategory();
        // getting SubCategory ID
        $sc_id = $sc->getSubCategoryId($this->sc_segment);
        return $sc_id;
    }

    /**
     * getting data only about SubCategory
     * title, desc and so
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    private function getSubCategoryData()
    {
        $sc_data = SubCategory::with($this->getSubCategoryMethod())->where('id', $this->getSubCategoryId())->first();
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
        switch ($sort) {
            case 'asc_price':
            case 'desc_price':
                $orderBy = ([
                    'order' => $order,
                    'sortBy' => "price",
                    'method' => $method,
                ]);
                break;
            default:
                $orderBy = ([
                    'order' => $order,
                    'sortBy' => $method . ".name",
                    'method' => $method,
                ]);
        }
        return $orderBy;
    }

    private function getCategoryId(){
        return SubCategory::with('getCategory')->where('id',$this->getSubCategoryId())->first()->cat_id;
    }

    private function getCategoryMethod(){
        $c_methods = array('RuCategoryJustName','UkCategoryJustName');
        switch ($this->locale){
            case 'uk':
                return $c_methods[1];
                break;
            default: return $c_methods[0];
        }
    }

    private function getCategoryData(){
        $c_data = Category::with($this->getCategoryMethod())->where('id', $this->getCategoryId())->first();
        return $c_data;
    }
}
