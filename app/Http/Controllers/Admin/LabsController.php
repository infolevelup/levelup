<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lab;

class LabsController extends Controller
{
        public function index()
    {
        //
        $data = Lab::orderBy('id','DESC')->paginate(10);

        return view('admin.labs.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $data = Lab::all();

        return view('admin.labs.create',compact('data'));
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
         $this->validate($request, [
            'title' => 'required',
        ]);

    
            $page = new Lab();
        $page->title = $request->title;
       
               if($request->type=='red'){
            $page->type = 'youtube';
           
         $page->video = $request->video1;
        }else{
            $page->type = 'embed';
           
         $page->video = $request->video2;
        }
       
      

            
       
        $page->save();


            return back()->with('flash_success', 'Labs Created successfully');
     
        
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
         $data = Lab::find($id);
        return view('admin.labs.edit',compact('data'));
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
        
      
       $page = Lab::find($id);
          $page->title = $request->title;
       
               if($request->type=='red'){
            $page->type = 'youtube';
           
         $page->video = $request->video1;
        }else{
            $page->type = 'embed';
           
         $page->video = $request->video2;
        }
       
      

            
       
        $page->save();
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
        //
          $data = Lab::find($id);
        @unlink(public_path('public/uploads/images/'.$data->image));
        $data->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
    }
    
  
}
