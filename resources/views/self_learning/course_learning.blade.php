
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
			<h2>{{$course->title}}</h2>
			<p><a href="{{url('/')}}">Home</a> / <a href="{{url('/dashboard')}}">My Classroom</a> / {{$course->title}}</p>
		</div>
		</div>
	</section>


	<section class="u-dashboard">
	<div class="container">
	<div class="row">
	
	<article class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	 <div class="curriculumleftnav">
       <div class="row">
        <div class="col-lg-3 col-md-3"> <!-- required for floating -->
          <!-- Nav tabs -->
          <ul class="nav nav-tabs tabs-left sideways">
            <li><a href="#getting" data-toggle="tab" class="active"><div class="icon"><img src="{{ asset('images/flag.png')}}"></div> Getting Started</a></li>
            <li><a href="#course" data-toggle="tab"><div class="icon"><img src="{{ asset('images/content.png')}}"></div> Course Content</a></li>
            <li><div class="howtouse"><a href="#"><i class="fa fa-play-circle" aria-hidden="true"></i> How to Use LevelUp LMS</a></div></li>
          </ul>
        </div>

        <div class="col-lg-9 col-md-9  nopadding">
          
		  <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active" id="getting">
			<h2>Let's Begin to Learn!</h2>
			<p>{!!$course->description!!}</p>
			</div>
            
            
			<div class="tab-pane" id="course">
			@if($course->type=='self peaced')
			
			<div>
			    
			 
			    <?php 
			     //print_r($course->id);
			    $lessons=App\Lesson::where('course_id',$course->id)->where('published',1)->orderBy('position','ASC')->get();
			     $i=1;
			     
			     ?>
			      @foreach($lessons as $lessons)
			     
    			<ul class="tabs">
    			    
    			    
    				<li>
    				  <input type="radio" <?php if($i==1){ echo' checked'; }?> name="tabs" id="tab{{$i}}">
    				  <label for="tab{{$i}}">Lesson {{$i}}</label>
    				 
    				  
    				  <div id="tab-body1" class="tab-body animated fadeIn">
    					<h2>{{$lessons->title}}</h2>
    					<p>{!!$lessons->short_text!!}</p>
    				
    		    	<?php 
    		    
    				$lessonsmedia=App\Lessons_media::where('lesson_id',$lessons->id)->get();
    			
    				?>
    				@foreach($lessonsmedia as $lessonsmedia)
    				
    				
            <?php 
            $viewed=App\Chapter_students::where('course_id',$course->id)->where('lesson_id',$lessons->id)
            ->where('lesson_media_id',$lessonsmedia->id)->where('user_id',Auth::user()->id)->first();
        
            ?>
            			<!----------------video--------------------------------->
            			@if($lessonsmedia->name=='youtube')
            			<article class="course-cont-title playcolor">
            		<div class="icon-title"><i class="fa fa-play-circle" aria-hidden="true"></i> <span class="course-title">
            		<a href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}">Watch Video</a></span></div>
            		<div class="course-view"><a href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}">
            		    @if($viewed)
            		    viewed
            		    @else
            		    Not Viewed
            		    @endif
            		    </a></div>
            		<p></p>
            		</article>
            		@endif
            		
            		
            		
            			@if($lessonsmedia->name=='embed')
            			@if($lessonsmedia->url)
            			<article class="course-cont-title playcolor">
            		<div class="icon-title"><i class="fa fa-play-circle" aria-hidden="true"></i> <span class="course-title">
            		<a href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}">Watch Video</a></span></div>
            		<div class="course-view"><a href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}">@if($viewed)
            		    viewed
            		    @else
            		    Not Viewed
            		    @endif</a></div>
            		
            		</article>
            		@endif
            		@endif
            		
            			<!-------------------------document---------------------->
    				@if($lessonsmedia->name=='add_pdf')
    					<article class="course-cont-title downloadcolor">
    					<div class="icon-title"><i class="fa fa-folder" aria-hidden="true"></i> <span class="course-title"><a href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}">Download PDF</a></span></div>
    					<div class="course-view"><a href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}">
    					    
    					     @if($viewed)
            		    viewed
            		    @else
            		    Not Viewed
            		    @endif</a></div>
            		<p>{!!$lessons->pdf_text!!}</p>
    					</article>	
    					@endif
    			<!--------------------------------------quiz------------------------->
    			
    				<!-------------------------document---------------------->
    				@if($lessonsmedia->name=='downloadable_files')
    					<article class="course-cont-title downloadcolor">
    					<div class="icon-title"><i class="fa fa-folder" aria-hidden="true"></i> <span class="course-title"><a href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}">Download PDF</a></span></div>
    					<div class="course-view"><a href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}">@if($viewed)
            		    viewed
            		    @else
            		    Not Viewed
            		    @endif</a></div>
    					<p>{!!$lessons->download_text!!}</p>
    					</article>	
    					@endif
    			<!--------------------------------------quiz------------------------->
    
    
    		<!------------------------------>
    				@endforeach
    					
    						<?php 
    	$test=App\Test::where('lesson_id',$lessons->id)->get();
    	?>
    		
            <?php 
            $viewedd=App\Chapter_students::where('course_id',$course->id)->where('lesson_id',$lessons->id)
            ->where('type','quizz')->where('user_id',Auth::user()->id)->first();
        
            ?>
        	@foreach($test as $test)
    		<article class="course-cont-title quizzdcolor">
			     <div class="icon-title"><a href="{{url('/')}}/showquizz/{{$course->id}}"><i class="fa fa-question-circle" aria-hidden="true"></i> <span class="course-title">Quiz</span></a></div>
		    	<div class="course-view"><a href="{{url('/')}}/showquizz/{{$course->id}}">@if($viewedd)
            		    viewed
            		    @else
            		    Not Viewed
            		    @endif
            		    </a></div>
			    <p>{!!$test->description!!}</p>
		    </article>
		    	@endforeach
		    	
		    	
		    	<?php 
    	$assignment=App\Assignment::where('lesson_id',$lessons->id)->where('course_id',$course->id)->get();
    	?>
    <?php 
            $view=App\Chapter_students::where('course_id',$course->id)->where('lesson_id',$lessons->id)
            ->where('type','assignment')->where('user_id',Auth::user()->id)->first();
        
            ?>
        	@foreach($assignment as $assgn)
    		<article class="course-cont-title assignment">
			     <div class="icon-title"><a href="{{url('/')}}/classroom/assignment/{{$course->id}}/{{$lessons->id}}"><i class="fa fa-question-circle" aria-hidden="true"></i> 
			     <span class="course-title">Assignment</span></a></div>
		    	<div class="course-view"><a href="{{url('/')}}/classroom/assignment/{{$course->id}}/{{$lessons->id}}">
		    	    @if($view)
            		    viewed
            		    @else
            		    Not Viewed
            		    @endif
		    	</a></div>
			    <p>{!!$assgn->title!!}</p>
		    </article>
		    @endforeach
    				  </div>
    				</li>
    				
    				
    				
                    <!--<li>
                      <input type="radio" name="tabs" id="tab2">
                      <label for="tab2">Tab 2</label>
                      <div id="tab-body2" class="tab-body animated fadeIn">
                       <h2>Introduction to Data Warehouse</h2>
            		   <p>Discussing about the basic concepts of a Data Warehouse and why it is needed. Difference between an operational system and an analytical system, Datamarts. Approaches to build a Data Warehouse.</p>
            			<article class="course-cont-title">
            			<div class="icon-title"><i class="fa fa-folder" aria-hidden="true"></i> <span class="course-title">
            			<a href="classroom.html">MySQL and Talend OpenStudio Installation Guide</a></span></div>
            			<div class="course-view"><a href="classroom.html">Viewed</a></div>
            			<p>In this video, you will learn the basic concepts of Dimension Tables and Facts in Data Warehousing</p>
            			</article>
            			
            			<article class="course-cont-title">
            			<div class="icon-title"><i class="fa fa-play-circle" aria-hidden="true"></i> <span class="course-title">
            			<a href="classroom.html">MySQL and Talend OpenStudio Installation Guide</a></span></div>
            			<div class="course-view"><a href="classroom.html">Not Viewed</a></div>
            			<p>In this video, you will learn the basic concepts of Dimension Tables and Facts in Data Warehousing</p>
            			</article>
            			
            			<article class="course-cont-title">
            			<div class="icon-title"><i class="fa fa-question-circle" aria-hidden="true"></i> <span class="course-title">Quiz</span></div>
            			<div class="course-view"><a href="#">14/20</a></div>
            			<p>In this video, you will learn the basic concepts of Dimension Tables and Facts in Data Warehousing</p>
            			</article>
            			
            		  </div>
                    </li>-->
                    <!--<li>
                      <input type="radio" name="tabs" id="tab31">
                      <label for="tab31">project</label>
                      <div id="tab-body31" class="tab-body animated fadeIn">
                        
                        <?php 
                        $proj=App\Project::where('course_id',$course->id)->first();
                        ?>
                        @if($proj)
                         
                        <article class="course-cont-title">
            			<div class="icon-title"><i class="fa fa-folder" aria-hidden="true"></i> <span class="course-title">
            			<a href="{{url('/classroom/project/')}}/{{$course->id}}">Project Work</a></span></div>
            			<div class="course-view"><a href="#">Viewed</a></div>
            			<p>{{$proj->title}}</p>
            			</article>
            			
            			@endif
            			
            			<?php $crs_stud=App\Course_student::where('course_id',$course->id)->where('user_id',Auth::user()->id)->first();?>
            			  @if($crs_stud->grade!='')
            			  @if($crs_stud->grade=='A Grade'||$crs_stud->grade=='B Grade'|| $crs_stud->grade=='C Grade')
            			  <article class="course-cont-title">
            			<div class="icon-title"><i class="fa fa-folder" aria-hidden="true"></i> <span class="course-title">
            			<a href="{{url('/certificate')}}/{{$crs_stud->id}}">Certificate</a></span></div>
            			<div class="course-view"><a href="#">Viewed</a></div>
            			</article>
            			@endif
            		    @endif
                      </div>
                    </li>-->
    		    </ul>
    		    <?php $i++;?>
    		    
    		    @endforeach
	    	</div>


            @else



			<div>
			    
			    <?php 
			     //print_r($course->id);
			    $lessons=App\Lesson::where('course_id',$course->id)->where('published',1)->orderBy('position','ASC')->get();
			     $i=1;
			     
			     ?>
			       @foreach($lessons as $lessons)
			<ul class="tabs">
				<li>
					  <input type="radio" <?php if($i==1){ echo' checked'; }?> name="tabs" id="tab{{$i}}">
    				  <label for="tab{{$i}}">Step {{$i}}</label>
    				 
    				  
    				  <div id="tab-body1" class="tab-body animated fadeIn">
    					<h2>{{$lessons->title}}</h2>
    					<p>{!!$lessons->short_text!!}</p>
    			 
				 
				  	
					
					
					<?php 
    		    
    				$lessonsmedia=App\Lessons_media::where('lesson_id',$lessons->id)->get();
    			
    				?>
    				
    							
           
    				@foreach($lessonsmedia as $lessonsmedia)
    				 <?php 
            $viewed=App\Chapter_students::where('course_id',$course->id)->where('lesson_id',$lessons->id)
            ->where('lesson_media_id',$lessonsmedia->id)->where('user_id',Auth::user()->id)->first();
        //dd($viewed);
            ?>
            			<!----------------video--------------------------------->
            			@if($lessonsmedia->name=='downloadable_files')
            			<article class="course-cont-title">
            		<div class="icon-title"><i class="fa fa-file-powerpoint-o" aria-hidden="true"></i> <span class="course-title">
            		<a href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}">Presentation</a></span></div>
            		<div class="course-view"><a href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}">	    @if($viewed)
            		    viewed
            		    @else
            		    Not Viewed
            		    @endif</a></div>
            		</article>
            		@endif
            		
            			@if($lessonsmedia->name=='add_pdf')
    					<article class="course-cont-title downloadcolor">
    					<div class="icon-title"><i class="fa fa-folder" aria-hidden="true"></i> <span class="course-title"><a href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}">Download PDF</a></span></div>
    					<div class="course-view"><a href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}">
    					    
    					     @if($viewed)
            		    viewed
            		    @else
            		    Not Viewed
            		    @endif</a></div>
            		<p>{!!$lessons->pdf_text!!}</p>
    					</article>	
    					@endif
            		
            			<!----------------video--------------------------------->
            			@if($lessonsmedia->name=='embed')
            			            			@if($lessonsmedia->url)

            			<article class="course-cont-title">
            		<div class="icon-title"><i class="fa fa-play-circle" aria-hidden="true"></i>  <span class="course-title">
            		<a href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}">Watch video</a></span></div>
            		<div class="course-view"><a href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}">  @if($viewed)
            		    viewed
            		    @else
            		    Not Viewed
            		    @endif</a></div>
            		</article>
            		@endif
            		@endif
            		
            		
            		@endforeach
            		
            		
            			<?php $livelesson=App\Lessons_video_media::where('lesson_id',$lessons->id)->get(); ?>
            		    				@foreach($livelesson as $livelesson)

            		@if($livelesson->type=='video')
            			<article class="course-cont-title">
            		<div class="icon-title"><i class="fa fa-play-circle" aria-hidden="true"></i>  <span class="course-title">
            		<a href="{{url('/live_lesson/')}}/{{$livelesson->id}}/{{$course->slug}}">{{$livelesson->video_title}}</a></span></div>
            		<div class="course-view"><a href="{{url('/live_lesson/')}}/{{$livelesson->id}}/{{$course->slug}}">Not Viewed</a></div>
            		<p>{!!$livelesson->video_short_desc!!}</p>
            		</article>
            		@endif
            	
            	
            		
            		@endforeach

<?php 
    	$test=App\Test::where('lesson_id',$lessons->id)->get();
    	?>
     <?php 
            $viewedd=App\Chapter_students::where('course_id',$course->id)->where('lesson_id',$lessons->id)
            ->where('type','quizz')->where('user_id',Auth::user()->id)->first();
        
            ?>
        	@foreach($test as $test)
    		<article class="course-cont-title">
			     <div class="icon-title"><a href="{{url('/')}}/showquizz/{{$course->id}}"><i class="fa fa-question-circle" aria-hidden="true"></i> <span class="course-title">Quiz</span></a></div>
		    	<div class="course-view"><a href="{{url('/')}}/showquizz/{{$course->id}}">@if($viewed)
            		    viewed
            		    @else
            		    Not Viewed
            		    @endif</a></div>
			    <p>{!!$test->description!!}</p>
		    </article>
		    	@endforeach
		    	
		    	
		    	<?php 
    	$assignment=App\Assignment::where('lesson_id',$lessons->id)->where('course_id',$course->id)->get();
    	?>
      <?php 
            $view=App\Chapter_students::where('course_id',$course->id)->where('lesson_id',$lessons->id)
            ->where('type','assignment')->where('user_id',Auth::user()->id)->first();
        
            ?>
        	@foreach($assignment as $assgn)
    		<article class="course-cont-title">
			     <div class="icon-title"><a href="{{url('/')}}/classroom/assignment/{{$course->id}}/{{$lessons->id}}"><i class="fa fa-question-circle" aria-hidden="true"></i> 
			     <span class="course-title">Assignment</span></a></div>
		    	<div class="course-view"><a href="{{url('/')}}/classroom/assignment/{{$course->id}}/{{$lessons->id}}">@if($viewed)
            		    viewed
            		    @else
            		    Not Viewed
            		    @endif</a></div>
			    <p>{!!$assgn->title!!}</p>
		    </article>
		    	@endforeach
    			
            	
					
				  </div>
				</li>
       
       
       
       
    	</ul>
		
		<?php $i++;?>
    		    
    		    @endforeach
	    
			</div>

@endif



			<div style="clear:both"></div>
			
			
			</div>            
          </div>
        </div>
		</div>
		
		
		
        <div class="clearfix"></div>

      </div>

      
	
	
	</article>
	
	<!--<article class="col-lg-3 col-md-4 col-sm-12 hidden-xs">	
	<div class="howtouse"><a href="#"><i class="fa fa-play-circle" aria-hidden="true"></i> How to Use LevelUp LMS</a></div>
	
	</article>-->

		
	
	
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
      
   </body>


</html>