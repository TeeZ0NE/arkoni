<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
    	// print_r($request);
    	switch ($guard) {
    		case 'admin':
    		if(Auth::guard($guard)->check()){
    			return redirect()->route('admin.dashboard');
    		}
    		else {echo 'oops';}
    		break;

    		default:
    		if (Auth::guard($guard)->check()) {
            // return redirect('/home');
    			return redirect()->route('home');
    		}
    		break;
    	}


    	return $next($request);
    }
}
