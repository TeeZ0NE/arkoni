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

    public function __construct(Request $request)
    {
        $this->stars = new StarsController();
    }
}
