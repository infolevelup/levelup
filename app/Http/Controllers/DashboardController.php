<?php

namespace App\Http\Controllers;

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
use App\Rating;
use Session;
use App\Course_student;
use Carbon\Carbon;


class DashboardController extends Controller
{
    //
     public function index(Request $request)
    {
        
        if($user = Auth::user()){
          $course_purchase=Course_student::where('user_id',Auth::user()->id)->first();
             
             if($course_purchase){
                                $purchased_course=$course_purchase->course_id;
 
                          $crs_prcse=Course_student::where('user_id',Auth::user()->id)->get();
                         

             }else{
                 $crs_prcse='';
                 $crs_type='';
             }
       $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(7);

            return view('student.dashboard',compact('crs_prcse','startDate','endDate')); 
            
            
        }else{
            abort(404);
        }
    	
    }
         public function profile(Request $request)
    {
        if($user = Auth::user()){
           $user=User::where('id',Auth::user()->id)->first();
           return view('student.profile',compact('user')); 
           
        }else{
            abort(404);
        }
    	
    }
    
    
        public function showcertificate(Request $request)
    {
        if($user = Auth::user()){
            $user=Course_student::where('user_id',Auth::user()->id)->where('grade','=','A Grade')->orwhere('grade','=','B Grade')->orwhere('grade','=','C Grade')->get();
           return view('user_certificate',compact('user')); 
           
        }else{
            abort(404);
        }
    	
    }
    
    public function updatestudprofile(Request $request){
         $product = User::find(Auth::user()->id);

                  if($request->hasfile('image'))
            {
                $file = $request->file('image');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'),$filename); 
                  $product->image = $filename;  
            }
             $user= DB::table('users as u')->where('u.id',Auth::user()->id)
           ->update([
                'u.name' => $request->input('name'),
              'u.phone'=>$request->input('phone'),
                'u.email' => $request->input('email'),
                'u.street' =>$request->input('street'),
                'u.city'=>$request->input('city'),
                'u.state'=>$request->input('state'),
                'u.country'=>$request->input('country'),
                     'u.dob' => $request->input('dob'),
               // 'password' => Hash::make($request->password),
              
                ]);
        
        if($request->password!=''&& $request->newpass!=''){
            
           
            if (Hash::check($request->input('password'), $product->password)) {
                if($request->newpass==$request->confirmpass){
                // return 'mp';
                  $users=  DB::table('users as u')->where('u.id',Auth::user()->id)
           ->update([
               
               'password' => Hash::make($request->newpass),
              
                ]);
                }else{
                     return back()->with('flash_success', 'Both new password and Confirm password are not same');
                }    
            }else{
                return back()->with('flash_success', 'The old password does not match...');
            }
           
        }
        
                                                   return back()->with('flash_success', 'Updated successfully');
    }
    public function updateprofile(Request $request){
      
          $product = User::find(Auth::user()->id);

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
    
    
    
    
    //------------coursebox details---------------
 public function coursebox(Request $request)
    {
        
            $id=$request->course_id;
        // $product = DB::select("select * from product where id=$id ");
      
       $product = DB::table('courses')->where('id',$id)->first();
      $color= $product->color;
      $output='
       <div class="course-box01">
       <h2>'.$product->type.'</h2>
       <div class="course-banner"><h3><span>'.$product->title.'</span></h3></div>
	<a href="course_learning/'.$product->slug.'" class="go-course">Go to Course</a>
	</div>  
	<div>
      
      ';
			echo json_encode($output);
			
    }
    //----------------------reviw
    
     public function ratingreview(Request $request){
    
    $rate=Rating::where('user_id',Auth::user()->id)->where('course_id',$request->courseid)->get();
    if($rate->isEmpty()){
        $rating = new  Rating;
        $rating->course_id = $request->courseid;
        $rating->user_id = Auth::user()->id;
        $rating->session_id = Session::getId();
        $rating->rating = $request->rating;
        $rating->comments = $request->comments;
        $rating->save();
        return back()->with('flash_success', 'rating successfully');
    }else{
        return back()->with('flash_error', 'Already given the rating');
    }
 }
//-------------------------------------


   public function shownotification(Request $request)
    {
    	return view('notification');
    }
    
}
