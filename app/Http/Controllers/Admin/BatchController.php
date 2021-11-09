<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Batch;
use App\AssignBatch;
use App\classs;

class BatchController extends Controller
{
     public function index()
    {
        //return request('type');
        if(request('type'))
        {
            $data = Batch::orderBy('id', 'DESC')->where('course_id',request('type'))->get();
        }
        else{
      $data = Batch::orderBy('id', 'DESC')->get();
        }
        return view('admin.batch.index',compact('data'));
    }
    
   
    
      public function create()
    {
          
        return view('admin.batch.create');
    }
    
    
    
    public function store(Request $request)
    {
    
        $this->validate($request,[
            'batch_name'=>'required',
            'batch_date'=>'required',
            'batch_timings'=>'required',
            'batch_days'=>'required',
            'course_id'=>'required|integer',
            'teacher_id'=>'required|integer',
            ]);
      
                 $product = new Batch;
              
                $product->batch_name = $request->batch_name;
                
                $product->batch_days = $request->batch_days;
                $product->batch_date = $request->batch_date;
                $product->batch_timings = $request->batch_timings;
                $product->course_id = $request->course_id;
                $product->teacher_id = $request->teacher_id;
                $product->save();

            
                return back()->with('flash_success', ' Created successfully');
    }
    
    
    public function edit(Request $request,$id)
   {
       $data= Batch::where('id',$id)->first();
   
       return view('admin.batch.edit',compact('data'));
   }
   public function update(Request $request, $id)
   {
         $product = Batch::find($id);
          $product->batch_name = $request->batch_name;
            $product->batch_days = $request->batch_days;
                $product->batch_date = $request->batch_date;
                $product->batch_timings = $request->batch_timings;
                $product->course_id = $request->course_id;
                $product->teacher_id = $request->teacher_id;
                $product->save();
   return back()->with('flash_success', ' Updated successfully');
     
   }
    
    
    public function destroy($id)
    {
        $data =Batch::findOrFail($id);
        $live = classs::where('batch_id',$data->id)->get();
        foreach($live as $live){
        $live->delete();
        }
        $assign = AssignBatch::where('batch_id',$data->id)->get();
        foreach($assign as $assign){
            $assign->delete();
        }
        $data->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
    }
    
}
