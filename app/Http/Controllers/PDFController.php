<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\classs;
use Auth;
use App\AssignBatch;
use DB;
use Mail;
use App\User;

class PDFController extends Controller
{ 
    
    public function generatePDF(Request $request)
    {
        $orderid=$request->orderid;
        $data = ['orderid' => $orderid];
        $pdf = PDF::loadView('emails.invoice_pdf', $data);
  
        return $pdf->download('invoice.pdf');
    }
    
    public function zoom(Request $request,$classid){
       
        $class=classs::where('id',$classid)->first();
        $batch_id=$class->batch_id;
        $user_id=Auth::user()->id;
         $assignbatch=AssignBatch::where('batch_id',$batch_id)->where('user_id',$user_id)->first();
        
        $classusers = DB::table('student_class_attended')
                ->where('user_id', $user_id)->where('class_id',$class->id)
                ->first();
        if(!$classusers){        
        $insert=DB::table('student_class_attended')->insert(
    ['user_id' => $user_id,
    'batch_id' => $batch_id,
    'course_id'=>$assignbatch->course_id,
    'class_id'=>$class->id,
    'status'=>'attended',
    'date'=>date('m/d/Y')
    ]
);
if($insert)
        {
        return redirect($class->zoom_link);
        }
        else{
            return back();
        }
        
        }else{
                    return redirect($class->zoom_link);

        }
    }
    
      public function generateinvoicePDF(Request $request,$orderid)
    {
         if(Auth::user()->id){
             $user=User::where('id',Auth::user()->id)->first();
             
              $data["email"] =$user->email;
        $data["title"] = "Invoice #".$orderid;
        $data["body"] = "Invoice is generated.";
         $data['orderid']=$orderid;
          $pdf = PDF::loadView('emails.pdfinvoicemail', $data);
  
        Mail::send('emails.pdfinvoicemail', $data, function($message)use($data, $pdf) {
            $message->to($data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "invoice.pdf");
        });
  
                     return back()->with('status', 'Invoice has been mailed please check your inbox');

             
         }else{
             abort(404);
         }
           }
}
