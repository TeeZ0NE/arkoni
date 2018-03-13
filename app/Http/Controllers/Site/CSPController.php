<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Site\StarsController;

class CSPController extends Controller
{
    private $stars = false;

    public function __construct()
    {
        $this->stars = new StarsController();
    }


    public function catalog(Request $request) {

        return view('site.catalog', [
            'class' => 'catalog',
//            'data' => $data,
            'title' => __('seo.catalog-title'),
            'description' => __('seo.catalog-description'),
            'rating' => $this->stars->index($request),
        ]);
    }

    public function category(Request $request) {

        return view('site.category', [
            'class' => 'category',
//            'data' => $data,
            'title' => '',
            'description' => '',
            'rating' => $this->stars->index($request),
        ]);
    }

    public function sub_category(Request $request) {

        return view('site.sub-category', [
            'class' => 'sub-category',
//            'data' => $data,
            'title' => '',
            'description' => '',
            'rating' => $this->stars->index($request),
        ]);
    }

    public function product(Request $request)
    {
        return view('site.product', [
            'class' => 'product',
//            'data' => $data,
            'title' => '',
            'description' => '',
            'rating' => $this->stars->index($request),
            'starts' => false, //hide starts in footer
        ]);
    }
}
