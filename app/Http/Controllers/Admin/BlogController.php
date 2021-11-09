<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use App\Helpers\Helper;

class BlogController extends Controller
{
      public function index()
    {
        
        $data = Blog::orderBy('id','DESC')->get();
        return view('admin.blog.index',compact('data'));
    }
    
    
      public function create()
    {
        return view('admin.blog.create');
    }
    
    
    
    public function store(Request $request)
    {
        
         $slug = Helper::getBlogUrl($request->title);

        $banner = new Blog;
        $banner->title = $request->title;
        $banner->description = $request->description;
        $banner->date = $request->date;
        $banner->slug = $slug;
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension($file);
            $filePath = 'uploads/images/' . $filename;
            $file->move(public_path('uploads/images'),$filePath); 
            $banner->image = $filename;  
        }
        $banner->save();
        return back()->with('flash_success', ' Created successfully');
    }




public function edit($id)
    {
        //
         $data = Blog::find($id);
        return view('admin.blog.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        

//return $request->all();
  $slug = Helper::getBlogUrl($request->title);
       
        $data = Blog::find($id);
        $data->title = $request->title;
            $data->date = $request->date;
            $data->slug = $slug;
            $data->description= $request->description;
        if($request->hasfile('image'))
        {
            @unlink(public_path('public/uploads/images/'.$data->image));
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'),$filename); 
            $data->image= $filename;  
        }
      
        $data->save();
        return back()->with('flash_success', 'Updated successfully');
        
      
    }


 public function destroy($id)
    {
        //
          $data = Blog::find($id);
        @unlink(public_path('public/uploads/images/'.$data->image));
        $data->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
    }

}



