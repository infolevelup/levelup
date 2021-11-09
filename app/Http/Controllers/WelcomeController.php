<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Studentplaced;
use App\Banner;
use App\Subscribe;
use App\Counter;
use App\Patner; 
use App\Testimonial;
use App\Category;
use App\Course;
use App\Aboutus;
use App\Cart;
use App\Page;
use App\Faq;
use App\Lab;
use App\Blog;
use DB;
use Carbon\Carbon;
use url;
use Str;
use Mail;

class WelcomeController extends Controller
{
  

    public function index(Request $request)
    {
        $counters = Counter::orderBy('id','ASC')->limit(2)->get();
        $patners = Patner::orderBy('id','DESC')->get();
       // return $patners;
        $studplaced = Studentplaced::orderBy('id','DESC')->first();
      // return $studplaced;
       $testimonial = Testimonial::orderBy('id','DESC')->get();
       $category = Category::orderBy('id','DESC')->where('popular','1')->where('status',1)->limit(6)->get();
        $course= Course::orderBy('id','DESC')->where('published',1)->get();
               $category1 = Category::inRandomOrder()->limit(4)->get();
        $course1= Course::where('category_id','1')->where('published','1')->orderBy('id','DESC')->limit(6)->get();
        
       // return $course;
        $banners = Banner::orderBy('sortorder','ASC')->where('status','Active')->get();
        return view('welcome',compact('banners','counters','studplaced','patners','testimonial','category','course','category1','course1'));
    }

  
  public function testimonial(Request $request){
      
      $testimonial=Testimonial::all();
      return view('testimonial',compact('testimonial'));
      
  }
  
    public function about(Request $request){
      
      $about=Aboutus::where('id',1)->first();
      //return $about;
              $patners = Patner::orderBy('id','DESC')->limit(5)->get();

              $patnerss = Patner::orderBy('id','Asc')->limit(5)->get();
      return view('about-us',compact('about','patners','patnerss'));
      
  }
  public function show_general_pages(Request $request){
      	$page1=Page::where('published',1)->get();
  		   $faq=Faq::all();
      $page=Page::where('published',1)->get();
      return view('general_pages',compact('page','page1','faq'));
      
  }
    public function show_labs(Request $request){
      $lab=Lab::all();
  		
      return view('labs',compact('lab'));
      
  }  

  
  
public function blog(){
       $blogs = Blog::orderby('id','DESC')->paginate(6);
    	return view('blog',compact('blogs'));
        

}


 public function blogdetails($slug){
        $data = Blog::orderby('id','DESC')->limit('5')->get();

       $blog = Blog::where('slug',$slug)->first();
    	return view('blog-details',compact('blog','data'));
        

}

 
 
 function load_data(Request $request)
    {
     if($request->ajax())
     {
      if($request->id > 0)
      {
       $data = DB::table('blogs')
          ->where('id', '<', $request->id)
          ->orderBy('id', 'DESC')
          ->limit(6)
          ->get();
      }
      else
      {
       $data = DB::table('blogs')
          ->orderBy('id', 'DESC')
          ->limit(6)
          ->get();
      }
      $output = '';
      $last_id = '';
      
      if(!$data->isEmpty())
      {
       foreach($data as $row)
       {
        $output .= '
			   
        <article class="col-lg-4">
						<div class="blog_post trans_200">
							<div class="blog_post_image"><img src="images/blog_1.jpg" alt=""></div>
							<div class="blog_post_body">
								<div class="blog_post_title"><a href="/blog-details/'.$row->slug.'">'.$row->title.'</a></div>
								<div class="blog_post_meta">
									<ul>
										<li><a href="';
										$output.='/blog-details/'.$row->slug.'">admin</a></li>
										<li><a href="#">';
										
									$date= Carbon::parse($row->created_at)->isoFormat('MMM Do YYYY');
									$output.=''.$date.'
									</a></li>
									</ul>
								</div>
								<div class="blog_post_text">';
								$desc=Str::limit($row->description,10);
									$output.='<p>'.$desc.'</p>
								</div>
							</div>
						</div>
			
			</article>
			
			
        ';
        $last_id = $row->id;
       }
       $output .= '
      
        <div id="load_more">
        <div class="col text-center" class="row">
        <button type="button" name="load_more_button"  data-id="'.$last_id.'" id="load_more_button">Load More</button>
        </div>
       </div>
       ';
      }
      else
      {
       $output .= '
       
        <div id="load_more" class="row">
        <div class="col text-center">
					<button type="button" name="load_more_button" >No Data Found</button>
					</div>
       </div>
       ';
      }
      echo $output;
     }
    } 

public function search(Request $request)
    {
       $courses=DB::table('categories as c')->join('courses as co','co.category_id','c.id')->select('c.*','co.*')
        ->where("c.name","LIKE","%{$request->input('search')}%")
        ->Orwhere("co.title","LIKE","%{$request->input('search')}%")->get();
   
      return view('search',compact('courses'));
    }

public function searchindex()
    {
    	return view('testing11');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function testautocomplete(Request $request)
    {
         $courses=DB::table('categories as c')->join('courses as co','co.category_id','c.id')->select('c.*','co.*')
        ->where("c.name","LIKE","%{$request->input('search')}%")
        ->Orwhere("co.title","LIKE","%{$request->input('search')}%")->get();
   
    
        return response()->json($data);
    }

public function subscribe(Request $request){
 
            $flight = new Subscribe;
            $flight->email = $request->email;
            $flight->save();
        
       // return $flight;
    if($flight){
        $data = array(
        'email' => $request->email,
        'user'=>'user',
    );
    
       Mail::send(['html'=>'mail.subscribeform'], $data, function($message) use ($data) {
          $message->to($data['email'])->subject
             ('Subscription Form');
          $message->from('testing@telcopl.com','Testing');
       });
   $data1 = array(
    'user'=>'admin',
     'email' => $request->email,
       );
    
       Mail::send(['html'=>'mail.subscribeform'], $data1, function($message) {
          $message->to('testing@telcopl.com')->subject
             ('Subscription Form');
          $message->from('testing@telcopl.com','Testing');
       });   
     
     
     return back()->with('flash_success','Thank You Our Team will get back shortly.....');
 }else{
      return back()->with('flash_error','Something went wrong please try again later');
 }
 
   
}
}

