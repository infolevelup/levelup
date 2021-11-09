@section('title', 'My Tickets')
<!DOCTYPE html>
<html lang="en">
   
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
      <!-- basic -->      
      <meta http-equiv="X-UA-Compatible" content="IE=edge">    
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Welcome to Level Up</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->    
      
    
     
      <!-- AOS ANIMATION-->
	  <link rel="stylesheet" href="{{url('/')}}/public/css/aos.css">    
      
            <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css')}}">

      <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/css/css/font-awesome.min.css">      
      <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="{{url('/')}}/public/css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="{{url('/')}}/public/css/responsive.css">     
      <!-- fonts -->
      <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&amp;display=swap" rel="stylesheet">
	  
	  <link href="{{url('/')}}/public/user/css/user.css" rel="stylesheet">
       <link rel="stylesheet"  href="{{url('/')}}/public/css/lightslider.css"/>   
   <meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
             <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  
   </head>
   <body>
     <section>
      <!-- banner bg main start -->
      <div class="banner_bg_main">         
         <!-- header section start -->
        @include('layouts.userheader')
         <!-- header section end -->
         
        
        
    <section class="breadcrumb_section">
	<div class="container">
		<div class="breadcrumb_section_div">
			<h2>Dashboard</h2>
			<p><a href="{{url('/')}}"></a>Home </a>/ <a href="{{url('/dashboard')}}">Dashboard</a></p>
		</div>
		</div>
	</section>


	<section class="u-dashboard">
	<div class="container">
	<div class="row">
	
     @include('layouts.user_sidemenu')

	<article class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
	    
	    <article class="enrolled-course">
			<h2>Enrolled Courses</h2>
			
			<div id="tsum-tabs"> 
		<main>
		  
		  <input id="tab1" type="radio" name="tabs" checked>
		  <label for="tab1">All Courses</label>
			
		  <input id="tab2" type="radio" name="tabs">
		  <label for="tab2">Active Courses</label>
			
		  <input id="tab3" type="radio" name="tabs">
		  <label for="tab3">Completed Courses</label>
		  
			
		  <section id="content1">
				<?php $i=0;  $lescount=0; ?>
			@foreach($order as $order)
			<?php 
			$course=App\Course::where('id',$order->course_id)->first();
			$lesson=App\Lesson::where('course_id',$order->course_id)->get();
			$lessoncount=count($lesson);
		
			?>
			<?php $i=0;  $lescount=0; ?>
			@foreach($lesson as $lesson)
	
			<?php 
				
			$actuallesson=App\Lessons_media::where('lesson_id', $lesson->id)->get();
			$actualcount=count($actuallesson);

			$user=DB::table('lessons_media as lm')->join('chapter_students as cs','lm.id','cs.lesson_media_id')
			->where('lm.lesson_id', $lesson->id)->where('cs.course_id',$order->course_id)
			->where('user_id',Auth::user()->id)->get();
			$lscount=count($user);

			
					    	

			if($lscount==$actualcount && $lscount!=0 && $actualcount!=0 ){
			    $lescount=++$i;

			}
	 
			?>
			@endforeach
			<div class="dashboard-enrolled-courses">
			<a href="#" class="courses-box link-secret tutor-mycourse-wrap">
					<div class="courses-image tutor-mycourse-thumbnail">
						<img src="{{url('/public/uploads/course_images')}}/{{$course->course_image}}" alt="image-1 copy 64" width="480">		
						</div>
					<div class="tutor-mycourse-content">
						<div class="tm-star-rating style-03 tutor-mycourse-rating">
							<?php 
					$total_ratings=App\Rating::where('course_id',$course->id)->where('status','approve')->get()->count();
					$course_rating=App\Rating::where('course_id',$course->id)->where('status','approve')->avg('rating');

					?>	    
						@for($r=1; $r<=$course_rating; $r++)
                       
					<span class="fa fa-star checked"></span>
				 @endfor
						</div>
						<h3 class="course-title">{{$course->title}}</h3>

						<div class="tutor-meta tutor-course-metadata">
							<ul class="course-meta">
								<li class="course-meta-lesson-count">
									<span class="meta-label">Total Lessons:</span>
									<span class="meta-value">{{$lessoncount}}</span>
								</li>
								<li class="course-meta-completed-lessons">
									<span class="meta-label">Completed Lessons:</span>
									<span class="meta-value">{{$lescount}}/{{$lessoncount}}</span>
								</li>
							</ul>
							<?php 
							$percenatge=($lescount/$lessoncount)*100;
							//dd($percenatge);
							?>
							<div class="progress">
							  <div class="progress-bar bg-success" role="progressbar" style="width: {{$percenatge}}%" aria-valuenow="{{$percenatge}}" aria-valuemin="0" aria-valuemax="100">{{$percenatge}}%</div>
							</div>
						</div>
					</div>
					</a>
				</div>
							<?php  $lescount=0; 
?>
			@endforeach
				
				
		  </section>
			
		  <section id="content2">

		
		
		<?php $i=0;	$lescount=0; ?>
			@foreach($Active as $orders)
			<?php 
			$course=App\Course::where('id',$orders->course_id)->first();
			$lesson=App\Lesson::where('course_id',$orders->course_id)->get();
			$lessoncount=count($lesson);
			
			?><?php $i=0;			$lescount=0;
 ?>
			@foreach($lesson as $lesson)
			<?php 
			$actuallesson=App\Lessons_media::where('lesson_id', $lesson->id)->get();
			$actualcount=count($actuallesson);
			
			
			$user=DB::table('lessons_media as lm')->join('chapter_students as cs','lm.id','cs.lesson_media_id')->where('lm.lesson_id', $lesson->id)->where('user_id',Auth::user()->id)->get();
			$lscount=count($user);
		
			if($lscount==$actualcount && $lscount!=0 && $actualcount!=0){
			    $lescount=++$i;
			    		//	dd($lescount);

			}
	    	
			?>
			@endforeach
			<div class="dashboard-enrolled-courses">
			<a href="#" class="courses-box link-secret tutor-mycourse-wrap">
					<div class="courses-image tutor-mycourse-thumbnail">
						<img src="{{url('/public/uploads/course_images')}}/{{$course->course_image}}" alt="image-1 copy 64" width="480">		
						</div>
					<div class="tutor-mycourse-content">
						<div class="tm-star-rating style-03 tutor-mycourse-rating">
							<?php 
					$total_ratings=App\Rating::where('course_id',$course->id)->where('status','approve')->get()->count();
					$course_rating=App\Rating::where('course_id',$course->id)->where('status','approve')->avg('rating');

					?>	    
						@for($r=1; $r<=$course_rating; $r++)
                       
					<span class="fa fa-star checked"></span>
				 @endfor
						</div>
						<h3 class="course-title">{{$course->title}}</h3>

						<div class="tutor-meta tutor-course-metadata">
							<ul class="course-meta">
								<li class="course-meta-lesson-count">
									<span class="meta-label">Total Lessons:</span>
									<span class="meta-value">{{$lessoncount}}</span>
								</li>
								<li class="course-meta-completed-lessons">
									<span class="meta-label">Completed Lessons:</span>
									<span class="meta-value">{{$lescount}}/{{$lessoncount}}</span>
								</li>
							</ul>
							<?php 
							$percenatge=($lescount/$lessoncount)*100;
							//dd($percenatge);
							?>
							<div class="progress">
							  <div class="progress-bar bg-success" role="progressbar" style="width: {{$percenatge}}%" aria-valuenow="{{$percenatge}}" aria-valuemin="0" aria-valuemax="100">{{$percenatge}}%</div>
							</div>
						</div>
					</div>
					</a>
				</div>
			
			@endforeach
				
				
		  </section>
			
		  <section id="content3">
			           <?php  $Active1=App\Course_student::where('user_id',Auth::user()->id)
			           ->where('grade','A Grade')->orwhere('grade','B Grade')
			           ->orwhere('grade','C Grade')->get(); ?>

	
				
		
		<?php $i=0; 	$lescount=0;?>
			@foreach($Active1 as $Active1)
			<?php 
			$course=App\Course::where('id',$Active1->course_id)->first();
			$lesson=App\Lesson::where('course_id',$Active1->course_id)->get();
			$lessoncount=count($lesson);
			
			?>
			<?php 	$i=0;		$lescount=0;
?>
			@foreach($lesson as $lesson)
			<?php 
			$actuallesson=App\Lessons_media::where('lesson_id', $lesson->id)->get();
			$actualcount=count($actuallesson);
			
			
			$user=DB::table('lessons_media as lm')->join('chapter_students as cs','lm.id','cs.lesson_media_id')->where('lm.lesson_id', $lesson->id)->where('user_id',Auth::user()->id)->get();
			$lscount=count($user);
		
			if($lscount==$actualcount && $lscount!=0 && $actualcount!=0){
			    $lescount=++$i;
			    		//	dd($lescount);

			}
	    	
			?>
			@endforeach
			<div class="dashboard-enrolled-courses">
			<a href="#" class="courses-box link-secret tutor-mycourse-wrap">
					<div class="courses-image tutor-mycourse-thumbnail">
						<img src="{{url('/public/uploads/course_images')}}/{{$course->course_image}}" alt="image-1 copy 64" width="480">		
						</div>
					<div class="tutor-mycourse-content">
						<div class="tm-star-rating style-03 tutor-mycourse-rating">
							<?php 
					$total_ratings=App\Rating::where('course_id',$course->id)->where('status','approve')->get()->count();
					$course_rating=App\Rating::where('course_id',$course->id)->where('status','approve')->avg('rating');

					?>	    
						@for($r=1; $r<=$course_rating; $r++)
                       
					<span class="fa fa-star checked"></span>
				 @endfor
						</div>
						<h3 class="course-title">{{$course->title}}</h3>

						<div class="tutor-meta tutor-course-metadata">
							<ul class="course-meta">
								<li class="course-meta-lesson-count">
									<span class="meta-label">Total Lessons:</span>
									<span class="meta-value">{{$lessoncount}}</span>
								</li>
								<li class="course-meta-completed-lessons">
									<span class="meta-label">Completed Lessons:</span>
									<span class="meta-value">{{$lescount}}/{{$lessoncount}}</span>
								</li>
							</ul>
							<?php 
							$percenatge=($lescount/$lessoncount)*100;
							//dd($percenatge);
							?>
							<div class="progress">
							  <div class="progress-bar bg-success" role="progressbar" style="width: {{$percenatge}}%" aria-valuenow="{{$percenatge}}" aria-valuemin="0" aria-valuemax="100">{{$percenatge}}%</div>
							</div>
						</div>
					</div>
					</a>
				</div>
			
			@endforeach
				
				
		
		
		
		
		  </section>
			
		  
			
		</main>
		</div>
			
			</article>
	    
	    
	    
	</article>
	
	
	</div></div>	
	</section>	
	

	
	
	
                            
       
     
     
     
   <div class="clearfix"></div>  
                     
       
     
     
     
   <div class="clearfix"></div>  
     
 <!-- Back to top button -->
<a id="button"></a>    
              
                            
  @include('layouts.user_footer')                     
      
      

      
      
    
      <!-- Javascript files-->
      <script src="{{url('/')}}/public/js/jquery.min.js"></script>     
      <script src="{{url('/')}}/public/js/bootstrap.bundle.min.js"></script>
           
     
     <!-- AOS ANIMATION -->	
	<script src="{{url('/')}}/public/js/aos.js"></script>
<!--	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>-->
	<script>
  		AOS.init();
	</script>
	<script src="{{url('/')}}/public/js/lightslider.js"></script> 
	<script>
    	 $(document).ready(function() {
			$("#content-slider").lightSlider({
                loop:true,
                keyPress:true
            });
            $('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:9,
                slideMargin: 0,
                speed:500,
                auto:false,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }  
            });
		});	
		
    </script>
	
	<script type="text/javascript">
// Created by HTML-TUTS.com
$('.jquery_accordion_title').click(function() {
	$(this).closest('.jquery_accordion_item').toggleClass('active').siblings().removeClass('active').find('.jquery_accordion_content').slideUp(400);
	$(this).closest('.jquery_accordion_item').find('.jquery_accordion_content').slideToggle(400);
	return false;
});
</script>
      
   </body>


</html>