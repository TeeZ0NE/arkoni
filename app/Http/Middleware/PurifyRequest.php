<?php

namespace App\Http\Middleware;

use Closure;
use Purify;

class PurifyRequest
{
    /**
     * Handle an incoming request.
     * sanitize request
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (isset($request->job_title)) {
            $request->job_title = Purify::clean($request->job_tile);
        }
        if (isset($request->name)) {
            $request->name = Purify::clean($request->name);
        }
        if (isset($request->ru_name)) {
            $request->ru_name = Purify::clean($request->ru_name);
        }
        if (isset($request->uk_name)) {
            $request->uk_name = Purify::clean($request->uk_name);
        }
        if (isset($request->ru_title)) {
            $request->ru_title = Purify::clean($request->ru_title);
        }
        if (isset($request->uk_title)) {
            $request->uk_title = Purify::clean($request->uk_title);
        }
        if (isset($request->uk_desc)) {
            $request->uk_desc = Purify::clean($request->uk_desc);
        }
        if (isset($request->ru_desc)) {
            $request->ru_desc = Purify::clean($request->ru_desc);
        }
        if (isset($request->ru_seo_text)) {
            $request->ru_seo_text = Purify::clean($request->ru_seo_text);
        }
        if (isset($request->uk_seo_text)) {
            $request->uk_seo_text = Purify::clean($request->uk_seo_text);
        }
        if (isset($request->q)) {
            $request->q = Purify::clean($request->q);
        }
        if (isset($request->ru_h1)) {
            $request->ru_h1 = Purify::clean($request->ru_h1);
        }
        if (isset($request->uk_h1)) {
            $request->uk_h1 = Purify::clean($request->uk_h1);
        }
        if (isset($request->ru_h2)) {
            $request->ru_h2 = Purify::clean($request->ru_h2);
        }
        if (isset($request->uk_h2)) {
            $request->uk_h2 = Purify::clean($request->uk_h2);
        }
        if (isset($request->cat_url_slug)) {
            $request->cat_url_slug = Purify::clean($request->cat_url_slug);
        }
        if (isset($request->sub_cat_url_slug)) {
            $request->sub_cat_url_slug = Purify::clean($request->sub_cat_url_slug);
        }
        if (isset($request->item_url_slug)) {
            $request->item_url_slug = Purify::clean($request->item_url_slug);
        }
        if (isset($request->email)) {
            $request->email = Purify::clean($request->email);
        }
        return $next($request);
    }
}
