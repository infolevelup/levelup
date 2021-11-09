<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Question;
use App\Test;
use App\Question_option;
use App\Helpers\Helper;
use DB;
use App\Course;
use Auth;
class QuestionController extends Controller
{
    //
    
       public function index()
    {
        //
          $course =Course::where('teacher_id',Auth::user()->id)->get();
       
       // $data = Question::orderBy('id','DESC')->paginate(10);

        return view('user.questions.index',compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $data = Question::all();
            $test=Test::all();
           // return $test;
        return view('user.questions.create',compact('data','test'));
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
        
            $data = new Question;
            $data->question = $request->question;
            $data->user_id = auth()->user()->id;
            $data->score= $request->score;
            $data->test_id= $request->tests;
            if($request->hasfile('question_image'))
            {
                $file = $request->file('question_image');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'),$filename); 
                $data->question_image = $filename;  
            }
           

            $data->save();
              for ($q = 1; $q <= 4; $q++) {
            $option = $request->input('option_text_' . $q, '');
            $explanation = $request->input('explanation_' . $q, '');
            if ($option != '') {
                Question_option::create([
                    'question_id' => $data->id,
                    'option_text' => $option,
                    'explanation' => $explanation,
                    'correct' => $request->input('correct_' . $q)
                ]);
            }
        }
      
            
            return back()->with('flash_success', 'Question Created successfully');
        
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
         $data = Question::find($id);
         $test=Test::all();
        return view('user.questions.edit',compact('data','test'));
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
      
        $data = Question::find($id);
       
       $data->question = $request->question;
            $data->user_id = auth()->user()->id;
            $data->score= $request->score;
          $data->test_id= $request->tests;
            if($request->hasfile('question_image'))
            {            @unlink(public_path('public/uploads/images/'.$data->images));

                $file = $request->file('question_image');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension($file);
                $file->move(public_path('uploads/images'),$filename); 
                $data->question_image = $filename;  
            }

            $data->save();
              for ($q = 1; $q <= 4; $q++) {
            $option = $request->input('option_text_' . $q, '');
            $explanation = $request->input('explanation_' . $q, '');
                $correct=  $request->input('correct_' . $q,'');
              //  print_r($correct);
            if ($option != '') {
                Question_option::where('question_id',$id)->update([
                    'question_id' => $data->id,
                    'option_text' => $option,
                    'explanation' => $explanation,
                    'correct' =>  $request->input('correct_' . $q),
                ]);
                
            }
        }
      
           // return 'a';
       
      
        $data->save();
        return back()->with('flash_success', 'Question Updated successfully');
        
      
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
          $data = Question::find($id);
        @unlink(public_path('public/uploads/images/'.$data->image));
        $data->delete();
        DB::table('question_options')->where('question_id', $id)->delete();

        return back()->with('flash_success', ' Deleted  Successfully!');
    }
    
    
}
