<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class LoginController extends Controller
{
    public function showLoginForm(Request $request)
    {
		return view('admin.auth.login');
    }

    public function login(Request $request)
    {
    	$this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
        	'email' => $request['email'],
        	'password' => $request['password'],
		];
	
		
	    if (Auth::attempt($credentials)) {
	
			
		    if (Auth::user()->role['name'] == "Admin") {
				
				return redirect()->route('adminHome');
				
		    }
		    if (Auth::user()->role['name'] == "User") {
                Auth::logout();
                return back()->with('flash_error', 'Email, Password is incorrect');
            }
	    }
	    else{
	    	return back()->with('flash_error', 'Email, Password is incorrect');
	    }
    }

    public function logout(){
        return 'a';
    	Auth::logout();
  		return redirect('/admin/login');
    }
}
