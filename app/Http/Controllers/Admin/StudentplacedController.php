<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Studentplaced;
use App\Studentplaced_images;
use App\Helpers\Helper;
use DB;
class StudentplacedController extends Controller
{
    //
    
       public function index()
    {
        //
        $data = Studentplaced::orderBy('id','DESC')->paginate(10);

        return view('admin.studentplaced.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $data = Studentplaced::all();

        return view('admin.studentplaced.create',compact('data'));
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
            'heading' => 'required',
        ]);

    
     //  return $request->all();   
            $data = new Studentplaced;
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

                $product_images= new Studentplaced_images();
                $product_images->studentplaced_id = $data->id;
                $product_images->imagess= $name;
               
                $product_images->save();  
            }
        } 

         
            return back()->with('flash_success', 'Studentplaced Created successfully');
        
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
         $data = Studentplaced::find($id);
        return view('admin.studentplaced.edit',compact('data'));
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
      
        $data = Studentplaced::find($id);
                 
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

                $product_images= new Studentplaced_images();
                $product_images->studentplaced_id = $data->id;
                $product_images->imagess= $name;
               
                $product_images->save();  
            }
        } 
    return back()->with('flash_success', 'Studentplaced Updated successfully');
        
      
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
          DB::table('studentplaced_images')->where('studentplaced_id', $id)->delete();
          $data = Studentplaced::find($id);
        @unlink(public_path('public/uploads/images/'.$data->image));
        $data->delete();
       
        return back()->with('flash_success', ' Deleted  Successfully!');
    }
    
      public function deleteMultipleImages(Request $request)
    {
       // return 'aa';
        $id = $_REQUEST['id'];
        $data = Studentplaced_images::find($id);
        $delete = @unlink(public_path('public/uploads/images/'.$data->image));
        if ($delete = true) {
            if ($data->delete()) {
                return back()->with('flash_success', 'Image Deleted Successfully!');
            }
        }
    }
    
}
