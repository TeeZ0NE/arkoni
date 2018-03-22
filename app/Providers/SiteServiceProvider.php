<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use DB;

class SiteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->topMenu();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function topMenu()
    {
        View::composer('site.index', function ($view) {
            $category = DB::table('categories')->select('categories.id as id', config('app.locale') . '_name as name', 'cat_url_slug as slug')
                ->join(config('app.locale') . '_categories', 'categories.id', '=', config('app.locale') . '_categories.cat_id')
                ->orderBy('name')
                ->get()->toArray();

            $sub_category = DB::table('sub_categories')->select('sub_categories.cat_id as id', config('app.locale') . '_name as name', 'sub_cat_url_slug as slug')
                ->join(config('app.locale') . '_sub_categories', 'sub_categories.id', '=', config('app.locale') . '_sub_categories.sub_cat_id')
                ->orderBy('id')
                ->get()->toArray();

            foreach ($category as $key => $obj) {
                $menu[$obj->id] = $obj;
                $menu[$obj->id]->sub = [];
                foreach ($sub_category as $item => $val) {
                    $arr = array();
                    if ($obj->id == $val->id) {
                        array_push($menu[$obj->id]->sub, $val);
                    }
                }
            }

            $view->with('menu', $menu);
        });
    }
}
