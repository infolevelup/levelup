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

	
	<article class="col-lg-9 col-md-9 col-sm-12">        
           
			<article class="enrolled-course">
			<h2>My Quiz Attempts</h2>	
			<div class="dashboard-quiz-attempt-history dashboard-table-wrapper dashboard-table-responsive">
		<div class="dashboard-table-container">
		 @if(count($order)>0)
				    
			<table class="dashboard-table">
				<thead>
				<tr>
					<th class="col-course-info">Course Info</th>
					<th class="col-correct-answer">Correct Answer</th>
					<th class="col-incorrect-answer">Incorrect Answer</th>
					<th class="col-earned-marks">Total Marks</th>
				</tr>
				</thead>
				<tbody>
				   
				    @foreach($order as $data)
				    <?php 
				    $test=App\Test::where('id',$data->test_id)->first();
				    $course=App\Course::where('id',$test->course_id)->first();
				    $Question=App\Question::where('test_id',$test->id)->get();
				    $wordCount = count($Question);
				    $sumof=App\Question::where('test_id',$test->id)->sum('score');
				    $test_result=App\TestsResultsAnswer::where('tests_result_id',$data->id)->where('correct','0')->get();
				    $test_result1=App\TestsResultsAnswer::where('tests_result_id',$data->id)->where('correct','1')->get();
				    $testwrong=count($test_result);
				        $testright=count($test_result1);
				    ?>
					<tr>
						<td>
							<h3 class="course-title">
								<a href="{{url('/')}}" target="_blank">{{$course->title}}</a>
							</h3>
							<div class="dashboard-quiz-attempt-metas">								
								<div class="meta-item quiz-attempt-question-count">
									<span class="meta-name">Question: </span>
									<span class="meta-value">{{$wordCount}}</span>
								</div>
								<div class="meta-item quiz-attempt-total-marks">
									<span class="meta-name">Total Marks: </span>
									<span class="meta-value">{{$sumof}}</span>
								</div>
							</div>
						</td>
												<td>
							<div class="heading col-heading-mobile">Correct Answer</div>
									{{$testright}}					</td>
						<td>
							<div class="heading col-heading-mobile">Incorrect Answer:</div>
							{{$testwrong}}					</td>
						<td>
							<div class="heading col-heading-mobile">Earned Marks:</div>
							{{$data->test_result}}						</td>
						
											</tr>
													
					@endforeach									
														
														
														
														
														
														
														
														
														
														
								</tbody>
			</table>
				@else
					<p>No Quizz</p>
				
								@endif

		</div>
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