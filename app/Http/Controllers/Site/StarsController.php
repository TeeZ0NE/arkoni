<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StarsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('stars-rating')->where('page', $request->input('page'))->select('ratings', 'count')->get();
            if ($data->count()) {
                $query = $request->all();
                unset($query['_']);

                DB::table('stars-rating')
                    ->where('page', $request->input('page'))
                    ->update($query);
                return response()->json($query);
            }
        }

        $page = $request->segments();
        unset($page[0]);
        $page = implode("/", $page);

        if (!$page) {
            $page = 'front'; //front page
        }

        $data = DB::table('stars-rating')->where('page', $page)->select('ratings', 'count')->get();

        if (!$data->count()) { // if rating !isset
            $newRating = $this->generationRating($page);
            DB::table('stars-rating')->insert($newRating);
            return $newRating;
        }
        return (array)$data[0];
    }

    private function generationRating($name)
    {
        return [
            'ratings' => mt_rand(9 * 1000000, 10 * 1000000) / 1000000,
            'count' => mt_rand(800, 1500),
            'page' => $name
        ];
    }
}
