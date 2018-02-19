<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand as Brand;
use App\Models\Item_Category as ICat;
use App\Models\Item_Attribute as IAttr;
use App\Models\Description as IDesc;
use App\Models\Review as IRev;
use App\Models\Item as Item;
use App\Models\Category as Cat;
use App\Models\Attribute as Attr;

class ItemsController extends Controller
{
    private $cat;
    private $brand;
    private $attr;
    private $iattr;
    private $item;
    private $icat;
    private $desc;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->item = new Item;
        $this->brand = new Brand;
        $this->cat = new Cat;
        $this->desc = new IDesc;
        $this->attr = new Attr;
    }
    public function index()
    {
        return view('admin.pages.items')->with([
            'count'=>$this->item::count()
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
            "brands" => $this->brand::all('name','id'),
            "cats"   => $this->cat::all('name','id'),
            "attrs" => $this->attr::all('name','id'),
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
        echo 'item name:'.$request->name
        .'<br>URL_slug:'.url_slug($request->name)
        .'<br>brand id:'.$request->brand_id
        .'<br>enabled:'.$request->enabled
        .'<br>price:'.$request->price
        .'<br>price-new:'.$request->price_new
        .'<br>cat select id:'.$request->cat_id
        .'<br>description:'.$request->desc
        .'<br>tags:'.$request->tags
        .'<br>';
        print_r($request->cats);
        // print_r($request->cats);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
