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
      <title>Level Up | Dashboard</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->    
      
    <meta name="_token" content="{{ csrf_token() }}">
     
      <!-- AOS ANIMATION-->
	  <link rel="stylesheet" href="{{url('/')}}/public/css/aos.css">    
      
      
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
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css')}}">
  
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
			<p><a href="{{url('/')}}">Home</a> / <a href="{{url('/dashboard')}}">Dashboard</a></p>
		</div>
		</div>
	</section>


	<section class="u-dashboard">
	<div class="container">
	<div class="row">
	
	<article class="col-lg-3 col-md-4 col-sm-12 hidden-xs">
	
			@if($crs_prcse)
	<div class="new-classroom-box">
	<div class="bodyContainerWrapper">
	<div class="bodyContainer">
		<div class="padding">		
			<div class="jquery_accordion_wrapper">

			    
            				<div class="jquery_accordion_item">
            					<div class="jquery_accordion_title"><div class="icon"><img src="{{ asset('images/elearning.png')}}"></div> Live Courses</div>
            	
            					<div class="jquery_accordion_content">
            	
			    @foreach($crs_prcse as $crs)
			    <?php 
			     $crs_id=$crs->course_id;
                             $course_types=App\Course::where('id',$crs_id)->first();
                             $crs_type=$course_types->type;
			    ?>
            					    
            			@if($crs_type=='live class')
            			<?php 
            			    $liveclass=App\Course::where('id',$crs_id)->where('type','live class')->get();

            			?>
            					      @if(count($liveclass)>0)
            					    <ul>
            					    @foreach($liveclass as $liveclass)
            					   
            				
            				        	<li><a href="#single_course_area" class="course_box" data-id="{{$liveclass->id}}">{{$liveclass->title}}</a></li>
            					    @endforeach
            						</ul>
            						
            						@endif
            					@endif
            					@endforeach
            					</div>
            				</div>
                        
                        
                        
            				<div class="jquery_accordion_item">
            					<div class="jquery_accordion_title"><div class="icon"><img src="{{ asset('images/education.png')}}"></div> Self-Paced Courses</div>
            					<div class="jquery_accordion_content">
            					    @foreach($crs_prcse as $crs)
			    <?php 
			     $crs_id=$crs->course_id;
                             $course_types=App\Course::where('id',$crs_id)->first();
                             $crs_type=$course_types->type;
			    ?>
            			            			@if($crs_type=='self peaced')

            				<?php 
                                 $selfclass=App\Course::where('id',$crs_id)->where('type','self peaced')->get();

            			?>
            			
            					    @if(count($selfclass)>0)
            					    <ul>
            					    @foreach($selfclass as $selfcourse)
            					   
            				
            				        	<li><a href="#single_course_area" class="course_box" data-id="{{$selfcourse->id}}">{{$selfcourse->title}}</a></li>
            					    @endforeach
            						</ul>
            						
            						@endif
            			@endif
            			             @endforeach

            					</div>
            				</div>
                        

            
                <?php 
                $random_course=App\Course::all()->random(2);
                ?>
				<div class="jquery_accordion_item">
					<div class="jquery_accordion_title"><div class="icon"><img src="{{ asset('images/badge.png')}}"></div> Recommended Courses</div>
					<div class="jquery_accordion_content">
						
					 @if(count($random_course)>0)
            					    <ul>
            					    @foreach($random_course as $random_course)
            					   
            				
            				        	<li><a href="{{url('/course')}}/{{$random_course->slug}}">{{$random_course->title}}</a></li>
            					    @endforeach
            						</ul>
            						
            						@endif
						
					</div>
				</div>
				
			
				 

			</div>		
		</div>
	</div>
    </div>
	
	</div>
	
	<div class="upcoming-classes clearfix">
        <h5>Upcoming Classes</h5>
         @foreach($crs_prcse as $crs)
			    <?php 
			     $crs_id=$crs->course_id;
			     $batch=App\Batch::where('course_id',$crs_id)->first();
			     if($batch){
			     // echo $batch->id;
			       $endate=date('m/d/Y');
			     $class=App\classs::where('batch_id',$batch->id)->where('date','>=',$endate)->orderBy('date','ASC')->limit(2)->get();
			     //dd($class);
			    ?>
        <ul class="upcoming_classes_list">
           @foreach($class as $class)
            <li class="">

                <a target="_blank">
                    <div class="block">
                        
                        <div class="date">
                             <i class="fa fa-calendar-o" aria-hidden="true"></i>
                            <span>{{$class->date}}</span>
                        </div>
                        <div class="time">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <span>{{$class->time}} IST</span>
                        </div>                       
                    </div>
                    <?php 
                    if($class->date==date('m/d/Y')){
                    ?>
                    <a href="{{url('zoom')}}/{{$class->id}}" target="_blank" class="join" >                       
                        Join Now
                    </a>
                    <?php 
                    }else{
                        ?>
                        
                        <?php
                    }
                    ?>
                </a>
                
            </li>
            @endforeach
            
        </ul>
        <?php } ?>
        @endforeach
        
    </div>
	
	
	        @endif

	<div class="howtouse"><a href="#"><i class="fa fa-play-circle" aria-hidden="true"></i> How to Use LevelUp LMS</a></div>
	
	
	
	</article>

	<article class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
	@if(!$crs_prcse)
	<div class="box_mycourse">
	<h5>It looks like you are not enrolled for any course</h5>
	<a class="browse_course" href="{{url('/course')}}">Browse All Courses</a>
	</div>
    @else

	<div class="welcome-box"> Welcome back! Here’s wishing you a happy learning today!</div>	
    <div class="" id="single_course_area">
    
	<div >
	 </div>
	 </div>
	@endif
	
	<div class="slide_course_box">
	<h3>Level Up Your Skills</h3>
	
	<div class="item">
            <ul id="content-slider" class="content-slider">
             <?php 
              $course=App\Course::where('published',1)->inRandomOrder()->limit(9)->get();
             ?>
             @foreach($course as $course)
             <?php 
            $batch=App\Batch::where('course_id',$course->id)->first();
           if ($course->reviews->count() > 0) {
            
        //$course_rating = $course->reviews->avg('rating');
          //  $total_ratings = $course->reviews()->where('rating', '!=', "")->get()->count();
        }
             ?>
                <li>
                    
                 <article>
				<div class="single_course">
                   <div class="course_head {{$course->color}} text-center">
                   <a href="#"><img class="img-fluid" src="{{url('/')}}/public/uploads/course_images/{{$course->course_image}}" alt="" /></a></div>
                    
					<div class="course_content">
                   <span class="price">₹19,990</span>                                        
                   <h4><a href="{{url('/')}}/course/{{$course->slug}}">{{$course->title}}</a></h4> 
					<div class="">
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star checked"></span>
					<span class="star_text">5.0 (300 Rating)</span>
					</div>		
                      

                 </div></div>
			</article>   
                    
                    
                    
                    <div class="text-center {{$course->color}}"><img src="{{url('/')}}/public/uploads/course_images/{{$course->course_image}}"></div>
                  <div class="ratting_value">
					<span class="rateing">                    
                   
                    <i aria-hidden="true" class="fa fa-star"></i> 
                             <i aria-hidden="true" class="fa fa-star"></i> 
                             <i aria-hidden="true" class="fa fa-star"></i> 
                             <i aria-hidden="true" class="fa fa-star"></i> 
                            
                             <i aria-hidden="true" class="fa fa-star"></i> 
                                          
					</span>              
					<span class="learner_count">{{$course->title}}</span>
                  </div>
                
				<div class="tile_wishlist">
                    
                     <i class="fa fa-heart-o wishlist{{$course->id}}"  onclick="myFunction()"></i>
<input type="hidden" value="{{$course->id}}" class="courseid{{$course->id}}" />
<input type="hidden" name="productprice_id" class="coursename{{$course->id}}" value="{{@$course->title}}">
<input type="hidden" name="productprice_id" class="price{{$course->id}}" value="{{@$course->price}}">
<input type="hidden" class="session_id" value="{{session()->getId()}}">

<script>
$(document).ready(function(){
    $('.wishlist<?php echo $course->id; ?>').click(function(e){
        var session_id = $('.session_id').val();
        var courseid = $('.courseid<?php echo $course->id; ?>').val();
        var coursename = $('.coursename<?php echo $course->id; ?>').val();
        var price = $('.price<?php echo $course->id; ?>').val();
        $.ajax({
            url: '{{url('wishlist')}}',
            method: "POST",
            data: {_token: '{{ csrf_token() }}',"session_id":session_id, "courseid":courseid,"coursename":coursename,"price":price},
            dataType: "json",
            success: function (response) {
                if(response.status == 'success'){
                Swal.fire(
                  'Added!',
                  'Product Added to Wishlist',
                  'success'
                )
            }else{
                Swal.fire(
                  'Product Already Exists',
                )
            }
                 
            }
            
        });
    });
});
</script>

                </div>
                @if($batch)
				<div class="next_batch">
                 <h5>Next Batch Starting</h5>
                <span>{{ \Carbon\Carbon::parse($batch->batch_date)->isoFormat('MMM Do YYYY')}}</span>
                </div>
                @endif
				<div class="view_more_sec">
                <span><a target="_blank" href="{{url('/')}}/course/{{$course->slug}}">VIEW MORE </a><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
                </div>	
                </li>				
				@endforeach
             
				
                
            </ul>
        </div>
	</div>
	
		
		
	
	
	</article>	
	
	
	</div></div>	
	</section>	
	

	
	
                            
       
     
     
     
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
      
      
      <script>
      $(document).on('click','.course_box',function(){
         
         var course_id=$(this).data('id'); 
          $.ajax({
			url:"{{url('/')}}/ajaxcourselist",
			method:"POST",
			dataType:'json',
			data:{ "_token": "{{ csrf_token() }}",course_id:course_id},
			success:function(data)
			{
				$('#single_course_area').html(data);
			}
		})
      });
  


</script>
   </body>


</html>