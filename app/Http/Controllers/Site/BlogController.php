<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Site\BaseController;
use App\Http\Controllers\Site\StarsController;
use Illuminate\Support\Facades\DB;

class BlogController extends BaseController
{
    public function index(Request $request) {

        return view('site.blog.index', [
            'class' => 'blog',
            'data' => $this->data,
            'title' => __('seo.blog-title'),
            'description' => __('seo.blog-description'),
            'rating' => $this->stars->index($request),
        ]);
    }

    public function inside(Request $request) {

        return view('site.blog.inside', [
            'class' => 'blog-inside',
            'data' => $this->data,
            'title' => '',
            'description' => '',
            'starts' => false,
            'rating' => $this->stars->index($request),
        ]);
    }
}
