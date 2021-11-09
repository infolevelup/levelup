<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Course;
use App\Lesson;

use File;
use App\Helpers\Helper;
use App\Lessons_media;
use App\Course_timeline;
use Carbon\Carbon;
class LessonsController extends Controller
{
    //
     public function index()
    {

     
          $users = User::where('role_id',2)->get();
      $category = Lesson::orderby('id','DESC')->get();
      //return $category;
        return view('user.lessons.index', compact('users','category'));
    }
   public function show(Request $request,$id)
    {
           
           $lessons=Lesson::where('id',$id)->first();
          $course=Course::where('id',$lessons->course_id)->first();
          
        return view('user.lessons.show',compact('lessons','course'));
    }
   public function getlessons(Request $request,$id){
       
      // return 'aa';
      
        $lessons=Lesson::where('course_id',$id)->get();
        return view('user.lessons.lessons_details',compact('lessons'));
   }
}
