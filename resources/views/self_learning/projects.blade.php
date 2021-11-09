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
   </head>
   <body>
     
     
     
     
     
     
     
     
     <section>
      <!-- banner bg main start -->
      <div class="banner_bg_main">   
         
    <section class="breadcrumb_classroom">
	<div class="container-fluid">
		<div class="breadcrumb_classroom_div">			
			<p><a href="{{url('/')}}">Home</a> / <a href="{{url('/')}}/course_learning/{{$course->slug}}">My Classroom</a> / {{$course->title}}</p>
		</div>
		</div>
	</section>               
       
     <section class="classroom-section">
	 <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="#">  {{Str::limit($course->title,20)}}</a>
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
    	$test=App\Test::where('lesson_id',$lessons->id)->get();
    	?>
    
        	@foreach($test as $test)
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
                            <li class="breadcrumb-item active">{{$course->title}}</li>
                        </ol>
                        
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
                 @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
              
              
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
 Submit Your Project work
</button>


              
                        <div class="row">
                            
                            <div class="col-xl-12 col-md-12">
						
						@if($data)
						
						<?php  $decoded = json_decode($data->pdf, true); ?>

                                      @foreach($decoded as $pdf)

						 <embed src="{{ URL::to('/') }}/public/uploads/{{$pdf}}"
                                    style="width:1000px; height:700px;"
                                    frameborder="0"><br>
                                    @endforeach
                                    
                                    
                                    
						
						
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
         <form action="{{ route('projectfile.upload.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Upload Project work</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <input type="hidden" name="course_id" value="{{$course->id}}">
                     <input type="hidden" name="project_id" value="{{$data->id}}">
            <div class="form-group">
            <label for="exampleFormControlFile1">Upload file</label>
            <input type="file" class="form-control-file" name="file" id="exampleFormControlFile1">
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
					
						
						@endif
						
						        </div>
                            
                            
                            
                        </div>
                        
                        
                    </div>
                </main>
                
            </div>
        </div>	
	 </section>
     
  
     
        

      
      
    
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
    
 
            $(document).on('click', '.start', function(){
        		var test_id = $(this).data('test_id');
        //alert(test_id);
        	var course_id = $(this).data('course_id');
        		$.ajax({
        			url:"{{url('/')}}/user_ajax_action",
        			method:"get",
        			data:{test_id:test_id, action:'view_exam'},
        			success:function(data)
        			{
                    	Swal.fire({
                            title: "Wow!",
                            text: "Your Quizz will start Now",
                            type: "success"
                        }).then(function() {
                            window.location = '{{url('/')}}/showquizz/' + course_id;
                        });
        			}
        		})
	});
	
      });
      </script>
   </body>


</html>