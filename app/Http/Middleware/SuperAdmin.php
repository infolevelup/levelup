<?php

namespace App\Http\Middleware;

use Closure;
use ValidateRequests;
use Auth;

class SuperAdmin
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/admin/login');
        }
        else{
            if (Auth::user()->role->name == "Admin") {
                return $next($request);
            }
            if (Auth::user()->role->name == "User") {
                Auth::logout();
                return back()->with('flash_error', 'Email, Password is incorrect');
            }
        }
        
    }
}
