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
   
   
   
   <section class="breadcrumb_classroom">
	<div class="container-fluid">
		<div class="breadcrumb_classroom_div">			
			<p><a href="#">Home</a> / <a href="dashboard.html">My Classroom</a> / AWS Certification Training - Solutions Architect</p>
		</div>
		</div>
	</section>               
       
     <section class="classroom-section">

	<h4>your score is {{$test_result->test_result}}</h4>
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
      
    
   </body>


</html>