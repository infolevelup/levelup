<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Course;
use App\course_user;
use App\Media;
use File;
use App\Helpers\Helper;

class CoursesController extends Controller
{
    //
    public function index()
    {

     
          $users = Course::orderby('id','DESC')->get();
      
        return view('admin.courses.index', compact('users'));
    }
    public function create()
    {
             $teachers = User::where('role_id',2)->where('status','Active')->orderby('id','DESc')->get();
             $category = Category::where('status',1)->orderby('id','DESC')->get();
        return view('admin.courses.create',compact('teachers','category'));
    }

    public function store(Request $request)
    {
       // echo "<pre>";print_r($_REQUEST);exit();

         $request->all();
        if (Course::where('title', '=', $request->title)->where('type',$request->typee)->count() > 0)
        {
           return back()->with('flash_error', 'Course Already exists');
        }
        else
        {
           // return 'a';
            $course = Course::create($request->all());
        // return $course;    
             
             if (($request->slug == "") || $request->slug == null) {
                 $course->slug = Helper::getBlogUrl($request->title);
          
            $course->save();
        }else{
            $course->slug = Helper::getBlogUrl($request->slug);
          
            $course->save(); 
        }
        if ((int)$request->price == 0) {
            $course->price = NULL;
            $course->save();
        }else{
            $course->price=$request->price;
                        $course->color=$request->color;
                                    $course->type=$request->typee;


               if($request->featured==''){
       
            $course->featured=0;
            }else{
             $course->featured=$request->featured;

            }
            if($request->trending==''){
       
            $course->trending=0;
            }else{
             $course->trending=$request->trending;

            }
            if($request->popular==''){
       
            $course->popular=0;
            }else{
             $course->popular=$request->popular;

            }
            if($request->published==''){
       
            $course->published=0;
            }else{
             $course->published=$request->published;

            }
            if($request->corporate==''){
       
            $course->corporate=0;
            }  else{
             $course->corporate=$request->corporate;

            }   
            
         
            $course->strike_price=$request->strike_price;
            
            $course->benefits=$request->benefits;
            $course->schedule=$request->schedule;
            $course->save();
        }
      
        if($request->hasfile('course_image'))
            {
                $file = $request->file('course_image');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/course_images'),$filename); 
                 $course->course_image = $filename;  
            }
            
              if($request->hasfile('certificate'))
            {
                $file1 = $request->file('certificate');
                $filename1 = uniqid() . '.' . $file1->getClientOriginalExtension($file1);
                $file1->move(public_path('uploads/course_images'),$filename1); 
                 $course->certificate = $filename1;  
            }
              
              
              $course->save();
//---------------------------------------

               

//------------------------------

                $product = new course_user;
                $product->course_id =$course->id;
                 $product->user_id =$request->teacher_id;
                 $product->save(); 

if($request->type=='red'){
    $type='youtube';
    $video_url=$request->url1;
}elseif($request->type='green'){
    $type='embed';
 $video_url=$request->url2;
}else{
    $type='upload';
     $video_url=$request->url3;
}
                 $media=new Media;
                 $media->url = $video_url;
                 $media->type=$type;
                 $media->course_id= $course->id;
                 $media->save();
                return back()->with('flash_success', ' Created successfully');
            }
        
    }


public function edit(Request $request,$id)
   {
      
     $coursedetails = Course::where('id',$id)->first();
      $category= Category::where('id',$coursedetails->category_id)->first();
     $media = Media::where('course_id',$coursedetails->id)->first();
    // return $media;
     $course_user = course_user::where('course_id',$coursedetails->id)->first();
    
     $teachers = User::where('role_id',2)->orderby('id','DESc')->get();
             $categoryy = Category::orderby('id','DESC')->get();
                      //   return Media::where('course_id',32)->where('type','=','youtube')->orwhere('type','embed')->first();

       return view('admin.courses.edit',compact('course_user','media','category','coursedetails','teachers','categoryy'));
   }
 public function update(Request $request, $id)
   {
       
       
     //dd($_REQUEST);
        $course = Course::findOrFail($id);
      
        $course->update($request->all());
        if (($request->slug == "") || $request->slug == null) {
           $course->slug = Helper::getBlogUrl($request->title);
          
            $course->save();
        }else{
            $course->slug = Helper::getBlogUrl($request->slug);
          
            $course->save(); 
        }
        if ((int)$request->price == 0) {
            $course->price = NULL;
            $course->save();
        }else{
            $course->price=$request->price;
                                    $course->color=$request->color;
                                    $course->type=$request->typee;

            if($request->featured==''){
       
            $course->featured=0;
            }else{
             $course->featured=$request->featured;

            }
            if($request->trending==''){
       
            $course->trending=0;
            }else{
             $course->trending=$request->trending;

            }
            if($request->popular==''){
       
            $course->popular=0;
            }else{
             $course->popular=$request->popular;

            }
            if($request->published==''){
       
            $course->published=0;
            }else{
             $course->published=$request->published;

            }
            if($request->corporate==''){
       
            $course->corporate=0;
            }  else{
             $course->corporate=$request->corporate;

            }   
            
            
            $course->strike_price=$request->strike_price;
              $course->benefits=$request->benefits;
            $course->schedule=$request->schedule;
            $course->save();
        }
if($request->hasfile('course_image'))
        {
            @unlink(public_path('uploads/course_images'.$course->course_image));
            $file = $request->file('course_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/course_images'),$filename); 
            $course->course_image = $filename;  
        }
        if($request->hasfile('certificate'))
        {
            @unlink(public_path('uploads/course_images'.$course->certificate));
            $file1 = $request->file('certificate');
            $filename1 = uniqid() . '.' . $file1->getClientOriginalExtension($file1);
            $file1->move(public_path('uploads/course_images'),$filename1); 
            $course->certificate = $filename1;  
        }
               /*   if($request->hasfile('course_image'))
        {
          
            
            $file = $request->file('course_image');
            $filename = time() . '.' . $file->getClientOriginalExtension($file);
                    //   return $filename;

            $filePath = 'uploads/course_images' . $filename;
            $file->move(public_path('uploads/course_images'),$filePath); 
           $course->course_image= $filename;  
        }*/
        
             $course->save();
      
$product= Course_user::where('course_id', '=', $course->id)->first();
if ($product == null) {
                        $product = new Course_user();
                    }
       //return $product;
                $product->course_id =$course->id;
                 $product->user_id =$request->teacher_id;
                 $product->save(); 

if($request->type=='red'){
    $type='youtube';
    $video_url=$request->url1;
}elseif($request->type='green'){
    $type='embed';
 $video_url=$request->url2;
}else{
    $type='upload';
     $video_url=$request->url3;
}
                 $media = Media::
                    where('course_id', '=', $course->id)
                        ->first();

                    if ($media == null) {
                        $media = new Media();
                    }
                 $media->url = $video_url;
                 $media->type=$type;
                 $media->course_id= $course->id;
                 $media->save();
             
       return back()->with('flash_success', ' Updated successfully');

   }
  

public function destroy($id)
    {
        $data =Course::findOrFail($id);
       
        $data->delete();

        return back()->with('flash_success', ' Deleted  Successfully!');
    }
}
