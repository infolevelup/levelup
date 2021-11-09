<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Redirect;
use Hash;
use Session;
use URL;

class LoginController extends Controller
{
    
    
 
public function showLoginForm()
{
    if(!session()->has('url.intended'))
    {
        session(['url.intended' => url()->previous()]);
    }
    return view('auth.login');
}
     
 
    //
 public function login(Request $request){
 	//return 'aa';
 	
 	  
   $user = User::where('email',$request->email)->where('status','Active')->first();
   
 
 if (!empty($user)){
     
 	if(Auth::attempt([
 		'email' =>$request->email,
 		'password' =>$request->password
 	]))
 	
 /*	{
 		$user = User::where('email',$request->email)->first();
 		if($user->is_admin()){
 			return redirect()->route('dashboard');
 		}
 		return redirect()->route('home');
 	}
 	return redirect()->back();
 }*/
  {
      
   
               if($user->role_id==1){   
                    return redirect('admin/dashboard');
                      
                    } elseif($user->role_id == 2){
                     // return redirect('user/dashboard');
                                          return redirect('dashboard');

                    }
                     elseif($user->role_id == 3){
                    //  return redirect('student/dashboard');
                  return redirect('dashboard');
                            //return Redirect::intended();
        /*if(Session::get('url.intended')){
                                    return Redirect::to(Session::get('url.intended'));
                            }else{
                                            return redirect('dashboard');
  
                            }*/
                            

                    }else{
                         return redirect()->route('home');
                    }
     
        
      
     
 
  
  
  }
     return redirect('/login')->with('flash_error', ' Username/Password is wrong!!!!');
      
  }else{
     // return 'asd';
          return redirect('/login')->with('flash_error', 'Your Account is not Activated !!!');
   
  }
    }
}