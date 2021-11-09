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
			<p>Home / Dashboard</p>
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
                       <h4>#{{ $ticket->ticket_id }} - {{ $ticket->title }}</h4> 
                    </div>
                     @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                     <div class="table-responsive margin-bottom-2x">
                <table class="table margin-bottom-none">
                    <thead>
                        <tr>
                           <th>Category</th>
                            <th>Title</th>
                            <th>Message</th>

                            <th>Status</th>
                            <th>Priority</th>
                            <th>created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td> #{{ $ticket->ticket_id }} - {{ $ticket->title }}</td>
                            <td>  {!!$ticket->message !!}</td>

                            <td> @if ($ticket->status === 'Open')
                            <span class="badge badge-success">{{ $ticket->status }}</span>
                        @else
                          <span class="badge badge-danger">{{ $ticket->status }}</span>
                        @endif</td>
                            <td><span class="text-warning">{{$ticket->priority}}</span></td>
                            <td>{{ $ticket->created_at->diffForHumans() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
                     @foreach ($comments as $comment)
                    
                            <!-- Messages-->
                            <div class="comment">
                                <div class="comment-author-ava">
                                    @if($comment->user->image)
                                    <img src="{{url('/')}}/public/uploads/images/{{$comment->user->image}}" alt="Avatar">
                                    @else
                                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Avatar">
                                    @endif
                                    </div>
                                <div class="comment-body">
                                    <p class="comment-text">{{ $comment->comment }}   
                                        
                                        @if($comment->image)
                                       <a href="{{url('/')}}/public/uploads/images/{{$comment->image}}" target=”_blank”>
                                          <img src="{{url('/')}}/public/uploads/images/{{$comment->image}}" alt="" />
                                           </a>
                                        
                                        @endif
                                   
                                        </p>
                                <div class="comment-footer"><span class="comment-meta">{{ $comment->user->name }}</span>
                                {{ $comment->created_at->format('Y-m-d') }}</div>
                                </div>
                            </div>
                    @endforeach
                            
                          
                            
                        
     

                            <!-- Reply Form-->
                            
                            
                            
                            
                            
                            
                            <h5 class="mb-30 padding-top-1x">Leave Message</h5>
                             <form action="{{ url('comment') }}" method="POST" class="form" enctype="multipart/form-data">
                            {!! csrf_field() !!}

                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                <div class="form-group">
                                    <textarea class="form-control form-control-rounded" name="comment"id="review_text" rows="15" placeholder="Write your message here..." required=""></textarea>
                                     @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                     <input  type="file" class="form-control" name="image">

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-outline-primary" type="submit">Submit Message</button>
                                </div>
                            </form>
                           
                           
           
           
            
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