<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mailers\AppMailer;
use App\Mailers\InvoiceMailer;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\TeacherProfile;
use App\TeacherSkills;
use App\User;
use App\Cart;
use DB;
use Auth;
use App\Course;
use Hash;
use App\Category;
use Validator;
use Session;
use App\Contact_general_form;
use App\Contact_feedback_form;
use App\Enquiry_form;
use App\Bundle;
use App\Order;
use App\OrderList;
use App\Course_student;
use App\Wishlist;
use Mail;
use App\Mail\LoginMail;
use App\Mail\PasswordReset;
use App\Corporate_form;
use App\CourseEnquiry;
class CartController extends Controller
{
 
 public function index(Request $request){
     $session_id = Session::getId();
    	$carts = Cart::where('user_id',Auth::user()->id)->orwhere('session_id',$session_id)->get();
    return view('cart',compact('carts'));
 }
 
 public function courseindex(Request $request){
     
     if (request('type') == 'popular') {
            $courses = Course::withoutGlobalScope('filter')->where('published', 1)->where('popular', '=', 1)->orderBy('id', 'desc')->paginate(9);
        } else if (request('type') == 'priceL-H') {
            $courses = Course::withoutGlobalScope('filter')->where('published', 1)->orderBy('price', 'asc')->paginate(9);

        } else if (request('type') == 'priceH-L') {
            $courses = Course::withoutGlobalScope('filter')->where('published', 1)->orderBy('price', 'desc')->paginate(9);

        }else if(request('typee')){
            $id=request('typee');
           // $courses = Course::withoutGlobalScope('filter')->where('category_id',$category->id)->where('published', 1)->orderBy('id', 'desc')->paginate(6);
        $courses = Course::withoutGlobalScope('filter')->whereRaw('category_id IN ('.$id.')')->where('published', 1)->orderBy('id', 'desc')->paginate(9);
            
        } else {
            $courses = Course::withoutGlobalScope('filter')->where('published', 1)->orderBy('id', 'desc')->paginate(9);
        }
    return view('course',compact('courses'));
 }
 
 
 //----------------------category wise course display------------------
 
   /* public function category_wise_course(Request $request,$slug){
     $category=Category::where('slug',$slug)->first();
       
         $category_filter=Category::where('status',1)->get();
           if (request('type') == 'popular') {
            $courses = Course::withoutGlobalScope('filter')->where('category_id',$category->id)->where('published', 1)->where('popular', '=', 1)->orderBy('id', 'desc')->paginate(6);
        } else if (request('type') == 'trending') {
            $courses = Course::withoutGlobalScope('filter')->where('category_id',$category->id)->where('published', 1)->where('trending', '=', 1)->orderBy('id', 'desc')->paginate(6);

        } else if (request('type') == 'featured') {
            $courses = Course::withoutGlobalScope('filter')->where('category_id',$category->id)->where('published', 1)->where('featured', '=', 1)->orderBy('id', 'desc')->paginate(6);

        } else if(request('typee')){
            $id=request('typee');
           // $courses = Course::withoutGlobalScope('filter')->where('category_id',$category->id)->where('published', 1)->orderBy('id', 'desc')->paginate(6);
        $courses = Course::withoutGlobalScope('filter')->whereRaw('category_id IN ('.$id.')')->where('published', 1)->orderBy('id', 'desc')->paginate(12);
            
        } else{
            
            $courses = Course::withoutGlobalScope('filter')->where('category_id',$category->id)->where('published', 1)->orderBy('id', 'desc')->paginate(6); 
        }
        
      return view('category_list',compact('category','courses','category_filter'));
      
  }*/
  
  public function category_wise_course(Request $request,$slug){
     $category=Category::where('slug',$slug)->first();
       
      if (request('type') == 'popular') {
            $courses = Course::withoutGlobalScope('filter')->where('category_id',$category->id)->where('published', 1)->where('popular', '=', 1)->orderBy('id', 'desc')->paginate(9);
        } else if (request('type') == 'priceL-H') {
            $courses = Course::withoutGlobalScope('filter')->where('category_id',$category->id)->where('published', 1)->where('popular', '=', 1)->orderBy('price', 'asc')->paginate(9);

        } else if (request('type') == 'priceH-L') {
            $courses = Course::withoutGlobalScope('filter')->where('category_id',$category->id)->where('published', 1)->where('popular', '=', 1)->orderBy('price', 'desc')->paginate(9);

        }else if(request('typee')){
            $id=request('typee');
           // $courses = Course::withoutGlobalScope('filter')->where('category_id',$category->id)->where('published', 1)->orderBy('id', 'desc')->paginate(6);
        $courses = Course::withoutGlobalScope('filter')->whereRaw('category_id IN ('.$id.')')->where('published', 1)->orderBy('id', 'desc')->paginate(9);
            
        } else {
            $courses = Course::withoutGlobalScope('filter')->where('category_id',$category->id)->where('published', 1)->orderBy('id', 'desc')->paginate(9);
        }
      return view('category_list',compact('category','courses'));
      
  }
  
  
  
  //--------------------------------------------------------
 
 public function addToCart(Request $request)
    {
     //   return 'aa';
     $request->product_id;
    	$cart = Cart::where('session_id',$request->session_id)
    	->where('course_id',$request->course_id)
    	->where('price_id',$request->price_id)
    	->first();
  $request->price_id;
    $cart;
    	if ($cart) {
    	  //  return 'a';
    		$cart->quantity = $cart->quantity+$request->quantity;
    	}
    	else{
    	   // return 'a';
    		$cart = new Cart;
    		$cart->session_id = $request->session_id;
	    	if (!Auth::check()) {
	    		$cart->user_id = 0;
	    	}
	    	else{
	    		$cart->user_id = Auth::user()->id;
	    	}
	    	$cart->course_id = $request->course_id;
	    	$cart->price_id = $request->price_id;
	    	$cart->quantity = $request->quantity;
    	}
    //	return $cart;
    	$cart->save();
        $cart_counter = Cart::where('session_id',$request->session_id)->count('id');
    	return response()->json(['msg' => 'Product Added successfully','cart_counter' => $cart_counter]);
    }
    
    
    
    
     public function addtowishlist(Request $request){
       //  return 'aa';
        $data=$request->all();
       $productid= $request->input('wcourseid');
        $session_id=Session::get('session_id');
        
     $checkwishlist=DB::select("select * from wishlist where courseid=$productid and session_id='$session_id'");
        if(count($checkwishlist)>0){
                   return back()->with('flash_error', 'Product already added to wishlist ');
        }

        if(empty($session_id)){
            $session_id=str::random(40);
          
        }
      session::put('session_id',$session_id);
      
        // echo "<pre>";
        // print_r($data);
        // die;
        if(Auth::check()){
            $userid=Auth::user()->id;
            
        DB::table('wishlist')->insert([
            'courseid'=>$data['wcourseid'],
        'coursename'=>$data['wcoursename'],
        'price'=>$data['wprice'],
        'userid'=>$userid,
        'session_id'=>$session_id
        
        ]);
                    return back()->with('flash_success', 'Product added to wishlist');
        }else{
        DB::table('wishlist')->insert([
            'courseid'=>$data['wcourseid'],
        'coursename'=>$data['wcoursename'],
        'price'=>$data['wprice'],
        'userid'=>0,
        'session_id'=>$session_id
        
        ]);
            }
                    return back()->with('flash_success', 'Product added to wishlist');

//      return redirect('/wishlist')->with('sucess','Product Added successfully.');

    }
    
    
    public function deleteCartQuantity(Request $request,$id,$session_id)
    {
       $cart = Cart::where('session_id',$session_id)->where('id',$id)->first();
       if ($cart) {
           $cart->delete();
           return back();
       }
       else{
            abort(404);
       }
    }
    
    
    public function wishlist(Request $request)
    {
    	   $wishlist=Wishlist::where('userid',Auth::user()->id)->where('courseid',$request->courseid)->get();
              if($wishlist->isEmpty()){ 

    		$wish = new Wishlist;
    		$wish->courseid = $request->courseid;
	    	$wish->coursename = $request->coursename;
	    	$wish->price = $request->price;
        	$wish->userid = Auth::user()->id;
            $wish->session_id = $request->session_id;
            $wish->save();
           
                 return response()->json(['status'=>'success','msg' => 'Product Added successfully']);

        }else{
            return response()->json(['status'=>'failure','msg' => 'Product Already exists']);

       }
    }
    public function destroy(Request $request) {
        
        $wishl=Wishlist::where('id', $request->id)->delete();
         return back()->with('flash_success', 'Item Removed successfully');
 }

    public function wishlistdetails(Request $request){
        
        $wish=Wishlist::where('userid',Auth::user()->id)->get();
	
        return view('/wishlist',compact('wish'));
    }
    
    
    public function contact(Request $request){
        return view('contact-us');
        
        
    }
    
    
    public function corporateindex(Request $request){
        return view('corporate-traning');
        
        
    }
    
    public function generalform(Request $request){
            
             $flight = new Contact_general_form;

            $flight->name = $request->name;
             $flight->email = $request->email;
              $flight->phone = $request->mobile;
               $flight->subject = $request->subject;
                $flight->message = $request->message;

        $flight->save();
        
        
         if($flight){
      $data = array(
        'name' =>$request->name,
        'email' => $request->email,
        'phone'=>$request->mobile,
        'message1' => $request->message,
        'subject' => $request->subject,
                 'user'=>'user',
           );
     
    // return $email;
       Mail::send(['html'=>'mail.general_form'], $data, function($message) use ($data) {
            
          $message->to($data['email'])->subject
             ('General Form');
          $message->from('testing@telcopl.com','Testing');
       });
 
   $data1 = array(
                
                 'user'=>'admin',
                'name' =>$request->name,
     'email' => $request->email,
     'phone'=>$request->mobile,
     'message1' => $request->message,
     'subject' => $request->subject,
           );
    
       Mail::send(['html'=>'mail.general_form'], $data1, function($message) {
          $message->to('testing@telcopl.com')->subject
             ('General Form');
          $message->from('testing@telcopl.com','Testing');
       });   
     
     
     return back()->with('flash_successgeneral','Our team will get back to you shortly. Thank you!');
 }else{
      return back()->with('flash_errorgeneral','Something went wrong please try again later');
 }
 

        
     //   return back()->with('flash_success', 'Thank You!! for reaching Us.');
    }
    
    
    public function feedback(Request $request){
        
            $this->validate($request, [
          'name' => 'required',
          'email' => 'required|email',
          'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
          
          'message' => 'required'
       ]);

      //  Store data in database
$flight= Contact_feedback_form::create($request->all());
        
        
         if($flight){
      $data = array(
        'name' =>$request->name,
        'email' => $request->email,
        'phone'=>$request->phone,
        'message1' => $request->message,
                 'user'=>'user',
           );
     
    // return $email;
       Mail::send(['html'=>'mail.feedback'], $data, function($message) use ($data) {
            
          $message->to($data['email'])->subject
             ('FeedBack Form');
          $message->from('testing@telcopl.com','Testing');
       });
 
   $data1 = array(
                
                 'user'=>'admin',
                'name' =>$request->name,
     'email' => $request->email,
     'phone'=>$request->phone,
     'message1' => $request->message,
           );
    
       Mail::send(['html'=>'mail.feedback'], $data1, function($message) {
          $message->to('testing@telcopl.com')->subject
             ('FeedBack Form');
          $message->from('testing@telcopl.com','Testing');
       });   
     
     
     return back()->with('flash_successfeedback','Thank You for Your Feedback!');
 }else{
      return back()->with('flash_errorfeedback','Something went wrong please try again later');
 }
 

        
       // return back()->with('flash_success2', 'Thank You!! for reaching Us.');
        
    }
    
    
        public function enquiry(Request $request){
        
        //return 'aa';
            $this->validate($request, [
          'name' => 'required',
          'email' => 'required|email',
          'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
          
          
       ]);

      //  Store data in database
    $flight=  Enquiry_form::create($request->all());

         if($flight){
      $data = array(
        'name' =>$request->name,
        'email' => $request->email,
        'phone'=>$request->phone,
        'enquiry' => $request->enquiry,
                 'user'=>'user',
           );
     
    // return $email;
       Mail::send(['html'=>'mail.enquiry'], $data, function($message) use ($data) {
            
          $message->to($data['email'])->subject
             ('Enquiry Form');
          $message->from('testing@telcopl.com','Testing');
       });
 
   $data1 = array(
                
                 'user'=>'admin',
                'name' =>$request->name,
     'email' => $request->email,
     'phone'=>$request->phone,
     'enquiry' => $request->enquiry,
        
           );
    
       Mail::send(['html'=>'mail.enquiry'], $data1, function($message) {
          $message->to('testing@telcopl.com')->subject
             ('Enquiry Form');
          $message->from('testing@telcopl.com','Testing');
       });   
     
     
     return back()->with('flash_successenquiry','Thank you for your enquiry. We will revert shortly!
');
 }else{
      return back()->with('flash_errorenquiry','Something went wrong please try again later');
 }
 
        
    //    return back()->with('flash_success1', 'Thank You!! for reaching Us.');
        
    }
    public function courseenquiry(Request $request){
        


             $flight = new CourseEnquiry;

            $flight->name = $request->name;
             $flight->email = $request->email;
              $flight->phone = $request->phone;
              $flight->date = $request->date;
                $flight->course_name = $request->course_name;
                $flight->message = $request->message;
                $flight->time_to_call_back = $request->time_to_call_back;
             
        $flight->save();
      //  Store data in database
   // $flight=  Corporate_form::create($request->all());

         if($flight){
      $data = array(
        'name' =>$request->name,
        'email' => $request->email,
        'phone'=>$request->phone,
        'date'=>$request->date,
        'course_name'=>$request->course_name,
        'message2' => $request->message,
        'time_to_call_back'=>$request->time_to_call_back,
        'user'=>'user',
           );
     
    // return $email;
       Mail::send(['html'=>'mail.courseenquiry'], $data, function($message) use ($data) {
            
          $message->to($data['email'])->subject
             ('Talk To Our Expert Form');
          $message->from('testing@telcopl.com','Testing');
       });
 
   $data1 = array(
                
                 'user'=>'admin',
        'name' =>$request->name,
        'email' => $request->email,
        'phone'=>$request->phone,
        'date'=>$request->date,
        'course_name'=>$request->course_name,
        'message2' => $request->message,
        'time_to_call_back' => $request->time_to_call_back,
           );
    
       Mail::send(['html'=>'mail.courseenquiry'], $data1, function($message) {
          $message->to('testing@telcopl.com')->subject
             ('Talk To Our Expert Form');
          $message->from('testing@telcopl.com','Testing');
       });   
     
     
     return back()->with('flash_success','Thank you for reaching us!');
 }else{
      return back()->with('flash_error','Something went wrong please try again later');
 }    
    }
    
        public function corporate(Request $request){
            $this->validate($request, [
          'name' => 'required',
          'company_name'=>'required',
          'reason'=>'required',
          'email' => 'required|email',
          'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
          'message'=>'required',
          
       ]);


             $flight = new Corporate_form;

            $flight->name = $request->name;
             $flight->email = $request->email;
              $flight->phone = $request->phone;
              $flight->reason = $request->reason;
                $flight->company_name = $request->company_name;
                $flight->message = $request->message;
             
        $flight->save();
      //  Store data in database
   // $flight=  Corporate_form::create($request->all());

         if($flight){
      $data = array(
        'name' =>$request->name,
        'email' => $request->email,
        'phone'=>$request->phone,
        'reason'=>$request->reason,
        'company_name'=>$request->company_name,
        'message1' => $request->message,
                 'user'=>'user',
           );
     
    // return $email;
       Mail::send(['html'=>'mail.corporate'], $data, function($message) use ($data) {
            
          $message->to($data['email'])->subject
             ('Training Advisor Form');
          $message->from('testing@telcopl.com','Testing');
       });
 
   $data1 = array(
                
                 'user'=>'admin',
        'name' =>$request->name,
        'email' => $request->email,
        'phone'=>$request->phone,
        'reason'=>$request->reason,
        'company_name'=>$request->company_name,
        'message1' => $request->message,
        
           );
    
       Mail::send(['html'=>'mail.corporate'], $data1, function($message) {
          $message->to('testing@telcopl.com')->subject
             ('Training Advisor Form');
          $message->from('testing@telcopl.com','Testing');
       });   
     
     
     return back()->with('flash_success','Thank You!! for reaching Us.');
 }else{
      return back()->with('flash_error','Something went wrong please try again later');
 }    
    }
    
    
     public function checkout(Request $request)
    {
        //return 'a';
        $product = "";
        $teachers = "";
        $type = "";
        $bundle_ids = [];
        $course_ids = [];
        if ($request->has('course_id')) {
       $product = Course::findOrFail($request->get('course_id'));
           $teachers = User::where('id',$product->teacher_id)->pluck('name');
            $type = 'course';

        } elseif ($request->has('bundle_id')) {
           $product = Bundle::findOrFail($request->get('bundle_id'));
          $teachers = User::where('id',$product->teacher_id)->pluck('name');
            $type = 'bundle';
        }

       //---------------------------------------
       $cart = Cart::where('session_id',Session::getId())
       ->orwhere('user_id',Auth::user()->id)
    	->where('course_id',$request->get('course_id'))
    	->where('price_id',$request->amount)
    	->first();
    	if ($cart) {
       // return back()->with('flash_error', 'Item already exists in cart');
    
    
    	}
    	else{
    		$cart = new Cart;
    		$cart->session_id = Session::getId();
	    	if (!Auth::check()) {
	    		$cart->user_id = 0;
	    	}
	    	else{
	    		$cart->user_id = Auth::user()->id;
	    	}
	    	$cart->course_id =$request->get('course_id');
	    	$cart->price_id =$request->amount;
	        $cart->description = $product->description;
            $cart->image = $product->course_image;
            $cart->type = $type;
            $cart->teachers= $teachers;
    	}
    	$cart->save();
       //-------------------------

  
     
       $cart_course=Cart::where('user_id',Auth::user()->id)->orwhere('session_id',Session::getId())->get(); 
     
        foreach ($cart_course as $item) {
          
            if ($item->type == 'bundle') {
                $bundle_ids[] = $item->course_id;
            } else {
              $course_ids[] = $item->course_id;
            }
        }
       
       
      $courses =Course::find($course_ids);
     

        $total = $courses->sum('price');

        //Apply Tax
        


        return view('cart.checkout', compact('courses','total','cart_course'));
    }

    
    
    
    
    
    public function showCheckout(Request $request)
    {
        $session_id = Session::getId();
        $carts = Cart::where('session_id',$session_id)->orwhere('user_id',Auth::user()->id)->get();
        
       
       
            return view('cart/checkout',compact('carts'));
        
            
        
        
    }
     public function deleteCartitem(Request $request,$id,$session_id,$user_id)
    {
        //return 'a'
       $cart = Cart::where('course_id',$id)->where('user_id',$user_id)->orwhere('session_id',$session_id)->first();
       if ($cart) {
           $cart->delete();
          // return back()->with('flash_success', 'Deleted from wishlist');
           return redirect('/course');
       }
       else{
            abort(404);
       }
        
      
    }
    
        public function offlinePayment(Request $request)
    {
        $session_id = Session::getId();
        $userid=Auth::user()->id;
        $carts = Cart::where('user_id',Auth::user()->id)->orwhere('session_id',$session_id)->get();
        $order_id=strtoupper(Str::random(10));
        $price=$request->price;
         foreach ($carts as $cart) {
          $subtotal[] = $cart->price;
          $orderList = new OrderList;
          $orderList->order_id = $order_id;
          $orderList->course_id = $cart->course_id;
          $orderList->price = $cart->price_id;
           $orderList->type='course';
            $orderList->status='paid';
             $orderList->user_id=Auth::user()->id;
          $orderList->save();
          
            $cou=new Course_student;
       
       $cou->user_id=$userid;
       $cou->course_id=$cart->course_id;
           $cou->save();
             
         }
        
         $order = new Order;
        $order->order_id = $order_id;
        $order->user_id = Auth::user()->id;
        $order->payable_price=$price;
        $order->order_price=$price;
        $order->status='paid';
        $order->save();
        
        $deletegrocerycart=DB::select("delete from carts where user_id=$userid or session_id='$session_id'");
       $user=User::where('id',$userid)->first();
      $users =User::find(1);
           $details = [
            'greeting' => 'Hi Admin',
            'body' => $user->name.'has purchased a new course',
            'thanks' => 'Thank you',
    ];

    $users->notify(new \App\Notifications\CoursePurchasedNotification($details));
     
     
      
      return redirect('/confirmorder');
    }

    
public function emailinvoice(Request $request, InvoiceMailer $mailer, $id)
{
   
        $order=Order::where('order_id',$id)->where('user_id',Auth::user()->id)->first();
        
        $mailer->sendInvoiceInformation(Auth::user(), $order);

        return redirect()->back()->with("status", "A Invoice with ID: #$order->order_id has been mailed check Your inbox  .");
}

    
    
        public function category() {


        $sub_categories = DB::table('subcategories')->first();
        $main_category = DB::table('categories')->get();
        return view('pages.cause_category', ['sub_categories' => $sub_categories, 'main_category' => $main_category]);

    }


    public function get_causes_against_category($id){
   
        return 'a';
 //$data = DB::table("courses")->whereRaw('category_id IN ('.$id.')')->get();
   //     echo json_encode($data);
    $category=Category::where('slug',$slug)->first();
       
         $category_filter=Category::where('status',1)->get();
      return $courses = Course::withoutGlobalScope('filter')->whereRaw('category_id IN ('.$id.')')->where('published', 1)->orderBy('id', 'desc')->paginate(6);
         return view('category_list',compact('category','courses','category_filter'));
        
    }
    
    
    
    
}