<?php

namespace App\Http\Controllers\Admin;

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

class BundleController extends Controller
{
    //
    public function index()
    {

     
          $users = Bundle::orderby('id','DESC')->get();
         
        
        return view('admin.bundle.index', compact('users'));
    }
    public function create()
    {
           //  $teachers = User::where('role_id',2)->orderby('id','DESc')->get();
             $course=Course::all();
             $category = Category::orderby('id','DESC')->get();
        return view('admin.bundle.create',compact('course','category'));
    }

    public function store(Request $request)
    {
       // echo "<pre>";print_r($_REQUEST);exit();

       $data= $request->all();
        
        if (Bundle::where('title', '=', $request->title)->count() > 0)
        {
           return back()->with('flash_error', 'Bundle Already exists');
        }
        else
        { 
        $bundle = Bundle::create($request->all());
       
        
        if (($request->slug == "") || $request->slug == null) {
            $bundle->slug = Helper::getBlogUrl($request->title);
            $bundle->save();
        }else{
            $bundle->slug = Helper::getBlogUrl($request->slug);
            $bundle->save();
        }
        if((int)$request->price == 0){
            $bundle->price = NULL;
            $bundle->save();
        }

        $bundle->user_id = auth()->user()->id;
        if($request->hasfile('course_image'))
            {
                $file = $request->file('course_image');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/course_images'),$filename); 
                 $bundle->course_image = $filename;  
            }
              
        $bundle->save();
        
         $mrp_price = $data['course_id'];
          
           
            if (count($mrp_price)) {
                foreach($mrp_price as $key => $input) {
                    if ($mrp_price[$key]!=null) {
                        $product_price = new Bundle_course;
                        $product_price->course_id = $mrp_price[$key];
                      
                        $product_price->bundle_id=$bundle->id;
                       
                        $product_price->save();
                    }
                }
               return back()->with('flash_success', ' Created successfully');
            }
            else{
                return back()->with('flash_error', 'course Can not be null');
            }
        
        }          
               
                
            
        
    }


public function edit(Request $request,$id)
   {
       $bundle=Bundle::where('id',$id)->first();
       //return $bundle;
      $course=Course::all();
             $category = Category::orderby('id','DESC')->get();
           
          // $a= Bundle_course::where('bundle_id',5)->where('course_id',24)->get();
             
          
           //  return $a;
       return view('admin.bundle.edit',compact('course','category','bundle'));
   }
 public function update(Request $request, $id)
   {
       
              $data= $request->all();

    // dd($_REQUEST);
        $bundle = Bundle::findOrFail($id);
      
    
    if (($request->slug == "") || $request->slug == null) {
            $bundle->slug = Helper::getBlogUrl($request->title);
            $bundle->save();
        }else{
            $bundle->slug = Helper::getBlogUrl($request->slug);
            $bundle->title=$request->title;
            $bundle->price=$request->price;
                        $bundle->description=$request->description;
                                    $bundle->start_date=$request->start_date;
            $bundle->free=$request->free;
            $bundle->meta_title=$request->meta_title;

            $bundle->meta_keywords=$request->meta_keywords;
            $bundle->meta_description=$request->meta_description;

            $bundle->save();
        }
        if((int)$request->price == 0){
            $bundle->price = NULL;
            $bundle->save();
        }

        $bundle->user_id = auth()->user()->id;
        if($request->hasfile('course_image'))
            {
                            @unlink(public_path('uploads/course_images'.$course->course_image));

                $file = $request->file('course_image');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/course_images'),$filename); 
                 $bundle->course_image = $filename;  
            }
              
        $bundle->save();
     
    // return 'v';   
         $mrp_price = $data['course_id'];
          
           
            if (count($mrp_price)) {
                foreach($mrp_price as $key => $input) {
                    if ($mrp_price[$key]!=null) {
                        $product_price = new Bundle_course;
                        $product_price->course_id = $mrp_price[$key];
                      
                        $product_price->bundle_id=$bundle->id;
                       
                        $product_price->save();
                    }
                }
               return back()->with('flash_success', ' updated successfully');
            }
            else{
                return back()->with('flash_error', 'course Can not be null');
            }
                 

   }
  

public function destroy($id)
    {
        $data =Bundle::findOrFail($id);
       
        $data->delete();

        return back()->with('flash_success', ' Deleted  Successfully!');
    }
}
