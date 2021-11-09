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
                                            <a class="nav-link" href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}"><div class="sb-nav-link-icon">
                                                <i class="fa fa-play-circle" aria-hidden="true"></i>
                                            </div>Watch Video</a>
                                            @endif
                                            	@if($lessonsmedia->name=='add_pdf')
                                            <a class="nav-link" href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}"><div class="sb-nav-link-icon">
                                                <i class="fa fa-play-circle" aria-hidden="true"></i>
                                            </div>Download Pdf</a>
                                            @endif	
                                            	@if($lessonsmedia->name=='downloadable_files')
                                            <a class="nav-link" href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}"><div class="sb-nav-link-icon">
                                                <i class="fa fa-play-circle" aria-hidden="true"></i>
                                            </div>Download Pdf</a>
                                            @endif
                                            	@if($lessonsmedia->name=='add_audio')
                                            <a class="nav-link" href="{{url('/')}}/lesson/{{$course->id}}/{{$lessonsmedia->id}}/{{$lessons->slug}}"><div class="sb-nav-link-icon">
                                                <i class="fa fa-play-circle" aria-hidden="true"></i>
                                            </div>Audio</a>
                                            @endif	
                                       @endforeach  
                                  
                       
                           						<?php 
    	$test=App\Test::where('lesson_id',$lessons->id)->get();
    	?>
    
        	@foreach($test as $test)
        	<a class="nav-link" href="{{url('/')}}/showquizz/{{$course->id}}"><div class="sb-nav-link-icon">
                                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                                            </div>Quizz</a>
        		@endforeach
		    	
		    	
		    	<?php 
    	$assignment=App\Assignment::where('lesson_id',$lessons->id)->where('course_id',$course->id)->get();
    	?>
    
        	@foreach($assignment as $assgn)
    <a class="nav-link" href="{{url('/')}}/classroom/assignment/{{$course->id}}/{{$lessons->id}}"><div class="sb-nav-link-icon">
                                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                                            </div>Assignment</a>
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
            <?php 
            $lesson=App\Lesson::where('id',$media->lesson_id)->first();
            ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">{{$lesson->title}}</li>
                        </ol>
                        <div class="row">
                            
                            <div class="col-xl-12 col-md-12">
                                <!----------------video-------------------------->
                            	@if($media->type=='youtube')
                                							    	<?php 
                                $url= $lessonmedia->url;
                                
                                parse_str( parse_url( $url, PHP_URL_QUERY ), $youtube_id_v ); 
                                //echo $youtube_id_v['v'] . "\n"; 
                                
                                ?> 
                                								
							
                              
							<iframe width="100%" height="400" src="https://www.youtube.com/embed/<?php echo $youtube_id_v['v'];?>" frameborder="0" allowfullscreen></iframe>	
                            	@endif
                            	
                            	
                            		@if($media->type=='video')
                                							    
                                								
							
                              <iframe width="100%" height="400" src="{{$media->video_link}}" title="YouTube video player"
  						frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  			
                            	@endif
                        
                                                </div>
                            
                            
                            
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                  <?php 
                                $test=App\Test::where('lesson_id',81)->where('course_id',14)->first();
                                //dd($tset);
                                ?>
                                @if($test)
                                <button class="start" data-test_id="{{$test->id}}" data-course_id='14'>start test</button>
                             
                                @endif
						
							
                            </div>                 
                        </div>
                        
                        
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