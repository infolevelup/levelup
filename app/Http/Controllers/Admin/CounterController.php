<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Counter;
use App\Helpers\Helper;
class CounterController extends Controller
{
    //
    
       public function index()
    {
        //
        $data = Counter::orderBy('id','DESC')->paginate(10);

        return view('admin.counter.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $data = Counter::all();

        return view('admin.counter.create',compact('data'));
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
            'name' => 'required',
        ]);

    
            $data = new Counter;
            $data->name = $request->name;
            $data->countt = $request->countt;
        
         
          
            if($request->hasfile('images'))
            {
                $file = $request->file('images');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'),$filename); 
                $data->images = $filename;  
            }
           

            $data->save();
            return back()->with('flash_success', 'Counter Created successfully');
        
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
         $data = Counter::find($id);
        return view('admin.counter.edit',compact('data'));
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
      
        $data = Counter::find($id);
        $data->name = $request->name;
            $data->countt = $request->countt;
        
         
        if($request->hasfile('images'))
        {
            @unlink(public_path('public/uploads/images/'.$data->images));
            $file = $request->file('images');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
            $file->move(public_path('uploads/images'),$filename); 
            $data->images= $filename;  
        }
      
        $data->save();
        return back()->with('flash_success', 'Counter Updated successfully');
        
      
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
          $data = Counter::find($id);
        @unlink(public_path('public/uploads/images/'.$data->image));
        $data->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
    }
    
    
}
