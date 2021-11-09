 @extends('layouts.app')
 
 @section('content')  
 
 
 
         
      
    <section class="breadcrumb_section">
	<div class="container">
		<div class="breadcrumb_section_div">
			<h2>Blog</h2>
			<p>Home / {{$blog->title}}</p>
		</div>
		</div>
	</section>

	
			
			
			
		<!-- Blog -->

	<section class="blog">
		<div class="container">
			<div class="row">			
			
				<section class="col-lg-8">
					<div class="blog_content">
						<div class="blog_title">{{$blog->title}}</div>
						<div class="blog_meta">
							<ul>
								<li>Post on <a href="#">{{$blog->date}}</a></li>
								<li>By <a href="#">admin</a></li>
							</ul>
						</div>
						<div class="blog_image"><img src="{{url('/public/uploads/images')}}/{{$blog->image}}" alt=""></div>
						<p>
						    {!!$blog->description!!}
						    
						</p>
					</div>
					
					
				</section>
			
			<!-- Blog Sidebar -->
				<section class="col-lg-4">
					<div class="sidebar">


						<!-- Latest News -->
						<div class="sidebar_section">
							<div class="sidebar_section_title">Latest Courses</div>
							<div class="sidebar_latest">

@foreach($data as $data)
								<!-- Latest Course -->
								<div class="latest d-flex flex-row align-items-start justify-content-start">
									<div class="latest_image"><div><img src="{{url('/public/uploads/images')}}/{{$data->image}}" alt=""></div></div>
									<div class="latest_content">
										<div class="latest_title"><a href="course.html">{{$data->title}}</a></div>
										<div class="latest_date">{{ \Carbon\Carbon::parse($data->created_at)->isoFormat('MMM Do YYYY')}}</div>
									</div>
								</div>
@endforeach


							</div>
						</div>

						

					</div>
				</section>
			
			
			
			</div>	
			
		</div>
	</section>	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	 
	
	
	
     
     
   <div class="clearfix"></div>  
     

 
 
 @endsection
 
 
@push('after-scripts')
   
   <script>
$(document).ready(function(){
 
 var _token = $('input[name="_token"]').val();

 load_data('', _token);

 function load_data(id="", _token)
 {
  $.ajax({
   url:"{{ route('loadmore.load_data') }}",
   method:"POST",
   data:{id:id, _token:_token},
   success:function(data)
   {
    $('#load_more_button').remove();
    $('#post_data').append(data);
   }
  })
 }

 $(document).on('click', '#load_more_button', function(){
  var id = $(this).data('id');
  $('#load_more_button').html('<b>Loading...</b>');
  load_data(id, _token);
 });

});
</script>
   @endpush