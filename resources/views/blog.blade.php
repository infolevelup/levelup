 @extends('layouts.app')
 
 @section('content')  
 
 
 
         
      
    <section class="breadcrumb_section">
	<div class="container">
		<div class="breadcrumb_section_div">
			<h2>Blog</h2>
			<p>Home / Blog</p>
		</div>
		</div>
	</section>

	
			
			
			
		<!-- Blog -->

	<section class="blog">
		<div class="container">
			 
			            <div class="row">


@foreach($blogs as $blog)
<article class="col-lg-4">
			<!-- Blog Post -->
						<div class="blog_post trans_200">
							<div class="blog_post_image"><img src="{{url('/')}}/public/uploads/images/{{$blog->image}}" alt=""></div>
							<div class="blog_post_body">
								<div class="blog_post_title"><a href="{{url('/blog-details/')}}/{{$blog->slug}}">{{$blog->title}}</a></div>
								<div class="blog_post_meta">
									<ul>
										<li><a href="{{url('/blog-details/')}}/{{$blog->slug}}">{{ \Carbon\Carbon::parse($blog->newsdate)->isoFormat('MMM Do YYYY')}}</a></li>
									</ul>
								</div>
								<div class="blog_post_text">
									<p>{!!Str::limit($blog->description,30);!!}</p>
								</div>
							</div>
						</div>
			
			</article>
			

@endforeach
</div>
<div class="row">
    {{$blogs->links()}}
			</div>
			
		            	
			
					</div>
	</section>	
	
	
	
	
	
	
	
	
	
	

	 
	
	
	
     
     
   <div class="clearfix"></div>  
     

 
 
 @endsection
 
 
@push('after-scripts')
   
   @endpush