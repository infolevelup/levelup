 @extends('layouts.app')

@section('content')  


   <section class="breadcrumb_section">
	<div class="container">
		<div class="breadcrumb_section_div">
			<h2>Testimonials</h2>
			<p>Home / Testimonials</p>
		</div>
		</div>
	</section>  
	
	<section class="testimonials-video">
	<div class="container">
	<div class="row">
	<div class="col-lg-12 col-md-12">
	<div class="heading-title">
	<h2>Student's Experience</h2>
	</div></div>


@foreach($testimonial as $test)
<?php 
//$url= $test->video;

//parse_str( parse_url( $url, PHP_URL_QUERY ), $youtube_id_v ); 

?>
	<article class="col-lg-4 col-md-4">
	<iframe width="100%" height="250" src="{{$test->video}}" frameborder="0" allowfullscreen></iframe>
	</article>
	
@endforeach


	
	</div></div>
	</section>
	
	
	<section class="testimonials">
	<div class="container">
	<div class="row">
	
	<div class="col-lg-12 col-md-12">
	<div class="heading-title">
	<h2>Student's Speak</h2>
	</div></div>	


	@foreach($testimonial as $test)
	<div class="media">
	    @if($test->images)
	  <img src="{{url('/')}}/public/uploads/images/{{$test->images}}" class="mr-4 rounded-circle" alt="...">
	  @else
	    <img src="{{url('/')}}/public/uploads/images/person_img.jpg" class="mr-4 rounded-circle" alt="...">
	  @endif
	  <div class="media-body">
		<h5 class="mt-0">{{$test->name}}</h5>
		<p>
		    {{$test->long_desc}}
		    
		</p>
	  </div>
	</div>
	@endforeach


	
	</div>
	</div>	
	</section>

     
   <div class="clearfix"></div>  





  @endsection