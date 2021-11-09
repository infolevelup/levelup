<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course_student;
use DB;
class PurchasedCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(request('type'))
        {
            $data = Course_student::orderBy('id', 'DESC')->where('course_id',request('type'))->get();
        }
        else{
           $data = Course_student::orderBy('id', 'DESC')->get();

      
        }
        return view('admin.purchased_course.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course=Course_student::where('user_id',$id)->get();
        return view('admin.purchased_course.show',compact('course'));

    }
    
      

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $course=DB::table('student_class_attended as sc')->join('batches as b','b.id','sc.batch_id')->join('courses as c','c.id','sc.course_id')
         ->join('classses as class','class.id','sc.class_id')->join('users as u','u.id','sc.user_id')->where('sc.user_id',$id)->select('sc.*','b.batch_name','c.title','class.date','u.name')->get();
        return view('admin.purchased_course.display',compact('course'));

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
    }
}
