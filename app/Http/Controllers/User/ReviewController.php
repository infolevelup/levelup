<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Bundle;
use App\Bundle_course;
use App\Category;
use App\Course;
use App\course_user;
use App\Media;
use File;
use App\Helpers\Helper;
use Auth;
class ReviewController extends Controller
{
    //
    public function index()
    {

     
        
        return view('user.reviews.index');
    }
   
   
   
}
