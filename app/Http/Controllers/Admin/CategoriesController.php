<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Helpers\Helper;
use DB;
use App\Course;


class CategoriesController extends Controller
{
    //
     public function index()
    {
     $users = Category::orderBy('id', 'DESC')->get();
        return view('admin.categories.index', compact('users'));
    }
     public function create()
    {
        return view('admin.categories.create');
    }

   public function store(Request $request)
    {
        //echo "<pre>";print_r($_REQUEST);exit();
         $slug = Helper::getBlogUrl($request->name);
        // return $slug;
            if (Category::where('slug', '=', $slug)->count() > 0)
            {
                return back()->with('flash_error', 'Category Already Exits');
            }
        else
        {
                $product = new Category;
              
                $product->name = $request->name;
               $product->status = $request->status;
                //$product->icon = $request->icon;
                 if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension($file);
            $filePath = 'uploads/images/' . $filename;
            $file->move(public_path('uploads/images'),$filePath); 
           $product->icon = $filename;  
        }
                
                $product->slug = $slug;
            if($request->popular=='on'){
                    $product->popular ='1'; 

            }else{
                                    $product->popular ='0'; 

            }
                $product->save();

            
                return back()->with('flash_success', ' Created successfully');
            }
        
    }
public function edit(Request $request,$id)
   {
       $data= Category::where('id',$id)->first();
   
       return view('admin.categories.edit',compact('data'));
   }
   public function update(Request $request, $id)
   {
       
       
     //dd($_REQUEST);
        $slug = Helper::getBlogUrl($request->name);
       $product = Category::find($id);
   
           $product->status = $request->status;
                $product->name = $request->name;
                 if($request->hasfile('image'))
        {
          
            
            $file = $request->file('image');
           // return $file;
            $filename = time() . '.' . $file->getClientOriginalExtension($file);
            $filePath = 'uploads/images/' . $filename;
            $file->move(public_path('uploads/images'),$filePath); 
            $product->icon = $filename;  
        }
               //$product->icon = $request->icon;
                $product->slug = $slug;
                 if($request->popular=='on'){
                    $product->popular ='1'; 

            }else{
                                    $product->popular ='0'; 

            }
           
                   $product->save();
       return back()->with('flash_success', ' Updated successfully');

   }
    public function destroy($id)
    {
        $data =Category::findOrFail($id);
        
        $data->delete();
      
     /* $course_data=Course::where('category_id',$id)->get();
      foreach($course_data as $course_data){
          $course=DB::table('courses')->where('category_id',$course_data->id)->delete();
          
      }
      return 'a';  
        
        $data=DB::table('lessons')->where('category_id',$course->course_id)->delete();*/
        
        return back()->with('flash_success', ' Deleted  Successfully!');
    }

}
