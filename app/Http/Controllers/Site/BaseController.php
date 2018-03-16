<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Site\StarsController;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
    protected $stars = false;
    protected $data = [];

    public function __construct()
    {
        $this->stars = new StarsController();

        $category = DB::table('categories')->select('categories.id as id', config('app.locale') . '_name as name', 'cat_url_slug as slug')
            ->join(config('app.locale') . '_categories', 'categories.id', '=', config('app.locale') . '_categories.cat_id')
            ->orderBy('name')
            ->get()->toArray();

        $sub_category = DB::table('sub_categories')->select('sub_categories.cat_id as id', config('app.locale') . '_name as name', 'sub_cat_url_slug as slug')
            ->join(config('app.locale') . '_sub_categories', 'sub_categories.id', '=', config('app.locale') . '_sub_categories.sub_cat_id')
            ->orderBy('id')
            ->get()->toArray();

        foreach ($category as $key => $obj) {
            $this->data['main-menu'][$obj->id] = $obj;
            $this->data['main-menu'][$obj->id]->sub = [];
            foreach ($sub_category as $item => $val) {
                $arr = array();
                if ($obj->id == $val->id) {
                    array_push($this->data['main-menu'][$obj->id]->sub, $val);
                }
            }
        }
    }
}
