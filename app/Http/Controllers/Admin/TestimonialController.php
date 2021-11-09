<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Testimonial;
use App\Helpers\Helper;
class TestimonialController extends Controller
{
    //
    
       public function index()
    {
        //
        $data = Testimonial::orderBy('id','DESC')->paginate(10);

        return view('admin.testimonial.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $data = Testimonial::all();

        return view('admin.testimonial.create',compact('data'));
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
     

    
            $data = new Testimonial;
            $data->name = $request->name;
            $data->short_desc = $request->short_desc;
        $data->video = $request->video;
            $data->long_desc= $request->long_desc;
          
            if($request->hasfile('images'))
            {
                $file = $request->file('images');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'),$filename); 
                $data->images = $filename;  
            }
           

            $data->save();
            return back()->with('flash_success', 'testimonial Created successfully');
        
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
         $data = Testimonial::find($id);
        return view('admin.testimonial.edit',compact('data'));
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
        
          $this->validate($request, [
            'name' => 'required',
        ]);

//return $request->all();
      
        $data = Testimonial::find($id);
        $data->name = $request->name;
            $data->short_desc = $request->short_desc;
           $data->video = $request->video;
            $data->long_desc= $request->long_desc;
        if($request->hasfile('images'))
        {
            @unlink(public_path('public/uploads/images/'.$data->images));
            $file = $request->file('images');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'),$filename); 
            $data->images= $filename;  
        }
      
        $data->save();
        return back()->with('flash_success', 'testimonial Updated successfully');
        
      
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
          $data = Testimonial::find($id);
        @unlink(public_path('public/uploads/images/'.$data->image));
        $data->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
    }
    
    
}
