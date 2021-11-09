<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Patner;

class PatnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Patner::orderBy('id','DESC')->paginate(10);
        return view('admin.patners.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.patners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            
            'image' => 'required',
            
        ]);

        $banner = new Patner;
     
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
        $data = Patner::find($id);
        return view('admin.patners.edit',compact('data'));
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
        

        $banner = Patner::find($id);
     // return $banner;
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
        $banner = Patner::find($id);
        unlink('public/uploads/images/'.$banner->image);
        $banner->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
    }
}
