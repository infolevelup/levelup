<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use File;
use Hash;
use App\TeacherProfile;
use App\Course;
use App\Course_student;
use App\Batch;
use App\classs;
use App\Teacher_class_attended;


class TeachersController extends Controller
{
    //
    public function index()
    {

     
          $users = User::where('role_id',2)->get();
      
        return view('admin.teachers.index', compact('users'));
    }
     public function create()
    {
        return view('admin.teachers.create');
    }

   public function store(Request $request)
    {
        //echo "<pre>";print_r($_REQUEST);exit();

      /*  $this->validate($request, [
            'firstname' => 'required',

            'email' => 'required',
            'gender' => 'required',
              'password' => 'password',
        ]);*/
        if (User::where('email', '=', $request->email)->count() > 0)
        {
           return back()->with('flash_error', 'Your Already exists');
        }
        else
        {
	
          
                $product = new User;
                $product->role_id =2;
                $product->name = $request->firstname;
                $product->lastname = $request->lastname;
                $product->email = $request->email;
                $product->password = Hash::make($request->password);
                $product->gender = $request->gender;
                $product->status = $request->status;
                $product->description = $request->description;
                
                	if($request->hasfile('images'))
            {
                $file = $request->file('images');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/'),$filename); 
                 $product->image = $filename;  
            }
                $product->save();

               TeacherProfile::create([
            'user_id'=>$product->id,
          
        ]);

                
                return back()->with('flash_success', ' Created successfully');
            }
        
    }
    
public function show(Request $request)
   {
       
   }
public function edit(Request $request,$id)
   {
       $data= User::where('id',$id)->first();

     
       return view('admin.teachers.edit',compact('data'));
   }
   public function update(Request $request, $id)
   {
       
       
    //  dd($_REQUEST);
       $product = User::find($id);
      
                $product->role_id =2;
                $product->name = $request->firstname;
                $product->lastname = $request->lastname;
                $product->email = $request->email;
             
                $product->gender = $request->gender;
                $product->status = $request->status;
                $product->description = $request->description;
             
      if($request->hasfile('images'))
        {
            @unlink(public_path('public/uploads/images/'.$product->images));
            $file = $request->file('images');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'),$filename); 
            $product->images = $filename;  
        }
             $product->save();
       return back()->with('flash_success', ' Updated successfully');

   }
    public function destroy($id)
    {
        $data =User::findOrFail($id);
        $data->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
    }








public function CourseList(Request $request,$id){
    
    $course=Course::where('teacher_id',$id)->get();
                    return view('admin.teachers.courselist',compact('course'));
    
}



public function studentlist(Request $request,$id){
    
 $course=Course_student::where('course_id',$id)->get();           
 return view('admin.teachers.studentlist',compact('course'));
    
}

public function batchlist(Request $request,$id){
    
   $batch=Batch::where('id',$id)->first();
                  $batches=classs::where('batch_id',$batch->id)->get();
                    return view('admin.teachers.batchlist',compact('batch','batches'));
    
}



public function storelist(Request $request){
   // return 'a';
    $request->class_id;

 $batch=Batch::where('id',$request->batch_id)->first();
 $check=Teacher_class_attended::where('class_id',$request->class_id)->where('batch_id',$request->batch_id)
 ->where('user_id',$batch->teacher_id)->where('course_id',$batch->course_id)->first();
 if(!$check){
    $flight = new Teacher_class_attended;

        $flight->class_id= $request->class_id;
        
        $flight->batch_id= $request->batch_id;
        $flight->course_id= $batch->course_id;
        $flight->user_id= $batch->teacher_id;
        $flight->status= $request->atteneded;
        $flight->date= $request->date;
        
        $flight->save();
}
 return back()->with('flash_success', ' Deleted  Successfully!');
 
    
}


}
