<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Ticketing;
use App\TicketCategory;
use Auth;
use App\Comment;
use App\Rating;
use App\Course_student;
use PDF;
use Mail;
use App\Student_Assignment;
use App\Student_Project;
use App\Order;
 
class DashboardController extends Controller
{
    //
      public function index(Request $request)
    {
    	return view('admin.dashboard');
    }
    
     public function generateinvoice(Request $request,$id)
    {
        if($id){
           $order=Order::where('order_id',$id)->first();
          
           return view('admin.orders.invoice',compact('order')); 
        }else{
            abort(404);
        }
    	
    }
    
      public function shownotification(Request $request)
    {
    	return view('admin.notification');
    }
    
    public function tickets()
{
    $user=User::where('id',Auth::user()->id)->first();
    if($user->role_id=='1'){
  
    $tickets = Ticketing::paginate(10);
    $categories = TicketCategory::all();

    return view('admin.tickets', compact('tickets', 'categories'));

    }else{
        abort(404);
    }
    }




public function show($ticket_id)
{
    
     $ticket = Ticketing::where('ticket_id', $ticket_id)->firstOrFail();

   // $comments = $ticket->comments;
   $comments=Comment::where('ticket_id',$ticket->id)->orderBy('id','DESC')->get();
    $category = $ticket->category;

    return view('admin.ticketshow', compact('ticket', 'category', 'comments'));
}



public function review(Request $request)
{
   // return 'z';
     $data = Rating::all();

  

    return view('admin.reviews.review', compact('data'));
}


    public function changereviewStatus(Request $request)
    {
    	$order = Rating::where('id',$request->review_id)->first();
    	if ($order) {
    		$order->status = $request->order_status;
    		$order->save();
    		return back()->with('flash_success', 'Status updated successfully');
    	}
    }


   public function changeGradeStatus(Request $request)
    {
    	$order = Course_student::where('user_id',$request->user_id)->where('course_id',$request->course_id)->first();
    	if ($order) {
    		$order->grade = $request->grade;
    		$order->save();
    		if($request->grade=='A Grade'||$request->grade=='B Grade'||$request->grade=='C Grade'){
    		    
    		    
    		    
    		    
    		$user=User::where('id',$request->user_id)->first();
    		
    		 $users = \App\User::find($user->id);
           $details = [
            'greeting' => 'Hi'.$users->name,
            'body' => 'Your certificate has been generated for',
            'thanks' => 'please check your email',
    ];

    $users->notify(new \App\Notifications\GradeNotification($details));
        
    		//-------------------------mail--------------------
    		 $data["email"] = $user->email;
        $data["title"] = "Certificate Generation";
        $data["body"] = "Your certificate has been generated please find the attachment below";
  $data['user_id']=$user->id;
  $data['course_id']=$request->course_id;
  $data['grade']=$request->grade;
        $pdf = PDF::loadView('emails.certificate', $data);
  
        Mail::send('emails.certificate', $data, function($message)use($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "certificate.pdf");
        });
    		}
        //-----------------------------------------------
    		return back()->with('flash_success', 'Status updated successfully');
    	}
    }


   public function showcertificate(Request $request,$id)
        {
           $data=Course_student::where('id',$id)->first();
             return view('admin.purchased_course.cerificate', compact('data'));
        }
        public function orders(Request $request)
        {
           $data=Order::all();
             return view('admin.orders.index', compact('data'));
        }
        
        public function showassignment (Request $request,$course_id,$user_id){
            
              if(request('type'))
        {
            $data =Student_Assignment::where('course_id',request('type'))->where('user_id',$user_id)->get();
        }
        else{
            $data=Student_Assignment::where('course_id',$course_id)->where('user_id',$user_id)->get();
        }
            //return $data;
            return view('admin.purchased_course.assignment',compact('data'));
        }
        
        
        
         public function showproject (Request $request,$course_id,$user_id){
            
              if(request('type'))
        {
            $data =Student_Project::where('course_id',request('type'))->where('user_id',$user_id)->get();
        }
        else{
            $data=Student_Project::where('course_id',$course_id)->where('user_id',$user_id)->get();
        }
            
            return view('admin.purchased_course.project',compact('data'));
        }
        
        
}