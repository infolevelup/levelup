<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Aboutus;

class AboutusController extends Controller
{
    
    public function edit(Request $request,$id)
   {
       //return 'a';
       $data= Aboutus::where('id',$id)->first();
   
       return view('admin.aboutus.edit',compact('data'));
   }
   
     public function update(Request $request, $id)
   {
       //dd($_REQUEST);
        
        
        
       $product = Aboutus::find($id);
        $product->certificates= $request->certificates;
                $product->degree = $request->degree;
                $product->instructor = $request->instructor;
                $product->teaching_experience = $request->teaching_experience;
                 $product->about = $request->about;
               $product->stories_content = $request->stories_content;
               $product->vision_content = $request->vision_content;
               $product->mission_content= $request->Mision_content;
               $product->accrediations = $request->accrediations;
               $product->video = $request->video;
               
               
                if($request->hasfile('stories_image'))
        {
            //return 'a';
            @unlink(public_path('public/uploads/images'.$product->stories_image));
            $file= $request->file('stories_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'),$filename); 
            $product->stories_image = $filename;  
        }  
        
              if($request->hasfile('vision_image'))
        {
            @unlink(public_path('uploads/images'.$product->vision_image));
            $file1 = $request->file('vision_image');
            $filename1 = uniqid() . '.' . $file1->getClientOriginalExtension($file1);
            $file1->move(public_path('uploads/images'),$filename1); 
            $product->vision_image = $filename1;  
        }
           if($request->hasfile('mision_image'))
        {
            @unlink(public_path('uploads/images'.$product->mission_image));
            $file2= $request->file('mision_image');
            $filename2 = uniqid() . '.' . $file2->getClientOriginalExtension($file2);
            $file2->move(public_path('uploads/images'),$filename2); 
            $product->mission_image = $filename2;  
        }
             $product->save();
       return back()->with('flash_success', ' Updated successfully');
   }

  
}
