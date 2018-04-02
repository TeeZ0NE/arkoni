<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Site\BaseController;
use App\Http\Controllers\Site\StarsController;
use Illuminate\Support\Facades\DB;

class SiteController extends BaseController
{

    public function front(Request $request)
    {
        //get 4 rand products
        $this->data['rand-top-products'] = DB::table('items')->select(
            config('app.locale') . '_name as name',
            'item_url_slug as slug',
            'item_photo as photo',
            'price',
            'shortcuts.name AS shortcut')
            ->join(config('app.locale') . '_items', 'items.id', '=', config('app.locale') . '_items.item_id')
            ->join('item_shortcuts', 'items.id', '=', 'item_shortcuts.item_id')
            ->join('shortcuts', 'shortcuts.id', '=', 'item_shortcuts.shortcut_id')
            ->where([
                ['enabled', '=', 1],
                ['shortcuts.name', '=', 'top-sales']
            ])
            ->inRandomOrder()
            ->take(4)
            ->get()->toArray();

        return view('site.front', [
            'class' => 'front',
            'data' => $this->data,
            'title' => __('seo.front-title'),
            'description' => __('seo.front-description'),
            'rating' => $this->stars->index($request),
        ]);
    }

    public function contacts(Request $request)
    {

        return view('site.contacts', [
            'class' => 'contacts',
            'data' => $this->data,
            'title' => __('seo.contacts-title'),
            'description' => __('seo.contacts-description'),
            'rating' => $this->stars->index($request),
        ]);
    }

}
