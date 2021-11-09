<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course_starting_soon;

class CourseStartingSoonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        $data = Course_starting_soon::orderBy('id','DESC')->get();
        return view('admin.courses_starting_soon.index',compact('data'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
                return view('admin.courses_starting_soon.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banner = new Course_starting_soon;
        $banner->title = $request->title;
        $banner->link= $request->link;
        $banner->expiry_date = $request->date;
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
             $data = Course_starting_soon::where('id',$id)->first();

             return view('admin.courses_starting_soon.edit',compact('data'));

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
       // return 'a';
             $banner = Course_starting_soon::find($id);

            $banner->title = $request->title;
        $banner->link= $request->link;
        $banner->expiry_date = $request->date;
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension($file);
            $filePath = 'uploads/images/' . $filename;
            $file->move(public_path('uploads/images'),$filePath); 
            $banner->image = $filename;  
        }
        $banner->save();
                     return back()->with('flash_success', ' Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $data =Course_starting_soon::findOrFail($id);
       
        $data->delete();

        return back()->with('flash_success', ' Deleted  Successfully!');
        
    }
}
