<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Course_student;
use App\Assignment;
use App\Lesson;
use App\Project;
use App\Student_Assignment;
use Auth;
use DB;
use App\Student_Project;
use App\Lessons_video_media;

class SelflearningController extends Controller
{
    public function displaycourse(Request $request,$course_slug){
          // $course = Course::where('slug', $course_slug)->with('publishedLessons')->firstOrFail();
          $course = Course::where('slug', $course_slug)->firstOrFail();
         //print_r($course);
      $purchased_course = \Auth::check() && Course_student::where('user_id', \Auth::id())->count() > 0;
        if(($course->published == 0) && ($purchased_course == false)){
            abort(404);
        }
        return view('self_learning/course_learning',compact('course'));
    }
    
    public function liveclass(Request $request,$id,$course_slug){
          // $course = Course::where('slug', $course_slug)->with('publishedLessons')->firstOrFail();
          $media = Lessons_video_media::where('id', $id)->first();
                   $course = Course::where('slug', $course_slug)->firstOrFail();

         //print_r($course);
      $purchased_course = \Auth::check() && Course_student::where('user_id', \Auth::id())->count() > 0;
        if(($purchased_course == false)){
            abort(404);
        }
        return view('self_learning/live_class',compact('course','media'));
    }
    
    public function fileUploadPost(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx,xlx,csv|max:2048',
        ]);
  
        $fileName = time().'.'.$request->file->extension();  
   
        $request->file->move(public_path('uploads'), $fileName);
   
    $already=Student_Assignment::where('user_id',Auth::user()->id)->where('course_id',$request->course_id)->where('lesson_id',$request->lesson_id)->first();
           if(!$already){
               
                $banner = new Student_Assignment;
        $banner->lesson_id = $request->lesson_id;
        $banner->course_id = $request->course_id;
                $banner->user_id = Auth::user()->id;

        $banner->assignment_id= $request->assignment_id;
        $banner->assignment= $fileName;
   
        $banner->save();
        return back()
            ->with('flash_success','You have successfully upload file.');

           }else{
               
               return back()
            ->with('flash_error','You have already submitted the assignment.');
           }
               
    }
    
   
   
    public function projectUploadPost(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx,xlx,csv|max:2048',
        ]);
  
        $fileName = time().'.'.$request->file->extension();  
   
        $request->file->move(public_path('uploads'), $fileName);
   
    $already=Student_Project::where('user_id',Auth::user()->id)->where('course_id',$request->course_id)->where('project_id',$request->project_id)->first();
           if(!$already){
               
                $banner = new Student_Project;
        $banner->course_id = $request->course_id;
                $banner->user_id = Auth::user()->id;

        $banner->project_id= $request->project_id;
        $banner->project= $fileName;
   
        $banner->save();
        return back()
            ->with('flash_success','You have successfully upload file.');

           }else{
               
               return back()
            ->with('flash_error','You have already submitted the Project work.');
           }
               
    }
    
    
      public function displayassignment(Request $request,$course_id,$lesson_id){
         
         $course=Course::where('id',$course_id)->first();
         $lesson=Lesson::where('id',$lesson_id)->first();
        $data=Assignment::where('course_id',$course_id)->where('lesson_id',$lesson_id)->first();
        
          $user_id=Auth::user()->id;

          $classusers = DB::table('chapter_students')
                ->where('user_id', $user_id)->where('type','quizz')->where('course_id',$course_id)->where('lesson_id',$lesson_id)
                ->first();
        if(!$classusers){ 
                     $insert=DB::table('chapter_students')->insert(
            ['user_id' => $user_id,
            'type' => 'assignment',
            'course_id'=>$course_id,
            'lesson_id'=>$lesson_id,
            'status'=>'viewed',
            ]
            );
        }
          
        
        return view('self_learning/assignment',compact('data','course','lesson'));
    }
    
    
     public function displayproject(Request $request,$course_id){
         //return 'a';
         $course=Course::where('id',$course_id)->first();
        $data=Project::where('course_id',$course_id)->first();
        return view('self_learning/projects',compact('data','course'));
    }
    
    
    
     public function showcertificate(Request $request,$id)
        {
           $data=Course_student::where('id',$id)->first();
             return view('self_learning/certificate', compact('data'));
        }
}
