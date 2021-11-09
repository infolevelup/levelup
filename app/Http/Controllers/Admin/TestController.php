<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Test;
use App\Course;
use App\Lesson;
use App\Helpers\Helper;
use DB;

class TestController extends Controller
{
    //
    
       public function index()
    {
        //
        $data = Test::orderBy('id','DESC')->paginate(10);

        return view('admin.test.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $data = Test::all();
            $course =Course::all();
            $lesson=Lesson::all();
        return view('admin.test.create',compact('data','course','lesson'));
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
            $this->validate($request,[
            'course_id' => 'required',
            'title' => 'required',
            'description' => 'required'
        ]);
//return $request->published;
            
            $data = new Test;
            $data->title = $request->title;
            $data->description = $request->description;
            if($request->published==''||$request->published==NULL){
                $published=0;
            }else{
                $published=1;
            }      
            $data->published=$published;
            if($request->course_id=='Please select'){
                        return back()->with('flash_error', 'please select one course');
    
            }else{
                $course_id=$request->course_id;
                
            }
            $data->course_id=$course_id;
              $data->lesson_id=$request->lesson_id;
              $data->slug = Helper::getBlogUrl($request->title);
          
            $data->save();
            return back()->with('flash_success', 'Test Created successfully');
        
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
         $data = Test::find($id);
         $course=Course::all();
                     $lesson=Lesson::all();

        return view('admin.test.edit',compact('data','course','lesson'));
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
      
       
            $data = Test::find($id);
            $data->title = $request->title;
            $data->description = $request->description;
            if($request->published==''||$request->published==NULL){
                $published=0;
            }else{
                $published=1;
            }      
            $data->published=$published;
            if($request->course_id=='Please select'){
                        return back()->with('flash_error', 'please select one course');
    
            }else{
                $course_id=$request->course_id;
            }
            $data->course_id=$course_id;
              $data->lesson_id=$request->lesson_id;
              $data->slug = Helper::getBlogUrl($request->title);
          
            $data->save();
        return back()->with('flash_success', 'Test Updated successfully');
        
      
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
        //  $data = Test::find($id);
    //    @unlink(public_path('public/uploads/images/'.$data->image));
     //   $data->delete();
        
        
         $data =DB::table('tests')
                    ->leftJoin('questions','tests.id', '=','questions.test_id')
                    ->where('tests.id', $id); 
               
               
               
                $data1=DB::table('questions')->where('test_id', $id)->delete();  
               // DB::table('question_options')->where('question_id', $data1->id)->delete();                           

        $data->delete();
        
        
         
        
        
        return back()->with('flash_success', ' Deleted  Successfully!');
    }
    
    
}
