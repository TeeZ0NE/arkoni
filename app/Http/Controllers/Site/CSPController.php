<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Site\StarsController;
use Illuminate\Support\Facades\DB;

class CSPController extends BaseController
{

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
        try {
            $this->data['sub-category'] = DB::table('sub_categories')->select(
                config('app.locale') . '_sub_categories.' . config('app.locale') . '_name as name',
                config('app.locale') . '_sub_categories.title',
                config('app.locale') . '_sub_categories.desc',
                config('app.locale') . '_sub_categories.h1',
                config('app.locale') . '_sub_categories.seo_text',
                config('app.locale') . '_sub_categories.h2',
                config('app.locale') . '_sub_categories.seo_text_2',
                config('app.locale') . '_categories.ru_name as category_name',
                'categories.cat_url_slug as category_slug'
            )
                ->join(config('app.locale') . '_sub_categories', config('app.locale') . '_sub_categories.sub_cat_id', '=', 'sub_categories.id')
                ->join('categories', 'categories.id', '=', 'sub_categories.cat_id')
                ->join(config('app.locale') . '_categories', config('app.locale') . '_categories.cat_id', '=', 'categories.id')
                ->where('sub_cat_url_slug', $request->segment(2))
                ->get()->toArray()[0];

            $this->data['products'] = DB::table('items')->select(
                config('app.locale') . '_name as name',
                config('app.locale') . '_items.desc',
                'item_photo as photo',
                'item_url_slug as slug',
                'price',
                'new_price')
                ->join(config('app.locale') . '_items', 'id', '=', 'item_id')
                ->join('item_categories', 'item_categories.item_id', '=', 'items.id')
                ->join('sub_categories', 'sub_categories.id', '=', 'item_categories.sub_cat_id')
                ->join('categories', 'categories.id', '=', 'sub_categories.cat_id')
                ->where([
                    ['sub_categories.sub_cat_url_slug', '=', $request->segment(2)],
                    ['enabled', '=', 1]
                ])
                ->paginate(2);
        } catch (\Exception $e) {
            abort(404);
        }

        return view('site.sub-category', [
            'class' => 'sub-category',
            'data' => $this->data,
            'title' => $this->data['sub-category']->title,
            'description' => $this->data['sub-category']->desc,
            'rating' => $this->stars->index($request),
        ]);
    }

    public function product(Request $request)
    {
        try {
            $this->data['product'] = DB::table('items')->select(
                'items.id as id',
                config('app.locale') . '_name as name',
                config('app.locale') . '_items.desc',
                'item_photo as photo',
                'item_url_slug as slug',
                'price',
                'new_price')
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
}
