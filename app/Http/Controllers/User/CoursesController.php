<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Course;
use App\Lesson;
use App\course_user;
use App\Media;
use File;
use Auth;
use App\Helpers\Helper;

class CoursesController extends Controller
{
    //
    public function index()
    {

                 $userid=Auth::user()->id;

          $users = Course::where('published','1')->where('teacher_id',$userid)->orderby('id','DESC')->get();
      
        return view('user.courses.index', compact('users'));
    }
   
    public function show(Request $request,$id)
    {
            $course=Course::where('id',$id)->first();
            $category=Category::where('id',$course->category_id)->first();
            //return $category;
            $teacher=User::where('id',$course->teacher_id)->first();
           $lessons=Lesson::where('course_id',$id)->get();
        return view('user.courses.show',compact('course','category','teacher','lessons'));
    }
}
