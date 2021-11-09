<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Str;

use App\TeacherProfile;
use App\TeacherSkills;
use App\User;
use App\Cart;
use DB;
use Auth;
use App\Course;
use Hash;
use Validator;
use Session;
use App\Course_student;
use App\Rating;
use App\TestsResult;

class CourseController extends Controller
{
    
     public function show($course_slug)
    {
       
       
        $course = Course::withoutGlobalScope('filter')->where('slug', $course_slug)->with('publishedLessons')->firstOrFail();
        if(($course->published == 0)){
            abort(404);
        }
       
            $course_rating = 0;
        $total_ratings = 0;
        $completed_lessons = "";
        $is_reviewed = false;
       
        $lessons = $course->courseTimeline()->orderby('sequence','asc')->get();
         if(auth()->check() && $course->reviews()->where('user_id','=',auth()->user()->id)->first()){
            $is_reviewed = true;
        }
        if ($course->reviews->count() > 0) {
            
        $course_rating = $course->reviews->avg('rating');
            $total_ratings = $course->reviews()->where('rating', '!=', "")->where('status','approve')->get()->count();
        }
      
        
        return view( 'coursedetails', compact('course','lessons','course_rating', 'completed_lessons','total_ratings','is_reviewed'));
    }


    
 public function userquizz(Request $request){
    // return 'a';
     
     
     if($user = Auth::user()){
         $order=TestsResult::where('user_id',Auth::user()->id)->get();
          
            
           
           return view('userquizz',compact('order')); 
        }else{
            abort(404);
        }
 }
 
 
 
  public function usercoursepage(Request $request){
    // return 'a';
     
     
     if($user = Auth::user()){
         $order=Course_student::where('user_id',Auth::user()->id)->get();
          
            $Active=Course_student::where('user_id',Auth::user()->id)->whereNULL('grade')->get();
           
           return view('usercourse',compact('order','Active')); 
        }else{
            abort(404);
        }
 }
 
    
}