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
			<h2>Checkout</h2>
			<p><a href="{{url('/')}}">Home </a>/ <a href="{{url('/')}}">Checkout</a></p>
		</div>
		</div>
	</section>


	<section class="u-dashboard">
	<div class="container">
	<div class="row">	
	

	<article class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
	<div class="padding-bottom-3x mb-2">
	    
	    
	    <div class="row">
            
<div class="container">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-9">
            <div class="ibox">
          
                <div class="ibox-title">
                    <span class="pull-right">(<strong>{{$cart_course->count()}}</strong>) items</span>
                    <h5>Items in your cart</h5>
                </div>
              
                  @if(count($courses) > 0)
                @foreach($courses as $course)
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table shoping-cart-table">
                            <tbody>
                            <tr>
                                <td width="90">
                                
                                        <img src="{{url('/')}}/public/uploads/course_images//{{$course->course_image}}">
                                    
                                </td>
                                <td class="desc">
                                    <h3>
                                    <a href="#" class="text-navy">
                                        {{$course->title}}
                                    </a>
                                    </h3>
                                    <p class="small">
                                        {!!Str::limit($course->description, 100);!!}
                                    </p>
                                   

                                    <div class="m-t-sm">
                                    <?php $session_id = Session::getId();?>
                                        <a href="{{url('del/')}}/{{$course->id}}/{{$session_id}}/{{Auth::user()->id}}" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                   
                                  <!---  <button form="resource-delete-{{ $course->id }}"  class="text-muted"><i class="fa fa-trash"></i> Remove item</button>--->
                        <form id="resource-delete-{{ $course->id }}" action="{{url('del/')}}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                          @csrf
                         <input type="hidden" value="{{$course->id}}" name="course_id">
                         
                         <input type="hidden" value="{{Auth::user()->id}}" name="session_id">
                        </form> 
                                    </div>
                                </td>

                                <td width="110">
                                   <span class="small text-muted">₹ {{$course->price}}</span>
                                    ₹ {{$course->strike_price}}
                                </td>
                               
                                <td width="170">
                                    <h4>
                                    ₹ {{$course->price}}
                                    </h4>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                   @endforeach
                                    @else
                                       <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table shoping-cart-table">
                            <tbody>
                            <tr>
                                <td width="90" colpsan="4">
                                    no course
                                </td>
                             
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                                    @endif
            
            </div>

        </div>
        <div class="col-md-3">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Cart Summary</h5>
                </div>
                <div class="ibox-content">
                    <span>
                        Total
                    </span>
                    <h2 class="font-bold">
                        ₹ {{$total}}
                    </h2>

                    <hr>
                  <!--  <span class="text-muted small">
                        *For United States, France and Germany applicable sales tax will be applied
                    </span>-->
                    <div class="m-t-sm">
                        <div class="btn-group">
                            <form method="post" action="{{route('cart.offline.payment')}}">
                                @csrf()
                                <input type="hidden" name="price" value="{{$total}}">
                        <button  href="#" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Checkout</a>
                       </form>
                        </div>
                    </div>
                </div>
            </div>

           

        </div>
    </div>
</div>
</div>   
               
               
               
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
      
   </body>


</html>