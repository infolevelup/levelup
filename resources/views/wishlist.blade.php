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
			<h2>Wishlist</h2>
			<p><a href="{{url('/')}}">Home</a> / <a href="{{url('/wishlist')}}">Wishlist</a></p>
		</div>
		</div>
	</section>


	<section class="u-dashboard">
	<div class="container">
	<div class="row">
	
     @include('layouts.user_sidemenu')

	<article class="col-lg-9 col-md-9 col-sm-12 col-xs-12">	
	@if($wish->count()>0)
	@foreach($wish as $wish)			
	
	<div class="order_list">	
	<article class="row">
	<div class="col-lg-7 col-md-7 col-sm-8 col-xs-8 course_name_date">
       <h2>{{$wish->coursename}}</h2>
       <span>Date: {{date("d M Y", strtotime($wish->created_at))}}</span>
      </div>
	
	<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 course_id_price text-right">
	<button type="submit" class="certificate-btn"><a href="{{url('/')}}/deleteItemWishlist/{{$wish->id}}"><i class="fa fa-heart"></i></a></button>
 
	 </div>
	 </article>
	</div>
	@endforeach
	@else
	<div class="order_list">	
	<article class="row">
	<div class="col-lg-7 col-md-7 col-sm-8 col-xs-8 course_name_date">
	    
	    <p>No Wishlist</p>
	    </div>
	 </article>
	</div> 
	@endif
	
	
	

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