<?php

namespace App\Http\Controllers\Site;

use App;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends BaseController
{
    private $page_count = 6;

    public function index(Request $request)
    {
        $this->data['articles'] = Blog::wherePublished(1)->
        select('title', 'body', 'photo', 'url_slug as slug', 'views')->
        orderBy('created_at')->
        paginate($this->page_count);

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
        $b = new Blog();
        $segment = $request->segment(2);
        $this->data['article'] = $b::where([
            ['url_slug', $segment],
            ['published', 1],
        ])->
        select('id', 'title', 'body', 'photo', 'views', 'url_slug as slug')->
        first();
        if (!$this->data['article']) {
            return abort(404);
        }
        $this->data['similar'] = $b::where([
            ['published', 1],
            ['url_slug', '<>', $segment]
        ])->
        select('id', 'title', 'body', 'photo', 'views', 'url_slug')->
        inRandomOrder()->
        take(3)->
        get();

        app('App\Http\Controllers\Admin\BlogController')->addView($this->data['article']->id);

        return view('site.blog.inside', [
            'class' => 'blog-inside',
            'data' => $this->data,
            'title' => $this->data['article']->title,
            'description' => do_excerpt($this->data['article']->body, 25),
            'starts' => false,
            'rating' => $this->stars->index($request),
        ]);
    }
}
