<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ticketing;
use App\Comment;
use App\Mailers\AppMailer;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function postComment(Request $request, AppMailer $mailer)
    {
        $this->validate($request, [
            'comment'   => 'required',
             
        ]);
    
      $comment = new Comment;
              
                $comment->ticket_id =$request->input('ticket_id');
                $comment->user_id=Auth::user()->id;
                $comment->comment=$request->input('comment');
                //$product->icon = $request->icon;
                 if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension($file);
            $filePath = 'uploads/images/' . $filename;
            $file->move(public_path('uploads/images'),$filePath); 
           $comment->image = $filename;  
        }
                
                $comment->save();
          
    
            // send mail if the user commenting is not the ticket owner
            if ($comment->ticket->user->id !== Auth::user()->id) {
               $mailer->sendTicketComments($comment->ticket->user, Auth::user(), $comment->ticket, $comment);
            
     $users = \App\User::find($comment->ticket->user->id);

           $details = [
            'greeting' => 'Hi'.$comment->ticket->user,
            'body' => 'Ticketing response arrived'
            ,
            'thanks' => 'Thank you',
    ];

    $users->notify(new \App\Notifications\TicketNotification($details));
        
    
            }
            return redirect()->back()->with("status", "Your comment has be submitted.");
    }
}
