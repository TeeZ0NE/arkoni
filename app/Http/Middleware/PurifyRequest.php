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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->name = Purify::clean($request->name);
        $request->q = Purify::clean($request->q);

        return $next($request);
    }
}
