<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Assignment;
use App\Lesson;
use App\Course;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
      public function index()
    {
        //return request('type');
        if(request('type'))
        {
            $data = Assignment::orderBy('id', 'DESC')->where('course_id',request('type'))->get();
        }
        else{
      $data = Assignment::orderBy('id', 'DESC')->get();
      
      
        }
        return view('admin.assignment.index',compact('data'));

          }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create(Request $request)
    {
        $lesson = Lesson::all();
        
        $course = Course::where('published',1)->get();
        
        
        return view('admin.assignment.create',compact('course','lesson'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                        $product_price = new Assignment;
                        $product_price->lesson_id = $request->lesson;        
                        $product_price->course_id = $request->course_id;
                         
                       
                         if($request->hasfile('file')){
        $file=$request->file('file');
        $extension=$file->getClientOriginalExtension();
        $filename2=mt_rand(15, 50) . time().'.'.$extension;
        $path2=$file->move(public_path().'/uploads/',$filename2);

        $product_price->pdf=$filename2;
        
                             
                         }
                        $product_price->title = $request->title;
                        
                        // $fileName = time().'.'.$request->file->extension();  
   
                          //$request->file->move(public_path('uploads'), $fileName);
                       // $product_price->pdf=$fileName;
                        $product_price->save();

                        
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
     $lesson = Lesson::all();
        $data=Assignment::where('id',$id)->first();
        $course = Course::where('published',1)->get();
        return view('admin.assignment.edit',compact('course','lesson','data'));

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
             $Lesson = Assignment::findOrFail($id);
             
               $Lesson->title=$request->title;
               $Lesson->course_id=$request->course_id;
               $Lesson->lesson_id=$request->lesson;


        
        
     if($request->hasfile('file')){
        $file=$request->file('file');
        $extension=$file->getClientOriginalExtension();
        $filename2=mt_rand(15, 50) . time().'.'.$extension;
        $path2=$file->move(public_path().'/uploads/',$filename2);

            $Lesson->pdf=$filename2;

               }
               
                $Lesson->save();

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
       // return $id;
         $data =Assignment::findOrFail($id);
        $data->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
    }
}
