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
class BundleController extends Controller
{
    //
    public function index()
    {
        $course=Course::where('teacher_id',Auth::user()->id)->get()->unique('category_id');
    // return $course;
         
        
        return view('user.bundle.index', compact('course'));
    }
   
   
    public function show(Request $request,$id)
    {
        
            $bundle=Bundle::where('id',$id)->first();
            $category=Category::where('id',$bundle->category_id)->first();
            //return $category;
           // $teacher=User::where('id',$course->teacher_id)->first();
           $bundle_course=Bundle_course::where('bundle_id',$bundle->id)->get();
        return view('user.bundle.show',compact('bundle','category','bundle_course'));
    }
}
