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

    public function index(Request $request)
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
