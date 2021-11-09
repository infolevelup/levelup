 @extends('layouts.app')
 
 @section('content')  
 
 
 
         
         
    <section class="breadcrumb_section">
	<div class="container">
		<div class="breadcrumb_section_div">
			<h2>About Us</h2>
			<p>Home / About Us</p>
		</div>
		</div>
	</section>

	<section class="feature-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-3">
							<div class="single-feature">								
								<div class="desc-wrap">
									<h3><img src="{{url('/')}}/public/images/award.png"><br> {{$about->certificates}}</h3>
									<h4>Certificates </h4>
								</div>
							</div>
						</div>
						
						<div class="col-lg-3">
							<div class="single-feature">								
								<div class="desc-wrap">
									<h3><img src="{{url('/')}}/public/images/degree.png"><br> {{$about->degree}}</h3>
									<h4>Degrees </h4>
								</div>
							</div>
						</div>
						
						<div class="col-lg-3">
							<div class="single-feature">								
								<div class="desc-wrap">
									<h3><img src="{{url('/')}}/public/images/coaching.png"><br> {{$about->instructor}}</h3>
									<h4>Instructors</h4>
								</div>
							</div>
						</div>
						
						<div class="col-lg-3">
							<div class="single-feature">								
								<div class="desc-wrap">
									<h3><img src="{{url('/')}}/public/images/expert.png"><br> {{$about->teaching_experience}}</h3>
									<h4>Teaching Experience </h4>
								</div>
							</div>
						</div>			
						
																		
					</div>
				</div>	
			</section>	
			
			
			
			
	
	<section class="about">	
		<div class="container">
			<div class="row">
				<div class="col">					
					<div class="section_title_container text-center">
						<h2 class="section_title">Welcome to <span>LevelUp</span></h2>
						<div class="section_subtitle"><p>{!!$about->about!!}</p></div>
					</div>
				</div>
			</div>
			<div class="row about_row">				
				<!-- About Item -->
				<div class="col-lg-4 about_col about_col_left">
					<div class="about_item">
						<div class="about_item_image"><img src="{{url('/')}}/public/uploads/images/{{$about->stories_image}}" alt=""></div>
						<div class="about_item_title"><a href="#">Our Stories</a></div>
						<div class="about_item_text">
							<p>{!!$about->stories_content!!}</p>
						</div>
					</div>
				</div>

				<!-- About Item -->
				<div class="col-lg-4 about_col about_col_middle">
					<div class="about_item">
						<div class="about_item_image"><img src="{{url('/')}}/public/uploads/images/{{$about->mission_image}}" alt=""></div>
						<div class="about_item_title"><a href="#">Our Mission</a></div>
						<div class="about_item_text">
							<p>{!!$about->mission_content!!}</p>
						</div>
					</div>
				</div>

				<!-- About Item -->
				<div class="col-lg-4 about_col about_col_right">
					<div class="about_item">
						<div class="about_item_image"><img src="{{url('/')}}/public/uploads/images/{{$about->vision_image}}" alt=""></div>
						<div class="about_item_title"><a href="#">Our Vision</a></div>
						<div class="about_item_text">
							<p>{!!$about->vision_content!!}</p>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</section>
	
	
	
	<section class="instructor">
	<div class="container">
	<div class="row">
	
	<div class="section_title_container text-center">
	<h2 class="section_title">Instructor <span>Accreditations</span></h2>
	<p>{!!$about->accrediations!!}</p>
	</div>
	
	<div class="partner_logo_div_main">
			
			@foreach($patnerss as $pat)
				<div class="partner_logo_div">
					<img src="{{url('/')}}/public/uploads/images/{{$pat->image}}">
					
				</div>
				
			@endforeach
				
			</div>
	
	
	</div></div>
	</section>
	
	
	
	

	 <!-- Feature -->

	<div class="feature">		
		<div class="container">			
			<div class="row feature_row">
			<!-- Feature Video -->
				<div class="col-lg-12 feature_col">
					<div class="feature_video d-flex flex-column align-items-center justify-content-center">
							<iframe width="100%" height="250" src="{{$about->video}}" frameborder="0" allowfullscreen></iframe>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	<!-- Team -->

	<!-- <div class="team"> -->
		<!-- <div class="container"> -->
			<!-- <div class="row"> -->
				<!-- <div class="col"> -->
					<!-- <div class="section_title_container text-center"> -->
						<!-- <h2 class="section_title">Our Team</h2> -->
						<!-- <div class="section_subtitle"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu. Vestibulum feugiat, sapien ultrices fermentum congue, quam velit venenatis sem</p></div> -->
					<!-- </div> -->
				<!-- </div> -->
			<!-- </div> -->
			<!-- <div class="row team_row"> -->
				
				
				<!-- <div class="col-lg-3 col-md-6 team_col"> -->
					<!-- <div class="team_item"> -->
						<!-- <div class="team_image"><img src="{{url('/')}}/public/images/team_1.jpg" alt=""></div> -->
						<!-- <div class="team_body"> -->
							<!-- <div class="team_title"><a href="#">Jacke Masito</a></div> -->
							<!-- <div class="team_subtitle">Marketing & Management</div> -->
							<!-- <div class="social_list"> -->
								<!-- <ul> -->
									<!-- <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li> -->
									<!-- <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li> -->
									<!-- <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li> -->
								<!-- </ul> -->
							<!-- </div> -->
						<!-- </div> -->
					<!-- </div> -->
				<!-- </div> -->

				
				<!-- <div class="col-lg-3 col-md-6 team_col"> -->
					<!-- <div class="team_item"> -->
						<!-- <div class="team_image"><img src="{{url('/')}}/public/images/team_2.jpg" alt=""></div> -->
						<!-- <div class="team_body"> -->
							<!-- <div class="team_title"><a href="#">William James</a></div> -->
							<!-- <div class="team_subtitle">Designer & Website</div> -->
							<!-- <div class="social_list"> -->
								<!-- <ul> -->
									<!-- <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li> -->
									<!-- <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li> -->
									<!-- <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li> -->
								<!-- </ul> -->
							<!-- </div> -->
						<!-- </div> -->
					<!-- </div> -->
				<!-- </div> -->

				
				<!-- <div class="col-lg-3 col-md-6 team_col"> -->
					<!-- <div class="team_item"> -->
						<!-- <div class="team_image"><img src="{{url('/')}}/public/images/team_3.jpg" alt=""></div> -->
						<!-- <div class="team_body"> -->
							<!-- <div class="team_title"><a href="#">John Tyler</a></div> -->
							<!-- <div class="team_subtitle">Quantum mechanics</div> -->
							<!-- <div class="social_list"> -->
								<!-- <ul> -->
									<!-- <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li> -->
									<!-- <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li> -->
									<!-- <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li> -->
								<!-- </ul> -->
							<!-- </div> -->
						<!-- </div> -->
					<!-- </div> -->
				<!-- </div> -->

				
				<!-- <div class="col-lg-3 col-md-6 team_col"> -->
					<!-- <div class="team_item"> -->
						<!-- <div class="team_image"><img src="{{url('/')}}/public/images/team_4.jpg" alt=""></div> -->
						<!-- <div class="team_body"> -->
							<!-- <div class="team_title"><a href="#">Veronica Vahn</a></div> -->
							<!-- <div class="team_subtitle">Math & Physics</div> -->
							<!-- <div class="social_list"> -->
								<!-- <ul> -->
									<!-- <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li> -->
									<!-- <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li> -->
									<!-- <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li> -->
								<!-- </ul> -->
							<!-- </div> -->
						<!-- </div> -->
					<!-- </div> -->
				<!-- </div> -->

			<!-- </div> -->
		<!-- </div> -->
	<!-- </div>                    -->
                            
      <section class="section_10">
   		<div class="container">
   			<div class="section_10_main_heading_1">
  			<p>Our <span>Partners</span></p>
			</div>

			<div class="partner_logo_div_main">
			
			
				
				@foreach($patners as $pat)
				<div class="partner_logo_div">
					<img src="{{url('/')}}/public/uploads/images/{{$pat->image}}">
					
				</div>
				
			@endforeach
				
			</div>		
				
			
   		</div>
   </section>   
     
     
     
   <div class="clearfix"></div>  
 
 
 
 
 
 @endsection
 
 
@push('after-scripts')
    <script>
        $(document).ready(function () {
            $(document).on('change', '#sortBy', function () {
                if ($(this).val() != "") {
                    location.href = '{{url()->current()}}?type=' + $(this).val();
                } else {
                    location.href = '{{route('course.courseindex')}}';
                }
            })

            @if(request('type') != "")
            $('#sortBy').find('option[value="' + "{{request('type')}}" + '"]').attr('selected', true);
            @endif
        });

    </script>
@endpush