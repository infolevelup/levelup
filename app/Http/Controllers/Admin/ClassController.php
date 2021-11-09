<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\classs;
use App\Batch;
use App\AssignBatch;
use App\User;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
      $data = classs::orderBy('id', 'DESC')->get();
        
        

        return view('admin.class.index',compact('data'));   
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
              $batch = Batch::orderBy('id', 'DESC')->get();

                return view('admin.class.create',compact('batch'));

        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'batch_id'=>'required',
            'date'=>'required',
            'time'=>'required',
            'zoom_link'=>'required',
                ]);
      
                 $product = new classs;
              
                $product->batch_id = $request->batch_id;
                
                $product->date = $request->date;
                $product->time = $request->time;
                $product->zoom_link = $request->zoom_link;
                $product->save();
                
              $batch=AssignBatch::where('id',$request->batch_id)->get();
             foreach($batch as $batch){
               $batchuser=User::where('id',$batch->user_id)->first();
               
            $batchname=Batch::where('id',$batch->batch_id)->first();
            
                     $users = \App\User::find($batchuser->id);

           $details = [
            'greeting' => 'Hi'.$batchuser->name,
            'body' => 'Your New Class has been scheduled for '.$batchname->batch_name.'Please login to see the time schedules 
            Date-'.$request->date.'Time'.$request->time
            ,
            'thanks' => 'Thank you for visiting ',
    ];

    $users->notify(new \App\Notifications\UserClassCreationNotification($details));
        
                }//notification    
            
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data= classs::where('id',$id)->first();
   
       return view('admin.class.edit',compact('data'));

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
                $product = classs::find($id);
            
                $product->batch_id = $request->batch_id;
                
                $product->date = $request->date;
                $product->time = $request->time;
                $product->zoom_link = $request->zoom_link;
                $product->save();
        
        
          
              $batch=AssignBatch::where('id',$request->batch_id)->get();
             foreach($batch as $batch){
               $batchuser=User::where('id',$batch->user_id)->first();
               
            $batchname=Batch::where('id',$batch->batch_id)->first();
            
                     $users = \App\User::find($batchuser->id);

           $details = [
            'greeting' => 'Hi'.$batchuser->name,
            'body' => 'Your  Class has been updated please have a look for new changes'.$batchname->batch_name.'Please login to see the time schedules 
            Date-'.$request->date.'Time'.$request->time
            ,
            'thanks' => 'Thank you for visiting ',
    ];

    $users->notify(new \App\Notifications\UserClassCreationNotification($details));
        
                }
        
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
        
        $data =classs::findOrFail($id);
        $data->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
    }
}
