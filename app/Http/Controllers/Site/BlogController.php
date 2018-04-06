<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Site\BaseController;
use App\Http\Controllers\Site\StarsController;
use Illuminate\Support\Facades\DB;

class BlogController extends BaseController
{
    public function index(Request $request)
    {
        $this->data['articles'] = DB::table('blogs')->select('title', 'body', 'photo', 'url_slug as slug', 'views')
            ->where('published', '=', 1)
            ->orderBy('created_at')
            ->paginate(6);

        return view('site.blog.index', [
            'class' => 'blog',
            'data' => $this->data,
            'title' => __('seo.blog-title'),
            'description' => __('seo.blog-description'),
            'rating' => $this->stars->index($request),
        ]);
    }

    public function inside(Request $request)
    {
        $this->data['article'] = DB::table('blogs')->select('title', 'body', 'photo', 'views')
            ->where('url_slug', '=', $request->segment(2))
            ->get()
            ->toArray()[0];
        $this->data['similar'] = DB::table('blogs')->select('title', 'photo', 'url_slug')
            ->where([
                ['published', '=', 1],
                ['url_slug', '!=', $request->segment(2)]
            ])
            ->inRandomOrder()
            ->take(3)
            ->get();

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
