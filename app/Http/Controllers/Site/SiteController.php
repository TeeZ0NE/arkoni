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
