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
      <link href="{{url('/')}}/public/user/css/user-classroom.css" rel="stylesheet" />  
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
      <meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
   <style type="text/css">
    /*rating*/
.rating {
      float:left;
    }

    /* :not(:checked) is a filter, so that browsers that don’t support :checked don’t 
      follow these rules. Every browser that supports :checked also supports :not(), so
      it doesn’t make the test unnecessarily selective */
    .rating:not(:checked) > input {
        position:absolute;
       /* top:-9999px;*/
        clip:rect(0,0,0,0);
    }

    .rating:not(:checked) > label {
        float:right;
        width:1em;
        /* padding:0 .1em; */
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:220%;
        /* line-height:1.2; */
        color:#ddd;
    }

    .rating:not(:checked) > label:before {
        content: '★ ';
    }

    .rating > input:checked ~ label {
        color: #ff8f17;
        
    }

    .rating:not(:checked) > label:hover,
    .rating:not(:checked) > label:hover ~ label {
        color: #ff8f17;
        
    }

    .rating > input:checked + label:hover,
    .rating > input:checked + label:hover ~ label,
    .rating > input:checked ~ label:hover,
    .rating > input:checked ~ label:hover ~ label,
    .rating > label:hover ~ input:checked ~ label {
        color: #ff8f17;
        
    }

    .rating > label:active {
        position:relative;
        top:2px;
        left:2px;
    }



</style>
   </head>
   <body>
     <section>
      <!-- banner bg main start -->
      <div class="banner_bg_main">   
   
   <?php 
   $course=App\Course::where('id',$test->course_id)->first();
   //dd($course);
   ?>
   
   <section class="breadcrumb_classroom">
	<div class="container-fluid">
		<div class="breadcrumb_classroom_div">			
			<p><a href="{{url('/')}}">Home</a> / <a href="{{url('/')}}/course_learning/{{$course->slug}}">My Classroom</a> / {{$course->title}}</p>
		</div>
		</div>
	</section>               
                                 						<?php 
    	$lessons=App\Lesson::where('id',$test->lesson_id)->get();
    	//dd($lessons);
    	?>
     <section class="classroom-section">
 <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="#"> {{Str::limit($course->title,20)}}</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">                
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav  ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item">
                    <a class="nav-link" id="navbarDropdown" href="#" role="button" title="How to Use LevelUp LMS"><i class="fa fa-play-circle" aria-hidden="true"></i></a>                    
                </li>
				<li class="nav-item">
                    <a class="nav-link" id="navbarDropdown" href="#" role="button" title="Help"><i class="fa fa-phone-square" aria-hidden="true"></i></a>                    
                </li>
            </ul>
        </nav>

		<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Course Content
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse show" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                               
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <!--<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Installation Guides
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="#">MySQL and Talend OpenStudio Installation Guide</a>                                           
                                        </nav>
                                    </div>-->
                                      <?php 
			     //print_r($course->id);
			    $lessons=App\Lesson::where('course_id',$course->id)->where('published',1)->orderBy('position','ASC')->get();
			     $i=1;
			     
			     ?>
			      @foreach($lessons as $lessons)
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError{{$i}}" aria-expanded="false" aria-controls="pagesCollapseError{{$i}}">
                                         <div class="sb-nav-link-icon"><img src="{{ asset('images/module.png')}}"></div>
                                         {{$lessons->title}}
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError{{$i}}" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <?php 
    		    
                				$lessonsmedia=App\Lessons_media::where('lesson_id',$lessons->id)->get();
                			
                				?>
                				
                                        <nav class="sb-sidenav-menu-nested nav">
                                            @foreach($lessonsmedia as $lessonsmedia)
                                            	@if($lessonsmedia->name=='youtube')
                                            <a class="nav-link playcolor" href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}"><div class="sb-nav-link-icon">
                                                <i class="fa fa-play-circle" aria-hidden="true"></i>
                                            </div>Watch Video</a>
                                            @endif
                                            	@if($lessonsmedia->name=='add_pdf')
                                            <a class="nav-link downloadcolor" href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}"><div class="sb-nav-link-icon">
                                                <i class="fa fa-folder" aria-hidden="true"></i>
                                            </div>Download PDF</a>
                                            @endif	
                                            	@if($lessonsmedia->name=='downloadable_files')
                                            <a class="nav-link" href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}"><div class="sb-nav-link-icon">
                                                <i class="fa fa-folder" aria-hidden="true"></i>
                                            </div>Download PDF</a>
                                            @endif
                                            	@if($lessonsmedia->name=='add_audio')
                                            <a class="nav-link" href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}"><div class="sb-nav-link-icon">
                                                <i class="fa fa-play-circle" aria-hidden="true"></i>
                                            </div>Audio</a>
                                            @endif	
                                            
                                            	@if($lessonsmedia->name=='embed')
                                            	            			@if($lessonsmedia->url)

                                            <a class="nav-link" href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}"><div class="sb-nav-link-icon">
                                                <i class="fa fa-play-circle" aria-hidden="true"></i>
                                            </div>Video</a>
                                            @endif
                                            @endif
                                       @endforeach  
                                        	<?php 
    	$test1=App\Test::where('lesson_id',$lessons->id)->where('course_id',$course->id)->get();
    	?>
    
        	@foreach($test1 as $test)
        	<a class="nav-link quizzdcolor" href="{{url('/')}}/showquizz/{{$course->id}}"><div class="sb-nav-link-icon">
                                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                                            </div>Quizz</a>
        		@endforeach
		    	
		    	
		    	<?php 
    	$assignment=App\Assignment::where('lesson_id',$lessons->id)->where('course_id',$course->id)->get();
    	?>
    
        	@foreach($assignment as $assgn)
    <a class="nav-link assignment" href="{{url('/')}}/classroom/assignment/{{$course->id}}/{{$lessons->id}}"><div class="sb-nav-link-icon">
                                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                                            </div>Assignment</a>
                                            @endforeach
                                            
                                            
                                               	<?php $livelesson=App\Lessons_video_media::where('lesson_id',$lessons->id)->get(); ?>
            		    				@foreach($livelesson as $livelesson)

            		@if($livelesson->type=='video')
            		
            		  <a class="nav-link assignment" href="{{url('/live_lesson/')}}/{{$livelesson->id}}/{{$course->slug}}"><div class="sb-nav-link-icon">
                                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                                            </div>{{$livelesson->video_title}}</a>
                                         
                                      
            		@endif
            	
            	
            		
            		@endforeach
                                    
                                            
                                            
                                        </nav>
                                    
                                    </div>
                                  <?php $i++;?>  
                       @endforeach          
                       
                                              <?php 
                        $proj=App\Project::where('course_id',$course->id)->first();
                        ?>
                        @if($proj)
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        <div class="sb-nav-link-icon"><img src="{{ asset('images/project.png')}}"></div> Project work
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{url('/classroom/project/')}}/{{$course->id}}">{{$proj->title}}</a>                                           
                                        </nav>
                                    </div>
                       
                     	@endif 
                    
                                </nav>
                                
                            </div>
                            
                            
                            
                           
                           
                        </div>
                    </div>
                   
                </nav>
            </div>
            
            
             <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Introduction to AWS / Class 01 Recording</li>
                        </ol>
						
					
								<div class="row">
                            <div class="col-xl-12 col-md-12">
                               
						    	<div id="single_question_area"></div>
							   
							
						    	</div>                 
                          </div>
                          
                          
                          
                          
                          
                          
                          
                          
							<!----------------->
							
							
							
							
							
							
							
							 <!----------------------------------------------------------->
            
            
@if(Session::has('flash_success'))
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                  {{ Session::get('flash_success') }}
                  </div>
              @endif
              @if(Session::has('flash_error'))
                  <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                  {{ Session::get('flash_error') }}
                  </div>
              @endif
  <!--<form class="floating-labels" method="post" action="{{url('/')}}/coursereview" enctype="multipart/form-data"><br>
              {{ csrf_field()}}
	  
  <input type="hidden" name="courseid" id="productid" value="1">

  <div class="rating pl-2" id="btn-writereview">
   
      <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Meh">5 stars</label>
      <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Kinda bad">4 stars</label>
      <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Kinda bad">3 stars</label>
      <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Sucks big tim">2 stars</label>
      <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
    </div>
  </div>


          
              <div class="form-group row" >
        
        <div class="col-sm-12 message-box pt-3">
          <label class="control-label " for="username">Comments</label>
           <textarea placeholder="Comments" cols="10" name="comments" rows="2" class="form-control"></textarea>
        </div>
          <div class="col-sm-12 pt-3">
           
       </div>
         
       <div class="col-sm-12 message-box mt-4">
       <input type="submit" class="review-btn" style="margin-top: 0!important;" value="Submit" >
     </div>

      </div>
  </form>
            
   -->
            
            
            
            
            <!----------------------------------------------------------->
    
							
							
							
							
							
								
                    </div>
                </main>
                
            </div>
        </div>	
	 </section>
     
   
   
   
   
 
     
   <div class="clearfix"></div>
	<a id="button"></a>    
              
                            
     
    

                 
                           
      
      

      
      
    
      <!-- Javascript files-->
      <script src="{{url('/')}}/public/js/jquery.min.js"></script>     
      <script src="{{url('/')}}/public/js/bootstrap.bundle.min.js"></script>
      
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	  <script src="{{url('/')}}/public/user/js/scripts.js"></script>    
     
     
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

$(document).ready(function(){
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 
	var exam_id = "<?php echo $test->id;?>";
	load_question();
//	alert(exam_id);
	function load_question(question_id = '')
	{
		$.ajax({
			url:"{{url('/')}}/user_ajax_action",
			method:"get",
			  dataType:'json',
			data:{test_id:exam_id, question_id:question_id, page:'view_exam', action:'load_question'},
			success:function(data)
			{
				$('#single_question_area').html(data);
			}
		})
	}
	
      $(document).on('click', '.next', function(){
		var question_id = $(this).attr('id');
	//	alert(question_id);
		load_question(question_id);
	});

	$(document).on('click', '.previous', function(){
		var question_id = $(this).attr('id');
		load_question(question_id);
	});
      
 $(document).on('click', '.answer_option', function(){
		var question_id = $(this).data('question_id');
//alert(question_id);
		var answer_option = $(this).data('id');

		$.ajax({
			url:"{{url('/')}}/user_ajax_action",
			method:"get",
			data:{question_id:question_id, answer_option:answer_option, exam_id:exam_id, page:'view_exam', action:'answer'},
			success:function(data)
			{

			}
		})
	});
//-----------------test result---------


 $(document).on('click', '.test-complete', function(){
	

		$.ajax({
			url:"{{url('/')}}/user_ajax_action",
			method:"get",
		    dataType: 'json',
            data:{exam_id:exam_id, page:'view_exam', action:'test_result'},
		
			 success:function(response){
              if(response.success){
                  //alert(response.message) //Message come from controller
              
                  	Swal.fire({
                title: "Wow!",
                text: "Quizz completed successfully! Please check your dashboard for the score! ",
                type: "success"
            }).then(function() {
                window.location = '{{url('/')}}/quizz_result/' + exam_id;
            });
                  
              }else{
                  alert("Error")
              }
           },
           error:function(error){
              console.log(error)
           }
			
			
			  
		})
	});
});
	
</script>
   </body>


</html>