<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UserdashboardController extends Controller
{
    public function CourseList(Request $request){
            return 'a';
        return view('user.courselist');
        
    }
    
}
