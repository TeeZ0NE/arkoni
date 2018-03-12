<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Site\StarsController;

class SiteController extends Controller
{
    private $stars = false;

    public function __construct()
    {
        $this->stars = new StarsController();
    }

    public function front(Request $request) {

        return view('site.front', [
            'class' => 'front',
//            'data' => $data,
            'title' => __('seo.front-title'),
            'description' => __('seo.front-description'),
            'rating' => $this->stars->index($request),
        ]);
    }

    public function categories(Request $request) {

        return view('site.categories', [
            'class' => 'categories',
//            'data' => $data,
            'title' => __('seo.categories-title'),
            'description' => __('seo.categories-description'),
            'rating' => $this->stars->index($request),
        ]);
    }

    public function sub_categories(Request $request) {

        return view('site.sub-categories', [
            'class' => 'sub-categories',
//            'data' => $data,
            'title' => '',
            'description' => '',
            'rating' => $this->stars->index($request),
        ]);
    }

    public function products(Request $request) {

        return view('site.products', [
            'class' => 'products',
//            'data' => $data,
            'title' => '',
            'description' => '',
            'rating' => $this->stars->index($request),
        ]);
    }

}
