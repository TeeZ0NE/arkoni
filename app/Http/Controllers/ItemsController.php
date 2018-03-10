<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand as Brand;
use App\Models\ItemCategory as ICat;
use App\Models\ItemAttribute as IAttr;
use App\Models\Description as IDesc;
use App\Models\Review as IRev;
use App\Models\Item_old as Item;
use App\Models\Category as Cat;
use App\Models\Attribute as Attr;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelFail;
//use Illuminate\Database\QueryException as QE;

class ItemsController extends Controller
{
    /**
     * category model
     * @var Object
     */
    private $cat;
    /**
     * brand (manufacturer) model
     * @var Object
     */
    private $brand;
    /**
     * attributes model
     * @var Object
     */
    private $attr;
    /**
     * model of item attribubutes
     * @var Object
     */
    private $iattr;
    /**
     * item model
     * @var Object
     */
    private $item;
    /**
     * item categories model
     * @var Object
     */
    private $icat;
    /**
     * model of description
     * @var Object
     */
    private $desc;
    /**
    * Array of attributes and values
    * @var Array
    */
    private $attrs_vals_arr=[];
    /**
     * count items on page
     * @var Int
     */
    private $pag_count=10;

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
        return view('admin.pages.items')->with([
            'count'=>$this->item::count(),
            'sort'=>'acs',
            'items'=>$this->item::with(['brand'])->paginate($this->pag_count),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.items_create')->with([
            "brands" => $this->brand::all('name', 'id'),
            "cats"   => $this->cat::all('name', 'id'),
            "attrs" => $this->attr::all('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'img_upload' => 'image|mimes:jpeg,png,jpg|max:2048',
            'name'       => 'max:255|required|unique:items',
            'brand_id'   => 'required|numeric',
            'price'      => 'required|numeric',
            'price_new'  => 'required|numeric',
            'categories' => 'required',
        ]);
        /* if admin want more explicity with categories
        if(empty($request->cats)){
            $request->flash();
            return redirect()
            ->back()
            ->withErrors(['categories'=>'Виберіть категорію!']);
        }*/
        $name = $this->get_name($request);
        //storing photo
        $file_name = $this->set_image($request);
        // store item
        $curr_item_id = $this->set_item($request, $name, $file_name);
        try {
            if (!$curr_item_id) {
                throw new Exception("Неможливо отримати ID товара");
            }
            //description
            $res = $this->store_desc($request->desc, $curr_item_id);
            if (!$res) {
                throw new Exception("Неможливо записати опис товара");
            }
            //categories
            $res = $this->set_cats($request->categories, $curr_item_id);
            if (!$res) {
                throw new Exception("Неможливо записати категорі-ю(ї) товара");
            }
            // attributes
            if (!empty($request->attrs)) {
                $res = $this->set_attrs($request->attrs, $request->values, $curr_item_id);
                if (!$res) {
                    throw new Exception("Неможливо записати атрибути товара");
                }
            }
        } catch (Exception $e) {
            return redirect()
            ->back()
            ->withErrors(['Error'=>$e->getMessage()]);
        }
        session()->flash('msg', 'Новий товар додано до бази!');
        return view('admin.pages.items')->with([
            'count'=>$this->item::count(),
            'items'=>$this->item::with(['brand','categories'])->get(),
        ]);
    }

    /**
     * getting item's name from request
     * @param  Request $request
     * @return String
     */
    private function get_name($request)
    {
        return $request->name;
    }

    /**
     * storing main new item to DB
     * @param  Request $request
     * @param  String  $namame      getting name from get_name method
     * @param  String  $file_name generated file name of image
     * @return Int             if stored return item's ID else false
     */
    private function set_item(Request $request, $name, $file_name)
    {
        $this->item->name = $name;
        $this->item->url_slug = url_slug($name);
        $this->item->price = $request->price;
        $this->item->new_price = $request->price_new;
        $this->item->tags = $request->tags;
        $this->item->brand_id = $request->brand_id;
        $this->item->enabled = $request->enabled;
        $this->item->photo = $file_name;
        try {
            $this->item->save();
            return $this->item->id;
        } catch (ModelFail $e) {
            Log::error('Error to write item', ["mes"=>$e]);
            return 0;
        }
    }
    /**
    * storing item's description
    * @param  Int $curr_item_id current item's ID
    * @return Bool               if saved TRUE else False
    */
    private function store_desc($desc, $curr_item_id)
    {
        $this->idesc->id = $curr_item_id;
        $this->idesc->desc = $desc;
        try {
            return $this->idesc->save();
        } catch (ModelFail $e) {
            Log::error('Error to write description', ["mes"=>$e]);
            return 0;
        }
    }

    /**
     * inserting new item's categories
     * @param  Request $request
     * @param  Int  $curr_item_id current item's ID
     * @return Bool                stored or not
     */
    private function set_cats($categories, $curr_item_id)
    {
        foreach ($categories as $cat) {
            try {
                $this->icat->insert([
                    'id'          => $curr_item_id,
                    'category_id' => $cat]);
            } catch (ModelFail $e) {
                Log::error('Error to write categories', ["mes"=>$e]);
                return 0;
            }
        }
        return 1;
    }

    /**
     * getting image file name
     * @param  Request $request
     * @param  integer $width   image width
     * @param  integer $height  image height
     * @return String           file name with defaults
     */
    private function set_image(Request $request, $width=300, $height=300)
    {
        if ($request->hasFile('img_upload')) {
            $file = $request->file('img_upload');
            $fileExt = $file->extension();
            $file_name = time().url_slug($request->name).'.'.$fileExt;
            $public_path = config('app.img_path');
            Storage::putFileAs('public/img', $file, $file_name);
            $img = Image::make($public_path.$file_name)
            ->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            })
            // ->text('The quick brown fox jumps over the lazy dog.', 50, 150)
            ->insert($public_path.'wm.png', 'center')
            ->save();
            return $file_name;
        // print_r(Storage::allFiles('public/img'));
        } else {
            return 'no_image.png';
        }
    }

    /**
     * inserting new item attributes
     * @param Array $attrs        array of attrributes from reqest
     * @param Array $values       array of values
     * @param Int $curr_item_id ID of current item
     * @return Bool inserting new attributes with values or not
     */
    private function set_attrs($attrs, $values, $curr_item_id)
    {
        # merge 2 arrays. One are keys of another array
        $attrs_vals_arr=[];
        foreach ($attrs as $keys =>$key) {
            $attrs_vals_arr[$key]=$values[$keys];
        }
        foreach ($attrs_vals_arr as $attr => $value) {
            try {
                $this->iattr->insert([
                   'id'      => $curr_item_id,
                   'attr_id' => $attr,
                   'value'   => $value
               ]);
            } catch (ModelFail $e) {
                Log::error('Error to write item attrs', ["mes"=>$e]);
                return 0;
            }
        }
        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'showing '.$id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'editing '.$id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 'destroy '.$id;
    }

    public function search(Request $request)
    {
        $request->flash();
        $order = "asc";
        $order_by="";
        $rsort = $request->sort;
        $q = $request->q;
        $count = $this->item::count();
        $asc_arr = array('asc_iname','asc_brand','asc_price','asc_enabled');
        $desc_arr = array('desc_iname', 'desc_brand', 'desc_price', 'desc_enabled');

        if (in_array($rsort, $asc_arr)) {
            $order = 'asc';
        }
        if (in_array($rsort, $desc_arr)) {
            $order='desc';
        }
        switch ($rsort) {
            case 'asc_iname':
            case 'desc_iname':
            $order_by = 'name';
            break;

            case 'asc_brand':
            case 'desc_brand':
            $order_by = 'brand';
            break;

            case 'asc_price':
            case 'desc_price':
            $order_by = 'price';
            break;

            case 'asc_enabled':
            case 'desc_enabled':
            $order_by = 'enabled';
            break;
            default:
            $order_by = 'name';
            break;
        }
        // empty search request
        if (empty($request->q)){
            switch ($order_by) {
                case 'brand':
                $brands = $this->brand::with(['items'])
                ->orderBy('name',$order)
                ->paginate($this->pag_count);
                break;

                default:
                $items = $this->item::with(['brand'])
                ->orderBy($order_by,$order)
                ->paginate($this->pag_count);
                break;
            }
        }
        else{
            switch ($order_by) {
                case 'brand':
                $brands = $this->brand::with(['items'])
                ->where('name','LIKE','%'.$q.'%')
                ->orderBy('name',$order)
                ->paginate($this->pag_count);
                break;

                default:
                $items = $this->item::with(['brand'])
                ->where('name','LIKE','%'.$q.'%')
                ->orWhere('tags','LIKE','%'.$q.'%')
                ->orderBy($order_by,$order)
                ->paginate($this->pag_count);
                break;
            }
        }
        // returning view
        switch ($order_by) {
            case 'brand':
                return view('admin.pages.items')
                ->with([
                    'brands'=>$brands,
                    'count'=>$count,
                    'sort'=>$rsort
                ]);
                break;
            
            default:
                return view('admin.pages.items')
                ->with([
                    'items'=>$items,
                    'count'=>$count,
                    'sort'=>$rsort
                ]);
                break;
        }


    }
}
