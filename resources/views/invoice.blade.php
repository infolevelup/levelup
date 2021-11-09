
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
			<h2>Dashboard</h2>
			<p>Home / Dashboard</p>
		</div>
		</div>
	</section>


	<section class="u-dashboard">
	<div class="container">
	<div class="row">
	
	  @include('layouts.user_sidemenu')

<!---	<article class="col-lg-3 col-md-4 col-sm-12 hidden-xs">
	
	<div class="new-classroom-box">
	<div class="bodyContainerWrapper">
	<div class="bodyContainer">
		<div class="padding">		
			<div class="jquery_accordion_wrapper">			
			</div>		
		</div>
	</div>
</div>
	
	</div>
	
	<div class="howtouse"><a href="#"><i class="fa fa-play-circle" aria-hidden="true"></i> How to Use LevelUp LMS</a></div>
	
	</article>
---->
	<article class="col-lg-9 col-md-8 col-sm-12 col-xs-12">			
	

<div class="page-content container">
    <div class="page-header text-blue-d2">
        <h1 class="page-title text-secondary-d1">
            Invoice
            <small class="page-info">
                <i class="fa fa-angle-double-right text-80"></i>
                ID: #{{$order->order_id}}
            </small>
        </h1>

        <div class="page-tools">
            <div class="action-buttons">
                <!--<a class="btn bg-white btn-light mx-1px text-95" onclick="window.print()"data-title="Print">
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                    Print
                </a>-->
                <a class="btn bg-white btn-light mx-1px text-95" href="{{url('/')}}/generate-pdf/{{$order->order_id}}" data-title="PDF">
                    <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i>
                    Export
                </a>
            </div>
        </div>
    </div>
<?php 
$user=App\User::where('id',$order->user_id)->first();
?>
    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-10 offset-lg-1">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center text-150">                            
                            <span class="text-default-d3"><img src="{{url('/')}}/public/images/logo.png" width="150px"></span>
                        </div>
                    </div>
                </div>
                <!-- .row -->

                <hr class="row brc-default-l1 mx-n1 mb-4" />

                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">To:</span>
                            <span class="text-600 text-110 text-blue align-middle">{{$user->name}}</span>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                {{$user->city}}
                            </div>
                            <div class="my-1">
                                {{$user->Country}}
                            </div>
                            <div class="my-1"><!---<i class="fa fa-phone fa-flip-horizontal text-secondary"></i>---> <b class="text-600">{{$user->phone}}</b></div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">
                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                Invoice
                            </div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> #{{$order->order_id}}</div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> {{ \Carbon\Carbon::parse($order->created_at)->isoFormat('MMM Do YYYY')}}</div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> <span class="badge badge-warning badge-pill px-25">{{$order->status}}</span></div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

                <div class="mt-4">
                    <div class="row text-600 text-white bgc-default-tp1 py-25">
                        <div class="d-none d-sm-block col-1">#</div>
                        <div class="col-9 col-sm-5">Course</div>
                        <div></div>
                        <div class="col-2">Amount</div>
                    </div>

                    <div class="text-95 text-secondary-d3">
                     <?php 
                     $orderlist=App\OrderList::where('order_id',$order->order_id)->get();
                     ?> 
                      	@foreach($orderlist as $orderlist)
                      	<?php 
                      	$course=App\Course::where('id',$orderlist->course_id)->first();
                      	?>
                       	<?php $i=1; ?>
	                @if($i % 2 == 0) 
                        <div class="row mb-2 mb-sm-0 py-25">
                            <div class="d-none d-sm-block col-1">{{$i}}</div>
                            <div class="col-9 col-sm-5">{{$course->title}}</div>
                            <div></div>
                            <div class="col-2 text-secondary-d2"> ₹  {{$orderlist->price}} </div>
                        </div>
                    @else
                        <div class="row mb-2 mb-sm-0 py-25 bgc-default-l4">
                          <div class="d-none d-sm-block col-1">{{$i}}</div>
                            <div class="col-9 col-sm-5">{{$course->title}}</div>
                            <div></div>
                            <div class="col-2 text-secondary-d2"> ₹  {{$orderlist->price}} </div>
                        </div>

                       
                  	@endif
            	<?php $i++;?>
                @endforeach
                  
                    </div>

                    <div class="row border-b-2 brc-default-l2"></div>                    

                    <div class="row mt-3">
                        <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                            Extra note such as company or payment information...
                        </div>

                        <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    SubTotal
                                </div>
                                <div class="col-5">
                                    <span class="text-120 text-secondary-d1"> ₹  {{$order->payable_price}}</span>
                                </div>
                            </div>

                           <!-- <div class="row my-2">
                                <div class="col-7 text-right">
                                    Tax (10%)
                                </div>
                                <div class="col-5">
                                    <span class="text-110 text-secondary-d1">$225</span>
                                </div>
                            </div>-->

                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    Total Amount
                                </div>
                                <div class="col-5">
                                    <span class="text-150 text-success-d3 opacity-2"> ₹  {{$order->payable_price}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div>
                        <span class="text-secondary-d1 text-105">Thank you for your business</span>                        
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