<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use App\Course;


class ProjectsController extends Controller
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
            $data = Project::orderBy('id', 'DESC')->where('course_id',request('type'))->get();
        }
        else{
      $data = Project::orderBy('id', 'DESC')->get();
      
      
        }
        return view('admin.projects.index',compact('data'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 public function create(Request $request)
    {
          $course= Course::where('published',1)->get();
        
        
        return view('admin.projects.create',compact('course'));
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if($request->hasfile('filenames'))
         {
            foreach($request->file('filenames') as $file)
            {
                $name = time().'.'.$file->extension();
                $file->move(public_path().'/uploads/', $name);  
                $data[] = $name;  
            }
         }


         $file= new Project();
         $file->title=$request->title;
         $file->course_id=$request->course_id;
         $file->pdf=json_encode($data);
         $file->save();
         
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
        $data=Project::where('id',$id)->first();
        $course = Course::where('published',1)->get();
        return view('admin.projects.edit',compact('course','data'));
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
        
          $Lesson = Project::findOrFail($id);
             
               $Lesson->title=$request->title;
               $Lesson->course_id=$request->course_id;


               
                if($request->hasfile('filenames'))
         {
            foreach($request->file('filenames') as $file)
            {
                $name = time().'.'.$file->extension();
                $file->move(public_path().'/uploads/', $name);  
                $data[] = $name;  
                                     $Lesson->pdf=json_encode($data);

            }
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
         $data =Project::findOrFail($id);
        $data->delete();
        return back()->with('flash_success', ' Deleted  Successfully!');
    }
   
}
