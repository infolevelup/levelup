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
      <title>Welcome to Level Up |Notification</title>
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
 
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
	

	<article class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
	<div class="padding-bottom-3x mb-2">
	    
	    
	    <div class="row">
              @include('layouts.user_sidemenu')
		
		
		
		

               <div class="col-lg-9 col-md-9 col-sm-12">
                    <div class="padding-top-2x mt-2 hidden-lg-up">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Unread Notifications</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Read Notifications</a>
                        </li>
                        </ul>
                    </div>
                     @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
    
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                      
                        <a class="btn btn-default pull-right" href="{{ route('mark') }}">Mark as read</a>
                      
                     <div class="table-responsive margin-bottom-2x">
                <table class="table margin-bottom-none">
                             <thead>                  
                    <tr>
                      <th>#</th>
                      <th>Message</th>
                      <th>Date</th>
                    </tr> 
                  </thead>
                  <tbody>
                  
                    <tr>
                         @if(auth()->user()->unreadNotifications->count()>0)
                         @php $i=1; @endphp
             @foreach(auth()->user()->unreadNotifications as $notification)
                             <td>{{$i}}</td>
                             <td width="60%">
                        {!! $notification->data['data'] !!}                      </td>
                      <td>{{ $notification->created_at }}</td>
                     </tr>
                                    <?php $i++;?>
                    @endforeach

               @else
                <td>
               <span>No Notifications</span>
               </td>
               @endif
                  </tbody>
        
                </table>
            </div>
                      
                      
                  </div>                

              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="contact-tab">
                  
                     <div class="table-responsive margin-bottom-2x">
                <table class="table margin-bottom-none">
                  <thead>                  
                    <tr>
                      <th>#</th>
                      <th>Message</th>
                      <th>Date</th>
                    </tr> 
                  </thead>
                  <tbody>
                  
                    <tr>
                         @if(auth()->user()->readNotifications->count()>0)
                         @php $i=1; @endphp
             @foreach(auth()->user()->readNotifications as $notification)
                            <td>{{$i}}</td>

                                 <td width="60%">
                        {!! $notification->data['data'] !!}                      </td>
                      <td>{{ $notification->created_at }}</td>
                    
                  
                     
                         </tr>
                                    <?php $i++;?>
                    @endforeach

               @else
                <td>
               <span>No Notifications</span>
               </td>
               @endif
                  </tbody>
        
        
                </table>
            </div>
                  
                  
                  
              </div>

          </div>
                      
                            
                        
     

                            <!-- Reply Form-->
                            
                            
                            
                            
                            
                      
            
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