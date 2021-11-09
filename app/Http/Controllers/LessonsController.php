<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use App\Media;
use App\Question;
use App\QuestionsOption;
use App\Test;
use App\TestsResult;
use App\VideoProgress;
use App\Lessons_media;
use App\Course;
use App\Question_option;
use Session;
use App\Helpers\Helper;
use App\TestsResultsAnswer;
use Auth;
use DB;

class LessonsController extends Controller
{
   
  
  
   public function show($course_id, $mediaid,$lesson_slug)
    {
        
        
        
        $test_result = "";
        $completed_lessons = "";
        $course=Course::where('id',$course_id)->first();
        $lesson = Lesson::where('slug', $lesson_slug)->where('course_id', $course_id)->where('published', '=', 1)->first();
        $lessonmedia = Lessons_media::where('id', $mediaid)->first();
        
                $user_id=Auth::user()->id;

          $classusers = DB::table('chapter_students')
                ->where('user_id', $user_id)->where('lesson_media_id',$lessonmedia->id)->where('course_id',$course->id)->where('lesson_id',$lesson->id)
                ->first();
        if(!$classusers){ 
             $insert=DB::table('chapter_students')->insert(
    ['user_id' => $user_id,
    'lesson_media_id' => $lessonmedia->id,
    'course_id'=>$course->id,
    'lesson_id'=>$lesson->id,
    'type'=>$lessonmedia->name,
    'status'=>'viewed',
    ]
);
        }       
        
        return view('self_learning/classroom',compact('lesson','lessonmedia','course'));

    }


    
   public function showquizz(Request $request,$id)
    {
        
        $test=Test::where('course_id',$id)->first();
         
         
                $user_id=Auth::user()->id;

          $classusers = DB::table('chapter_students')
                ->where('user_id', $user_id)->where('type','quizz')->where('course_id',$id)->where('lesson_id',$test->lesson_id)
                ->first();
        if(!$classusers){ 
                     $insert=DB::table('chapter_students')->insert(
            ['user_id' => $user_id,
            'type' => 'quizz',
            'course_id'=>$id,
            'lesson_id'=>$test->lesson_id,
            'status'=>'viewed',
            ]
            );
        }
           
      return view('self_learning/test',compact('test'));
        
    }
    
    
    
    public function user_ajax_action(Request $request){
    //------------------------------------------for previous and next--------------
      
      if($request->action == 'load_question')
		{
       $output='';
       $ans='';
        $test_id=$request->test_id;
        if($request->session()->has('answer')){
         $ans=Session::get('answer')['option'];
        }
        
        ///------------------------------------------------------------------------------
        
            $question=Question::where('test_id',$request->test_id)->get();
			  
			   $testres=TestsResult::where('user_id',Auth::user()->id)->where('test_id',$request->test_id)->first();
		      if($testres === null){
			    $student = new TestsResult;
                $student->user_id = \Auth::id();
                $student->test_id = $request->test_id;
			        $student->save();
			        
			        
			    
			    foreach($question as $question){
			         $test = new TestsResultsAnswer;
                $test->tests_result_id =$student->id;
                $test->question_id = $question->id;
                
			        $test->save();
			    }
			   }
        //-----------------------------------------
        if($request->question_id == '')
			{
			$que=Question::where('test_id',$request->test_id)->orderBy('id','ASC')->limit(1)->get();
			}
			else
			{
				$que=Question::where('test_id',$request->test_id)->where('id',$request->question_id)->orderBy('id','ASC')->limit(1)->get();
			}
        // $que=Question::where('test_id',1)->get();
      // return $que;
         $i=1;
         foreach($que as $que){
             $output .='
		          	<div class="quiz-box">
					<p class="fw-bold">'.$i.'.'.$que->question.'</p>
				';
             $i++;
             //---------option
               $opt=Question_option::where('question_id',$que->id)->get();
               $count = 1;
        
        				foreach($opt as $sub_row)
        				{
        			//	var_dump($ans);
        				$output.='
									
									<input type="radio" name="questions['.$que->id.']" value="'.$que->id.'"  class="one-'.$count.' answer_option" id="one'.$count.'"	
									 data-question_id="'.$que->id.'" data-id="'.$sub_row->id.'"/> 
								
									<label for="one'.$count.'" class="box first-'.$count.'">
									<div class="course"> <span class="circle"></span> <span class="subject">'.$sub_row->option_text.' </span> </div>
									</label> 
									
							';
        
        					$count = $count + 1;
        				}
        				 $output .= '
			            	</div>';
        		$previous_result = Question::where('id','<',$que->id)->where('test_id',$test_id)->orderBy('id','DESC')->limit('1')->get();

				$previous_id = '';
				$next_id = '';

				foreach($previous_result as $previous_row)
				{
					$previous_id = $previous_row->id;
				}
        			
        			
  				$next_result =Question::where('id','>',$que->id)->where('test_id',$test_id)->orderBy('id','DESC')->limit('1')->get();


  				foreach($next_result as $next_row)
				{
					$next_id = $next_row->id;
				}
        			
        			$if_previous_disable = '';
				$if_next_disable = '';

				if($previous_id == "")
				{
					$if_previous_disable = 'disabled';
				}
				
				if($next_id == "")
				{
					$if_next_disable = 'disabled';
				}
        				 $output .= '
			            		<div class="d-flex justify-content-between p-4">
								<button class="btn bg-previous d-flex align-items-center btn-danger previous" id="'.$previous_id.'" '.$if_previous_disable.' type="button">
								<i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
								';
							
				  		if($if_next_disable=='disabled'){
								$output.='
								<button class="btn bg-next border-success align-items-center btn-success test-complete"  type="submit">
								Submit<i class="fa fa-angle-right ml-2"></i></button>								
								</div>	
				';
			        }else{
				  		$output.='
								<button class="btn bg-next border-success align-items-center btn-success next" id="'.$next_id.'" '.$if_next_disable.' type="button">
								Next<i class="fa fa-angle-right ml-2"></i></button>								
								</div>	
				';  
				}
				
         }
         $output .= '
				</div>
										
								
				';
				
			echo json_encode($output);
			
			
    }
			
			//-----------------for test data store----------------------------
		/*	if($request->action=='view_page'){
			    
			     $question=Question::where('test_id',$request->test_id)->get();
			  
			   
			    $student = new TestsResult;
                $student->user_id = \Auth::id();
                $student->test_id = $request->test_id;
			        $student->save();
			        
			        
			    
			    foreach($question as $question){
			         $test = new TestsResultsAnswer;
                $test->tests_result_id =$student->id;
                $test->question_id = $question->id;
                
			        $test->save();
			      
			    }
			}*/
			//--------------------------for answer--------------------
			if($request->action=='answer'){
			 //  return 'a';
		 $orignial_score =Question::where('id',$request->question_id)->select('score')->first();
		   $query=Question_option::where('question_id',$request->question_id)->where('correct',1)->first();
            $orignal_answer=$query->id;
     	    $marks = 0;
    
             $request->answer_option;
			if($orignal_answer == $request->answer_option)
			{
			    
		 		//$marks =$marks+$orignial_score->score; 
				$marks=1;
			}
			else
			{
			    $marks=0;
			}
		  $test_result=TestsResult::where('user_id',Auth::user()->id)->where('test_id',$request->exam_id)->first();
        
           $test_result_id=$test_result->id;
     	 $answer=TestsResultsAnswer::where('question_id',$request->question_id)->where('tests_result_id',$test_result_id)->update([
            'option_id'=> $request->input('answer_option'),
            'correct'=>$marks,
            ]);

			   
			          
			}
			//------------------------------view exam result--------------
			if($request->action=='test_result'){
                 $test_id=$request->exam_id;
                 	$test_result=TestsResult::where('user_id',\Auth::id())->where('test_id',$request->exam_id)->first();
                 	  $test_result_id=$test_result->id;
                $test_result_table= TestsResultsAnswer::where('tests_result_id',$test_result_id)->where('correct',1)->get();
               $test_result_score=$test_result_table->count();  
                 
			      $answer=TestsResult::where('test_id',$request->exam_id)->where('user_id',\Auth::id())->update([
                  'test_result'=>$test_result_score,
            ]);
    
    if($answer){
       $test_result=TestsResult::where('test_id',$request->exam_id)->where('user_id',\Auth::id())->first();
       // return redirect('/quizz_result/'.$request->exam_id);
                 //return response()->json(["statuss"=>"success"]);
                  return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
                 
}else{
 
                 // return response()->json(['status'=>'failure','msg' => ' successfully']);
   
}
          return response()->json(['statuss'=>'success']);
                 
            
			}
			
    }
    
    
    
    public function quizz_result(Request $request,$test_id){
      
        $test_result=TestsResult::where('test_id',$test_id)->first();
      //  return view('self_learning/quizz_result',compact('test_result'));
        return redirect('dashboard');
    }
    
    
    

    
    
    
    
      public function test($lesson_slug, Request $request)
    {
        
        $data = Session::all();
          $user_details = session('answer');
     print_r($user_details);
        return back();
       //return $lesson_slug;
      $test = Test::where('slug', $lesson_slug)->firstOrFail();
        $answers = [];
        $test_score = 0;
        foreach ($request->get('questions') as $question_id => $answer_id) {
           $question = Question::find($question_id);
          $correct = Question_option::where('question_id', $question_id)
                    ->where('id', $answer_id)
                    ->where('correct', 1)->count() > 0;
            $answers[] = [
                'question_id' => $question_id,
                'option_id' => $answer_id,
                'correct' => $correct
            ];
            if ($correct) {
                if($question->score) {
                    $test_score += $question->score;
                }
            }
            /*
             * Save the answer
             * Check if it is correct and then add points
             * Save all test result and show the points
             */
        }
       $test_result = TestsResult::create([
            'test_id' => $test->id,
            'user_id' => \Auth::id(),
            'test_result' => $test_score,
        ]);
      $test_result->answers()->createMany($answers);


      /*  if ($test->chapterStudents()->where('user_id', \Auth::id())->get()->count() == 0) {
            $test->chapterStudents()->create([
                'model_type' => $test->model_type,
                'model_id' => $test->id,
                'user_id' => auth()->user()->id,
                'course_id' => $test->course->id
            ]);
        }*/

        return back()->with(['message'=>'Test score: ' . $test_score,'result'=>$test_result]);
    }
    
    
    
    
}
