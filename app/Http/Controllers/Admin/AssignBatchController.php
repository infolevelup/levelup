<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Batch;
use App\Course;
use App\Course_student;
use App\User;
use App\AssignBatch;


class AssignBatchController extends Controller
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
        return view('admin.assignbatch.index',compact('data'));
    }
    
   public function show($id){
       
       
             $data=AssignBatch::where('batch_id',$id)->get();
             return view('admin.assignbatch.show',compact('data'));

   }
    
      public function create(Request $request)
    {
          $firstcategory = Course::where('published',1)->where('type','live class')->first();
        $subcategory_id = Batch::all();
        
        $categories = Course::where('published',1)->where('type','live class')->get();
        if (isset($request->course_id) && $request->course_id !='') {
           $subcategories = Batch::where('course_id',$request->course_id)->get();
           $studid=Course_student::where('course_id',$request->course_id)->get();
        }
        else{
            
         $subcategories = Batch::where('course_id',@$firstcategory->id)->get();
         $studid=Course_student::where('course_id',@$firstcategory->id)->get();
         
        }
        
        return view('admin.assignbatch.create',compact('categories','subcategories','subcategory_id','firstcategory','studid'));
    }
    
    
    
    public function store(Request $request)
    {
    
    /*    $this->validate($request,[
            'batch_name'=>'required',
            'batch_date'=>'required',
            'batch_timings'=>'required',
            'batch_days'=>'required',
            'course_id'=>'required|integer',
            'teacher_id'=>'required|integer',
            ]);
      */
                 
                 $data = $request->all();
            $user_id = $data['user_id'];
            if (count($user_id)) {
                foreach($user_id as $key => $input) {
                    if ($user_id[$key]!=null) {
                        $product_price = new AssignBatch;
                        $product_price->user_id = $user_id[$key];        
                        $product_price->course_id = $request->course_id;
                         if($request->batch_id==""){
                             
                            return back()->with('flash_error', ' Please select the batch');
                         }else{
                        $product_price->batch_id = $request->batch_id;
                         }
                        $product_price->save();
                    }
                }
            }
                 
                 
            
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
       // return $id;
         $data =AssignBatch::findOrFail($id);
        $data->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
    }
   
    
    
}
