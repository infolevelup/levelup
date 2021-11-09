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
             <div class="padding-top-2x mt-2">
			<!-- BEGIN NEW TICKET -->
					<button type="button" class="btn btn-success pull-right issue-btn" data-toggle="modal" data-target="#newIssue">New Issue</button>
					
					<div class="modal fade" id="newIssue" tabindex="-1" role="dialog" aria-labelledby="newIssue" aria-hidden="true">
						<div class="modal-wrapper">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header bg-blue">
										
										<h4 class="modal-title"><i class="fa fa-pencil"></i> Create New Issue</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									</div>
									  <form class="panel-activity__status"role="form" method="POST" action="{{ url('/new_ticket') }}">
                                        {!! csrf_field() !!}
										<div class="modal-body">
											<div class="form-group">
											  <input id="title" type="text" class="form-control" name="title"  placeholder="Subject" value="{{ old('title') }}">

                                                @if ($errors->has('title'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                                @endif
											</div>
											<div class="form-group">
												 <select id="category" type="category" class="form-control" name="category">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
											</div>
											<div class="form-group">
											     <select id="priority" type="" class="form-control" name="priority">
                                    <option value="">Select Priority</option>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>

                                @if ($errors->has('priority'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('priority') }}</strong>
                                    </span>
                                @endif
											</div>
											<div class="form-group">
											<textarea rows="10" id="message" class="form-control" name="message"></textarea>

                                @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
											</div>
											<div class="form-group">
												<input type="file" name="attachment">
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
											<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-pencil"></i> Create</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- END NEW TICKET -->
			
			
			</div>
            
            <div class="table-responsive margin-bottom-2x">
                <table class="table margin-bottom-none">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Last Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                       @if ($tickets->isEmpty())
                        <tr>
                            
                        <td colspan="5">You have not created any tickets.</td>
                   
                        </tr>
                         @else
                        <tr>
                          
                             @foreach ($tickets as $ticket)
                                <tr>
                                    <td>
                                    @foreach ($categories as $category)
                                        @if ($category->id === $ticket->category_id)
                                            {{ $category->name }}
                                        @endif
                                    @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ url('tickets/'. $ticket->ticket_id) }}">
                                            #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                                        </a>
                                    </td>
                                    <td>
                                    @if ($ticket->status === 'Open')
                                        <span class="badge badge-success">{{ $ticket->status }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ $ticket->status }}</span>
                                    @endif
                                    </td>
                                    <td><span class="text-warning">{{$ticket->priority}}</span></td>
                                    <td>{{ $ticket->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tr>
                        
                    @endif
                    </tbody>
                </table>
                 
                 
                   <nav aria-label="Page navigation example">
                              <ul class="pagination justify-content-center">
                              {{ $tickets->render() }}
                              </ul>
                  </nav>
                 
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