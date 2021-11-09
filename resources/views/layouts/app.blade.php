<!DOCTYPE html>
<html lang="en">
   
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>@yield('title') | Welcome to Level Up</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->     
      

      
    <!-- Owl Carousel -->
	<link rel="stylesheet" href="{{ asset('plugins/owl/owl.carousel.css')}}">
	<link rel="stylesheet" href="{{ asset('plugins/owl/owl.theme.css')}}">
	<!-- Flexslider -->
	<link rel="stylesheet" href="{{ asset('plugins/flex-slider/flexslider.css')}}">
	<!-- Flexslider -->
	<link rel="stylesheet" href="{{ asset('plugins/cd-hero/cd-hero.css')}}">
     
     <!-- AOS ANIMATION-->
	<link rel="stylesheet" href="{{ asset('css/aos.css')}}">
     
     
	<!-- toggle tab css-->
    <link rel="stylesheet" href="{{ asset('css/w3.css')}}">
      
      
      
      
      <link rel="stylesheet" type="text/css" href="{{ asset('css/css/font-awesome.min.css')}}">
      
      <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css')}}">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">
	  <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css')}}">
      <!-- Responsive-->
      <link rel="stylesheet" href="{{ asset('css/responsive.css')}}">
      <!-- fevicon -->
      <link rel="icon" href="{{ asset('images/fevicon.html')}}" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.min.css')}}">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="../../netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- fonts -->
      <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&amp;display=swap" rel="stylesheet">
      <!-- font awesome -->
      <link rel="stylesheet" type="text/css" href="../../stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      
      <!--  -->
            @stack('before-styles')

      <!-- owl stylesheets -->
      <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&amp;display=swap&amp;subset=latin-ext" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css')}}">
      <link rel="stylesoeet" href="{{ asset('css/owl.theme.default.min.html')}}">
      <link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css')}}" media="screen">
     
      
      <!-- Testimonial Sections -->
  
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
            @stack('after-styles')
  
   </head>
   <body>
     <section>
      <!-- banner bg main start -->
      <div class="banner_bg_main">
         <!-- header top section start -->
         <div class="container-fluid container_fluid_padding_css">
           	
           	<div class="row">
           		<div class="col-12 col-md-7 col-lg-7">
           			<div class="header_section_top">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="custom_menu">
                       	<p><span class="offer_header_span">Hurry Now! 15% Discount</span> on All Courses. Offer ends in <span id="demo"></span></p>
                     </div>
                  </div>
               </div>
            </div>
           		</div>
           		<div class="col-12 col-md-5 col-lg-5">
           			<div class="top_header_right_div">
           				<ul>
                          
                           <li class="top_header_right_li_1"><a href="{{url('/corporate-training')}}">Corporate Trainings</a></li>
                           <li class="top_header_right_li_2"><a href="{{url('/')}}/teacher/register">Teach on Level Up</a></li>
                          
                        </ul>
           			</div>
           		</div>
           	</div>
            
         </div>
         <!-- header top section start -->
         <!-- logo section start -->
<!--
         <div class="logo_section">
            <div class="container">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="logo"><a href="index-2.html"><img src="images/logo.png"></a></div>
                  </div>
               </div>
            </div>
         </div>
-->
         <!-- logo section end -->
         <!-- header section start -->
         <div class="header_section">
            <div class="container">
               <div class="containt_main">
                 <div class="logo_header_div">
                 	<a href="{{url('/')}}"><img src="{{ asset('images/logo.png')}}"></a>
                 </div>
                 
                 <div id="menu_area">
		<div class="container">
        <div class="row">
            <nav class="navbar navbar-light navbar-expand-lg mainmenu">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">  
                        
                        <li class="dropdown">
							<div class="menu-icon"> <img src="{{ asset('images/Categories_icon.png')}}"></div>
                            <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Categories</a>
                            <?php  $category=App\Category::where('status',1)->get(); ?>
                            
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                             @foreach($category as $course1)
							<?php  $course=App\Course::where('category_id',$course1->id)->where('published',1)->get();?>
                             @if(!(App\Course::where('category_id',$course1->id)->where('published',1)->exists()))
                             
                            <li><a href="{{url('/')}}/category/{{$course1->slug}}">{{$course1->name}}</a></li>
                            @else
                            <li class="dropdown">
                                <a class="dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="{{url('/')}}/category/{{$course1->slug}}">
                                    {{$course1->name}}</a>
                                @endif    
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                 @foreach($course as $cou)    
                                <li><a href="{{url('/')}}/course/{{$cou->slug}}">{{$cou->title}}</a></li>
                                @endforeach
                                </ul>
                            </li>
                            @endforeach
                            
                            </ul>
                        </li> 

					
        						
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
                 
                  
                  <div class="main">
                     <!-- Another variation with a button -->
                      <form action="{{url('/')}}/search" method="post" class="form-search" accept-charset="utf-8">
                          @csrf
                     <div class="input-group">
                        <input type="text" name="search" class="form-control " placeholder="Enter a course, category or keyword">
                        <div class="input-group-append">
                           <button class="btn btn-secondary header_search_btn" type="submit">
                           <i class="fa fa-search"></i>
                           </button>
                        </div>
                     </div>
                     </form>
                  </div>
                  
                  <div class="header_box">          
                     <div class="login_menu">
                        <ul>
                           <li class="header_li_right_border"><a href="{{url('labs')}}">
                              
                              <span class="padding_10">Labs</span></a>
                           </li>
                                     @if(empty(Auth::check()))

                           <li><a href="{{url('/')}}/login">
                              
                              <span class="padding_10">Login</span></a>
                           </li>
                            <li class="header_right_sign_up_btn"><a href="{{url('/')}}/register">
                              
                              <span class="padding_10">Sign Up</span></a>
                           </li>
                       
                           @else
                              <li> 
                                      <a href="{{'/logout'}}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();"><span class="padding_10 header_li_right_border">Logout</span></a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>  
                            </li> 
                            <li><a href="{{url('/')}}/dashboard">
                              
                              <span class="padding_10 header_li_right_border">Dashboard</span></a>
                           </li> 
                                                        @endif

                           <!-- <li class="header_right_cart_btn">
                           	<i class="fa fa-shopping-cart"></i>
                           </li> -->
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- header section end -->
         
      
        

    
   
     @yield('content')
     
      
  <div class="whatsapp-btn"><a href="https://web.whatsapp.com/send?phone=+919606182057" target="_blank"><img src="{{asset('images/whatsapp.png')}}"></a></div>    
             <!-- Back to top button -->
<a id="button"></a>    
              
                  <?php
					    $contact=App\Contact::where('id',23)->first();
					 ?>          
     
    <section class="footer_main_section">
	<div class="container">
		<div class="footer_main_div">
			
			<div class="row">
				<div class="col-12">
					<div class="footer_logo_div">
							<a href="#"><img src="{{ asset('images/levelup-footer-logo.png')}}"></a>
						</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-3 col-lg-3">
					<div class="footer_column_1">			
						<div class="footer_address_div">
							<a href=""><i class="fa fa-map-marker"></i>{{$contact->address}} </a>
						</div>
						
						<div class="footer_email_div">
							<a href="mailto:"><i class="fa fa-envelope"></i>{{$contact->email}}</a>
						</div>
						
						<div class="footer_phone_div">
							<a href="tel:"><i class="fa fa-phone"></i> {{$contact->phone}}</a>
						</div>
						
						
						
						
						
					</div>
				</div>
				<div class="col-12 col-md-3 col-lg-3">
					<div class="footer_column_2">
						<div class="footer_quicklinks">
							<p>Quick Links</p>
							<ul>
								<li><a href="{{url('/about-us')}}">About Us</a></li>
								<li><a href="{{url('/testimonial')}}">Testimonial</a></li>
								<li><a href="{{url('/blog')}}">Blog</a></li>
								<li><a href="{{url('/contact-us')}}">Contact Us</a></li>
							</ul>
							
							
							
						</div>
					</div>
				</div>
				
				
				<div class="col-12 col-md-3 col-lg-3">
					<div class="footer_column_2">
						<div class="footer_morelinks">
							<ul>
								<li><a href="{{url('/course')}}">Categories</a></li>
								<li><a href="{{url('/labs')}}">Labs</a></li>
								<li><a href="{{url('corporate-training')}}">Corporate Trainings</a></li>
								<li><a href="{{url('/teacher/register')}}">Teach on Level Up</a></li>
							</ul>
						</div>
					</div>
				</div>
				
				
				
				<div class="col-12 col-md-3 col-lg-3">
					<div class="footer_column_3">
						<div class="footer_social_icons">
							<p>Connect via social media to know more about our facilities and services</p>
						</div>
						
						<div class="footer_social_icons_css">
							<a title="Facebook" href="#" target="_blank">
								<span class="social-icon"><i class="fa fa-facebook"></i></span>
							</a>
							<a title="Twitter" href="#" target="_blank">
								<span class="social-icon"><i class="fa fa-twitter"></i></span>
							</a>
							<a title="Instagram" href="#"   target="_blank">
								<span class="social-icon"><i class="fa fa-instagram"></i></span>
							</a>
							<a title="Linkdin" href="#" target="_blank">
								<span class="social-icon"><i class="fa fa-linkedin"></i></span>
							</a>
							<a title="Linkdin" href="#" target="_blank">
								<span class="social-icon"><i class="fa fa-youtube"></i></span>
							</a>
				
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="bottom_footer_section">
	<div class="container">
		<div class="footer_bottom_main_div">
			<div class="row">
				<div class="col-12 col-md-7 col-lg-7">
					<div class="brew_copyright-info hover_custom_color_2">Copyright <script>document.write(new Date().getFullYear());</script> ©
						<span> <a href="#" class="custom_yellow_copyright_link" > LevelUp Pvt Ltd</a></span>&nbsp; &nbsp;
						<span class="bottom_footer_border"><a href="{{url('/general_pages')}}">Privacy Policy</a></span>&nbsp; &nbsp;
						<span class="bottom_footer_border"><a href="{{url('/general_pages')}}">Terms & Conditions</a></span>
					</div>
				</div>
				<div class="col-12 col-md-5 col-lg-5">
					<div class="telco_credits">
						<a href="http://telcopl.com/" target="_blank">Powered by Telco Communications India Pvt Ltd</a> 
					</div>
				</div>
			</div>
		</div>
	</div>
</section>                                
               
                  
                     
                           
      
      

      
      
    
      <!-- Javascript files-->
      <script src="{{ asset('js/jquery.min.js')}}"></script>
      <script src="{{ asset('js/popper.min.js')}}"></script>
      <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{ asset('js/jquery-3.0.0.min.js')}}"></script>
      <script src="{{ asset('js/plugin.js')}}"></script>
      <!-- sidebar -->
      <script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
      <script src="{{ asset('js/custom.js')}}"></script>
      
      
      
      
<!--      header countdown-->
      
<script>
// Set the date we're counting down to
var countDownDate = new Date("Aug 31, 2021 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "d : " + hours + "hr : "
  + minutes + "m : " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
      
      
 
 <!--       countdown 1-->
      
      
      
  
  
<!--  toggle tab script-->
  
   <script>
function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " w3-red";
}
</script>      
                 
                                                                   
              
        <script>
	   
	   	$('.Count').each(function () {
  var $this = $(this);
  jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
    duration: 10000,
    easing: 'swing',
    step: function () {
      $this.text(Math.ceil(this.Counter));
    }
  });
});
	   </script>              
     
     
     
     
     
     
     
     
     <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
     
<script>
	
$(document).ready(function(){

$('.stories_items').slick({
dots: true,
infinite: true,
speed: 800,
autoplay: true,
autoplaySpeed: 2000,
slidesToShow: 3,
slidesToScroll: 3,
responsive: [
{
breakpoint: 1024,
settings: {
slidesToShow: 3,
slidesToScroll: 3,
infinite: true,
dots: true
}
},
{
breakpoint: 600,
settings: {
slidesToShow: 1,
slidesToScroll: 1
}
},
{
breakpoint: 480,
settings: {
slidesToShow: 1,
slidesToScroll: 1
}
}

]
});
});
</script>
     
     
     
     
<script>
	
	$(document).ready(function(){

$('.course_items').slick({
dots: true,
infinite: true,
speed: 800,
autoplay: true,
autoplaySpeed: 2000,
slidesToShow: 4,
slidesToScroll: 4,
responsive: [
{
breakpoint: 1024,
settings: {
slidesToShow: 4,
slidesToScroll: 4,
infinite: true,
dots: true
}
},
{
breakpoint: 600,
settings: {
slidesToShow: 2,
slidesToScroll: 2
}
},
{
breakpoint: 480,
settings: {
slidesToShow: 1,
slidesToScroll: 1
}
}

]
});
});
	</script>
	
	
	<script>
	
	$(document).ready(function(){

$('.section_6_items').slick({
dots: true,
infinite: true,
speed: 800,
autoplay: true,
autoplaySpeed: 2000,
slidesToShow: 1,
slidesToScroll: 1,
responsive: [
{
breakpoint: 1024,
settings: {
slidesToShow: 1,
slidesToScroll: 1,
infinite: true,
dots: true
}
},
{
breakpoint: 600,
settings: {
slidesToShow: 1,
slidesToScroll: 1
}
},
{
breakpoint: 480,
settings: {
slidesToShow: 1,
slidesToScroll: 1
}
}

]
});
});



$('.first-tab').owlCarousel({
    loop:true,
    margin:20,
	autoplay: true,
	autoplayTimeout:2000,
    smartSpeed: 1000, 	
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})

	</script>
     
     
     
     
     <!-- AOS ANIMATION -->
	<script src="{{ asset('js/popper.min.js')}}"></script>
	<script src="{{ asset('js/active.js')}}"></script>
	<script src="{{ asset('js/aos.js')}}"></script>
<!--	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>-->
	<script>
  		AOS.init();
	</script>
      
      
            @stack('after-scripts')

   </body>


</html>