<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Auth;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        if($user = Auth::user()){
           $order=Order::where('user_id',Auth::user()->id)->get();
          
           return view('orders',compact('order')); 
        }else{
            abort(404);
        }
    	
    }
    
     public function generateinvoice(Request $request,$id)
    {
        if($user = Auth::user()){
           $order=Order::where('order_id',$id)->first();
          
           return view('invoice',compact('order')); 
        }else{
            abort(404);
        }
    	
    }
}
