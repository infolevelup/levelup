<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Future;
class FutureController extends Controller
{
     public function index()
    {
        
        $data = Future::orderBy('id','DESC')->get();
        return view('admin.future.index',compact('data'));
    }
    
    
      public function create()
    {
        return view('admin.future.create');
    }
    
    
    
    public function store(Request $request)
    {
        
        $banner = new Future;
        $banner->title = $request->title;
        $banner->description = $request->description;
        $banner->save();
        return back()->with('flash_success', ' Created successfully');
    }




public function edit($id)
    {
        //
         $data = Future::find($id);
        return view('admin.future.edit',compact('data'));
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
        
        $data = Future::find($id);
        $data->title = $request->title;
            $data->description= $request->description;
        $data->save();
        return back()->with('flash_success', 'Updated successfully');
        
      
    }


 public function destroy($id)
    {
        //
          $data = Future::find($id);
        $data->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
    }

}
