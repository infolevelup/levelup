<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;

use App\TeacherProfile;
use App\TeacherSkills;
use App\User;
use DB;
use Auth;
use Hash;
use Validator;
use App\Course;
use App\Course_student;
use App\Batch;
use App\AssignBatch;
use App\classs;

class DashboardController extends Controller
{
    //
     public function index(Request $request)
    {
    	return view('user.dashboard');
    }
    
    public function updateprofile(Request $request){
      
    
          /*     if($request->hasfile('image'))
            {
                $file = $request->file('image');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'),$filename); 
                 $image = $filename;  
            }*/
                   $product = User::find($request->input('userid'));

                  if($request->hasfile('image'))
            {
                $file = $request->file('image');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'),$filename); 
                  $product->image = $filename;  
            }
          $user= DB::table('users as u')->where('u.id',$request->input('userid'))
            ->join('teacher_profiles as p', 'u.id', '=', 'p.user_id')
            ->update([
                'u.name' => $request->input('name'),
                'u.lastname' => $request->input('lastname'),
                'u.email' => $request->input('email'),
                'u.gender' => $request->input('gender'),
                 'u.dob' => $request->input('dob'),
               // 'password' => Hash::make($request->password),
                'p.experience' => $request->input('experience'),
                'p.education' => $request->input('education'),
                'p.location' => $request->input('location'),
                'p.designation' => $request->input('designation'),
                ]);
           
                 $product->save();
                // return $request->input('skills');
$rules = [];


        foreach($request->input('skills') as $key => $value) {
            $rules["skills.{$key}"] = 'required';
        }


        $validator = Validator::make($request->all(), $rules);


        if ($validator->passes()) {
     foreach($request->input('skills') as $key => $value) {
                TeacherSkills::create([
                    'skills'=>$value,
                
                'user_id'=>$request->userid,
                ]);
            }
        }


                                                   return back()->with('flash_success', 'Updated successfully');

    
    }
    
    public function changepassword(Request $request)
    {
          $data=$request->all();
   /// echo "<pre>"; print_r($data); die;

    if(!(Hash::check($request->currentpassword,Auth::user()->password))){
        return back()->with('flash_error','Your current password does not match..');
    }
//return 'n';
if($request->new_confirm_password==$request->newpasssword){
    $newpass=$request->input('newpasssword');
    $new_password=bcrypt($request->input('newpasssword'));
    // echo "<pre>"; print_r($newpass);
    //  echo "<pre>"; print_r($new_password); 
    // die;
      User::where('id',Auth::user()->id)->update(['password'=>$new_password]);
   
    return back()->with('flash_success','password changed successfully.....');
}
else{
            return back()->with('flash_error','New password and confirm password doesnot match..');

}
        
    }
    
    
    
    
    public function deleteskills(Request $request)
    {
        $cake = TeacherSkills::findOrFail($request->id);
        $cake->delete();
        return back()->with('flash_success', ' Deleted Successfully!');
    }
    
    
     
     public function CourseList(Request $request){
           // return 'a';
          if($user=Auth::user()->id){
              
              $users=User::where('id',$user)->first();
              if($users->role_id==2){
                  
                  $course=Course::where('teacher_id',Auth::user()->id)->get();
                    return view('user.courselist',compact('course'));
              }else{
                  abort(404);
              }
              
          }else
          {
              abort(404);
          }
      
        
    }
    
     public function studentlist(Request $request,$id){
           // return 'a';
          if($user=Auth::user()->id){
              
              $users=User::where('id',$user)->first();
              if($users->role_id==2){
                  
                  $course=Course_student::where('course_id',$id)->get();
                    return view('user.studentlist',compact('course'));
              }else{
                  abort(404);
              }
              
          }else
          {
              abort(404);
          }
      
        
    }
    
    
    
    
       public function batchlist(Request $request,$id){
           // return 'a';
          if($user=Auth::user()->id){
              
              $users=User::where('id',$user)->first();
              if($users->role_id==2){
                  
                  $batch=Batch::where('id',$id)->first();
                  $batches=classs::where('batch_id',$batch->id)->get();
                    return view('user.batchlist',compact('batch','batches'));
              }else{
                  abort(404);
              }
              
          }else
          {
              abort(404);
          }
      
        
    }
    
}
