<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Site\BaseController;
use App\Http\Controllers\Site\StarsController;
//use App\Models\Category;
use Illuminate\Support\Facades\DB;

class SiteController extends BaseController
{

    public function front(Request $request) {

        return view('site.front', [
            'class' => 'front',
            'data' => $this->data,
            'title' => __('seo.front-title'),
            'description' => __('seo.front-description'),
            'rating' => $this->stars->index($request),
        ]);
    }

}
