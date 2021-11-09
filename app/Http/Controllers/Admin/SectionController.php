<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use App\Section_images;
use App\Helpers\Helper;
use DB;
class SectionController extends Controller
{
    //
    
       public function index()
    {
        //
        $data = Section::orderBy('id','DESC')->paginate(10);

        return view('admin.sect.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $data = Section::all();

        return view('admin.sect.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        

    
      // return $request->all();   
            $data = new Section;
            $data->heading = $request->heading;
            $data->short_desc = $request->short_desc;
        
           $data->save();
        
         $data1 = $request->all();
                $quantity = $data1['name'];
         $img=$data1['images'];
    //return 'hv';
                if($request->hasfile('images'))
        {
            foreach($request->file('images') as $image)
            {
                $name=time().uniqid(). '.' . $image->getClientOriginalName();
                $image->move(public_path().'/uploads/images/', $name);  
                $dd[] = $name;
                $nn[]=$quantity;
                $product_images= new Section_images();
                $product_images->section_id = $data->id;
                $product_images->images= $name;
               $product_images->name=$quantity;
                $product_images->save();  
            }
        } 
        
            return back()->with('flash_success', 'Section Created successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
         $data = Section::find($id);
        return view('admin.sect.edit',compact('data'));
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
      
        $data = Section::find($id);
                 
            $data->heading = $request->heading;
            $data->short_desc = $request->short_desc;
        
         
          
            if($request->hasfile('images'))
            {
                $file = $request->file('images');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'),$filename); 
                $data->images = $filename;  
            }
           
            $data->save();
            if($request->hasfile('imagess'))
        {
            foreach($request->file('imagess') as $image)
            {
                $name=time().uniqid(). '.' . $image->getClientOriginalName();
                $image->move(public_path().'/uploads/images/', $name);  
                $dd[] = $name;

                $product_images= new Section_images();
                $product_images->Section_id = $data->id;
                $product_images->imagess= $name;
               
                $product_images->save();  
            }
        } 
    return back()->with('flash_success', 'Section Updated successfully');
        
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
          DB::table('Section_images')->where('Section_id', $id)->delete();
          $data = Section::find($id);
        @unlink(public_path('public/uploads/images/'.$data->image));
        $data->delete();
       
        return back()->with('flash_success', ' Deleted  Successfully!');
    }
    
      public function deleteMultipleImages(Request $request)
    {
       // return 'aa';
        $id = $_REQUEST['id'];
        $data = Section_images::find($id);
        $delete = @unlink(public_path('public/uploads/images/'.$data->image));
        if ($delete = true) {
            if ($data->delete()) {
                return back()->with('flash_success', 'Image Deleted Successfully!');
            }
        }
    }
    
}
