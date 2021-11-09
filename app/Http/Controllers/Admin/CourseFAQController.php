<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course_FAQ;
use App\Course;

class CourseFAQController extends Controller
{
  
   public function index(Request $request)
    {
    	$data = Course_FAQ::paginate(100);
    	return view('admin.coursefaq.index',compact('data'));
    }
    
    public function store(Request $request)
    {
     $faq =  Course_FAQ::create([
                    'course_id'=>$_REQUEST['course_id'],
                    'question' => $_REQUEST['qustion'],
                    'answer' => $_REQUEST['answer'],
               ]);
         return back()->with('flash_success', 'Faq added successfully');

    }
    public function create()
    {
                  $course = Course::where('published',1)->orderby('id','DESC')->get();

        return view('admin.coursefaq.create',compact('course'));
    }

    
 public function destroy($id)
    {
        Course_FAQ::find($id)->delete();
        return back()->with('flash_success', 'faq deleted successfully');
    }
    
    
    public function edit($id)
    {
        //
         $data = Course_FAQ::find($id);
        return view('admin.coursefaq.edit',compact('data'));
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
      
         $faq = Course_FAQ::where('id',$id)
            ->update([
                'question'=>$request->input('qustion'),
                'answer'=>$request->input('answer')
                 
                ]);
        return back()->with('flash_success', 'Faq Updated successfully');
        
      
    }

  
  
}
