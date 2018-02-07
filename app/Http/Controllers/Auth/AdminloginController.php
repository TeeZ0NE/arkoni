<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Validation\ValidationException;

class AdminloginController extends Controller
{


	public function __construct(){
		$this->middleware('guest:admin');
	}

	public function showLoginForm(){
		return view('auth.admin-login');
	}
	public function login(Request $request){
			// return true;
		$this->validate($request, [
			'email'    => 'required|email',
			'password' => 'required|min:6'
		]);
		
		if(Auth::guard('admin')->attempt([
			'email'    =>$request->email,
			'password' =>$request->password,
				// 'remember' =>$request->filled('remember'),
		]))
		{
				//if successful
			$request->session()->regenerate();
			return redirect()->intended(route('admin.dashboard'));
		}

			//unsuccessful

		return redirect()->back()->withInput($request->only('email'))->withErrors(['email' => trans('auth.failed')]);

			// return redirect()->back()->withInput($request->only('email'))->with(['email' => 'Wrong username/password combination.']);
	}
}
