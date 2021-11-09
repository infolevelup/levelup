<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TicketCategory;
use App\Ticketing;
use App\Mailers\AppMailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\User;
use App\Comment;




class TicketsController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
public function create()
{
    $categories = TicketCategory::all();

    return view('tickets.create', compact('categories'));
}


public function store(Request $request, AppMailer $mailer)
{
    $this->validate($request, [
            'title'     => 'required',
            'category'  => 'required',
            'priority'  => 'required',
            'message'   => 'required'
        ]);

        $ticket = new Ticketing([
            'title'     => $request->input('title'),
            'user_id'   => Auth::user()->id,
            'ticket_id' => strtoupper(Str::random(12)),
            'category_id'  => $request->input('category'),
            'priority'  => $request->input('priority'),
            'message'   => $request->input('message'),
            'status'    => "Open",
        ]);

        $ticket->save();

        $mailer->sendTicketInformation(Auth::user(), $ticket);

        return redirect()->back()->with("status", "A ticket with ID: #$ticket->ticket_id has been opened.");
}

public function userTickets()
{
    $tickets = Ticketing::where('user_id', Auth::user()->id)->paginate(10);
    $categories = TicketCategory::all();

    return view('tickets.user_tickets', compact('tickets', 'categories'));
}

public function show($ticket_id)
{
     $ticket = Ticketing::where('ticket_id', $ticket_id)->firstOrFail();

   // $comments = $ticket->comments;
   $comments=Comment::where('ticket_id',$ticket->id)->get();
    $category = $ticket->category;

    return view('tickets.show', compact('ticket', 'category', 'comments'));
}

public function index()
{
    $user=User::where('id',Auth::user()->id)->first();
    if($user->role_id=='1'){
  
    $tickets = Ticketing::paginate(10);
    $categories = TicketCategory::all();

    return view('tickets.index', compact('tickets', 'categories'));

    }else{
        abort(404);
    }
    }


public function close($ticket_id, AppMailer $mailer)
{
    $ticket = Ticketing::where('ticket_id', $ticket_id)->firstOrFail();

    $ticket->status = 'Closed';

    $ticket->save();

    $ticketOwner = $ticket->user;

    $mailer->sendTicketStatusNotification($ticketOwner, $ticket);

    return redirect()->back()->with("status", "The ticket has been closed.");
}





}
