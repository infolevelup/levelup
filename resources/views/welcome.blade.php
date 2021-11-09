
    @extends('layouts.app')
@section('title','HOME')
@section('content')  
     <section id="home" class="slider_landing_section">
			<div id="main-slide" class="carousel slide" data-ride="carousel">
				<div class="overlay"></div>
				<ol class="carousel-indicators">
					  <?php $i=0; ?>
		    @foreach($banners as $banner)
		    
			<li data-target="#main-slide" data-slide-to="<?php echo $i;?>" class="<?php if($i==0){echo 'active';}?>"></li>
			<?php  $i++;?>
		@endforeach	
				
			<!--<li data-target="#main-slide" data-slide-to="2"></li>-->
		</ol>
		<div class="carousel-inner">
				   <?php $i=0; ?>
		    @foreach($banners as $banner)
		    
			<div class="carousel-item<?php if($i==0){ echo' active'; }?>">
				<img class="img-fluid" src="{{url('/')}}/public/uploads/images/{{$banner->image}}" alt="slider">
				<div class="slider-content">
					<div class="col-md-12">
						<h2 class="animated2 {{$banner->class}}">
							{{$banner->name}}
						</h2>
						<h3 class="animated3 {{$banner->class}}">
						</h3>
						
						<div class="row">
							
							<div class="col-12 col-md-12 col-lg-12">
								<h4 class="animated4 {{$banner->class}}">{{$banner->content}}
						</h4>

							</div>
							
						</div>
						
					</div>
				</div>
			</div>
			
				<?php $i++; ?>
			
			@endforeach
			
			
					
				</div>
			
			</div>
</section>
<!--/ Slider end -->
         
    
         
        </div>  
        
        </section>
         
         <!-- banner section start -->
         
         <!-- banner section end -->
     
      
      
      
<section class="after_banner_section" >
	<div class="container">
	
		<div class="after_banner_section_spacing_div">
		    
		    <div class="row">
		    <div class="col-12 col-md-1 col-lg-1"></div>
			
			<div class="col-12 col-md-2 col-lg-2">
				<div class="four_section_div box-01" data-aos="fade-right" data-aos-delay="600">
				
					<div class="four_section_image_div">
						<img src="{{url('/')}}/public/images/aws-icon.png">
					</div>
					
					<div class="four_section_description">
						<p>AWS</p>
					</div>
					
				</div>
			</div>
			
			<div class="col-12 col-md-2 col-lg-2">
				<div class="four_section_div box-02" data-aos="fade-right" data-aos-delay="700">
				
					<div class="four_section_image_div">
						<img src="{{url('/')}}/public/images/azure-icon.png">
					</div>
					
					<div class="four_section_description">
						<p>Azure</p>
					</div>
					
				</div>
			</div>
			
			
			<div class="col-12 col-md-2 col-lg-2">
				<div class="four_section_div box-03" data-aos="fade-right" data-aos-delay="800">
				
					<div class="four_section_image_div">
						<img src="{{url('/')}}/public/images/devops.png">
					</div>
					
					<div class="four_section_description">
						<p>DevOps</p>
					</div>
					
				</div>
			</div>
			
			
			<div class="col-12 col-md-2 col-lg-2">
				<div class="four_section_div box-04" data-aos="fade-right" data-aos-delay="900">
				
					<div class="four_section_image_div">
						<img src="{{url('/')}}/public/images/google-cloud.png">
					</div>
					
					<div class="four_section_description">
						<p>GCP</p>
					</div>
					
				</div>
			</div>
			
			<div class="col-12 col-md-1 col-lg-1"></div>
			
			
			
		</div>
			
		
	<!--	<div class="row">
		
			<div class="col-12 col-md-2 col-lg-2"></div>

        @foreach($category1 as $category1)
			<div class="col-12 col-md-2 col-lg-2">
				<div class="four_section_div" data-aos="fade-right" data-aos-delay="600">
				
					<div class="four_section_image_div">
						 <img src="{{ asset('uploads/images')}}/{{$category1->icon}}">

					</div>
					
					<div class="four_section_description">
						<a href="{{url('/')}}/category/{{$category1->slug}}"><p>Become Industry Expert in {{$category1->name}}</p></a>
					</div>
					
				</div>
			</div>
		@endforeach

			
			<div class="col-12 col-md-2 col-lg-2">
			</div>
			
			
			
		</div> -->
		
		</div>
	</div>
</section>      
     
     
 <section class="certificate_section">
 	<div class="container">
 	
 		<div class="certificate_main_heading_div" data-aos="fade-left" data-aos-delay="600">
 			<p> LevelUp stands by you all the way to ensure that you achieve your learning goals. We are “Committed to Excellence”</p>
 		</div>
 		
 		<div class="certificate_main_heading_div_2">
 			<div class="row" data-aos="fade-right" data-aos-delay="600">
 							  @foreach($course1 as $course1)
         <?php 
		  
		  $lesson=App\Lesson::where('course_id',$course1->id)->get();
		  $lessonCount = count($lesson);
		  ?>
		  @if($lessonCount >0)
 		
 				<div class="col-12 col-md-4 col-lg-4">
 					<div class="certificate_main_heading_div_2_inner">
 						<div class="row">
 							<div class="col-4 col-md-4 col-lg-4 nopadding">
 								<div class="certificate_main_heading_div_2_inner_iamges">
        							<img src="{{ asset('uploads/course_images/')}}/{{$course1->course_image}}" class="img-fluid">
 								</div>
 							</div>
 							<div class="col-8 col-md-8 col-lg-8">
 								<div class="certificate_main_heading_div_2_inner_heading_1">
 									<p>Certification in</p>
 								</div>
 								
 								<div class="certificate_main_heading_div_2_inner_heading_2">
 									<p>{{$course1->title}}</p>
 								</div>
 								
 								<div class="certificate_main_heading_div_2_inner_heading_3 text-right">
 									<a href="{{url('/')}}/course/{{$course1->slug}}">>> Know More</a>
 								</div>
 								
 							</div>
 						</div>
 					</div>
 				</div>
 				
 		<?php     $data[] = $course1->id;
        ?>
        @endif
 		                @endforeach
 			</div>
 			
 		
        
 		</div>
 		
 		
 	</div>
 </section>
      
   
      
  <section class="section_3" data-aos="fade-right" data-aos-delay="600">
  	<div class="container">
  		<div class="section_3_heading_1">
  			<p>Get the Edge you’ve always wanted</p>
  		</div>
  		
  		<div class="section_3_heading_2">
  			<p>Level Up is an online learning destination and  our mission is to deliver high-quality educational content.</p>
  		</div>
  		<div class="row section_3_underlines">
  			<div class="col-12 col-md-3 col-lg-3">
  				<div class="section_3_row_div">
  					<div class="section_3_image">
  						<img src="{{ asset('images/icons_1.png')}}">
  					</div>
  					<div class="section_3_headings">
  						<p>Learn at your pace</p>
  					</div>
  				</div>
  			</div>
  			<div class="col-12 col-md-3 col-lg-3">
  				<div class="section_3_row_div">
  					<div class="section_3_image">
  						<img src="{{ asset('images/icons_2.png')}}">
  					</div>
  					<div class="section_3_headings">
  						<p>Real Time Doubt Resolution</p>
  					</div>
  				</div>
  			</div>
  			<div class="col-12 col-md-3 col-lg-3">
  				<div class="section_3_row_div">
  					<div class="section_3_image">
  						<img src="{{ asset('images/icons_3.png')}}">
  					</div>
  					<div class="section_3_headings">
  						<p>Track Your Career Growth</p>
  					</div>
  				</div>
  			</div>
  			<div class="col-12 col-md-3 col-lg-3">
  				<div class="section_3_row_div">
  					<div class="section_3_image">
  						<img src="{{ asset('images/icons_4.png')}}">
  					</div>
  					<div class="section_3_headings">
  						<p>Certification</p>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
  </section>   
      
  
     
  <section class="section_4">
  	<div class="container">
  		<div class="section_4_main_heading_1" data-aos="fade-top" data-aos-delay="600">
  			<p>Popular <span>Courses</span></p>
  		</div>
  		
  		<div class="section_4_main_heading_2" data-aos="fade-top" data-aos-delay="700">
  			<p>Make your way down a Path and build specific skills that will help you land an amazing job. </p>
  		</div>
  	
  	<article>
	<div class="row my-3">
  
  <div class="card">
    <div class="card-header"> 
      
    </div>
	
    <div class="card-body">      
      <div class="tab-content">	  
	 
	 
	  <!--- First Tab--->	  
        <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">         
		  <div class="owl-carousel first-tab owl-theme">
		      @if(count($course)>0)		  
									     @foreach($course as $course)
                        <?php 
		  
		  $lesson=App\Lesson::where('course_id',$course->id)->get();
		  $lessonCount = count($lesson);
            $batch=App\Batch::where('course_id',$course->id)->first();
		  ?>
				<div class="item">				
				<article>
				<div class="single_course">
                   <div class="course_head {{$course->color}} text-center">
                   <a href="{{url('/')}}/course/{{$course->slug}}">
                         @if($course->course_image)
                       <img class="img-fluid" src="{{url('/')}}/public/uploads/course_images/{{$course->course_image}}" alt="" />
                       @else
                       <img class="img-fluid" src="{{ asset('images/01.png')}}" alt="" />
                       @endif
                       </a></div>
                    
					<div class="course_content">
                   <span class="price">₹{{$course->price}}</span>                                        
                   <h4><a href="{{url('/')}}/course/{{$course->slug}}">{{$course->title}}</a></h4> 
                   	<?php 
					$total_ratings=App\Rating::where('course_id',$course->id)->where('status','approve')->get()->count();
					$course_rating=App\Rating::where('course_id',$course->id)->where('status','approve')->avg('rating');

					?>
					<div class="">
					    	@for($r=1; $r<=$course_rating; $r++)
                       
					<span class="fa fa-star checked"></span>
				 @endfor
                           
					<span class="star_text">5.0 ({{$total_ratings}} Rating)</span>
					</div>
				      
					  <div class="course_meta d-flex justify-content-lg-between align-items-lg-center flex-lg-row flex-column mt-4">
                       <div class="mt-lg-0 mt-3">
                       <span class="meta_info mr-1">
                       <a href="#"> <i class="fa fa-book"></i> {{$lessonCount}} Lessons</a></span>					   
                       <span class="meta_info mr-1">
                       <a href="#"> <i class="fa fa-clock-o"></i> 8 Weeks </a></span>				   
                       </div></div>
                 </div></div>
			    </article>
				</div>					
						
					@endforeach	
						
		@else
		<p>No Data Found</p>
		@endif
			
		</div>          
        </div>
		<!--- First Tab--->
		
	
	
      </div>
	  <!--- sixth Tab--->
      <!-- END TABS DIV -->
      
    </div>
    
  </div>
</div>
	</article>
  	
  		  		
  		<div class="popular_courses_btn_div">
 			<a href="{{url('/course')}}">View All</a>
 		</div>
 		
 		
  	</div>
  </section>         
     
 
  <section class="unlock_section_5" >
  	<div class="container">
  		<div class="unlock_div" >
  			<div class="row">
  				<div class="col-12 col-md-6 col-lg-6">
  					<div class="unlock_heading_1">
  						<p>Unlock Your Potential</p>
  					</div>
					<div class="unlock_heading_2">
						<p>Get ready to achieve your goal with LevelUp</p>
					</div>
  				</div>
  				<div class="col-12 col-md-6 col-lg-6">
  					<div class="section_5_news_letter_div">
 						<form action="{{url('/')}}/subscribe" method="post">
 						    @csrf
 							<div class="form-group">
 								<input type="email" class="form-control" placeholder="Your Email" name="email" required>
							</div>
 							
 							<div class="form-group">
			              <input type="submit" value="Subscribe Now" name="sign_up" class="btn news_letter_btn">
			            </div>
 							
 						</form> 						
  					</div>
  				</div>
  			</div>
  			
  			
  		</div>
  	</div>
  </section>    
        
        
   
   <section class="section_6" >
   		<div class="container">
   			<div class="row" >
   				<div class="col-12 col-md-4 col-lg-4">
   					<div class="section_6_div_1" >
   					
   						
   						<div class="section_6_div_1_heading_1">
   						
   							<p>Courses <br>Starting <br>Soon</p>
   						</div>
   						
   						<div class="section_6_div_1_description">
   							<p>Level Up is an online learning destination and  our mission is to deliver high-quality educational content.</p>
   						</div>
   					</div>
   				</div>
   				
   				<div class="col-12 col-md-8 col-lg-8">
   					<div class="section_6_div_2">
   						<div class="section_6_items">
   						
   							
							<div class="card">
								<div class="section_6_card-body">
								
								
									<div class="row">
									    <?php 
									    $crsstartingsoon=App\Course_starting_soon::orderBy('id','DESC')->get();
									    $i=1;
									    ?>
									    @if($crsstartingsoon)
									    @foreach($crsstartingsoon as $startingsoon)
									    
										<div class="col-6 col-md-6 col-lg-6">
											<div class="section_6_div_2_inner">
										
										<div class="row">
											<div class="col-md-4 col-lg-4">
												<div class="section_6_div_2_image">
													<img src="{{ asset('uploads/images/')}}/{{$startingsoon->image}}" class="img-fluid">
												</div>
											</div>
											<div class="col-md-8 col-lg-8">
												<div class="section_6_div_2_heading">
													<p>{{$startingsoon->title}}</p>
												</div>

												<div id="demo{{$i}}"></div>
												<script>
// Set the date we're counting down to
var countDownDate = new Date("{{ \Carbon\Carbon::parse($startingsoon->expiry_date)->isoFormat('MMM Do YYYY')}} 15:37:25").getTime();

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
  document.getElementById("demo{{$i}}").innerHTML = days + "d : " + hours + "hr : "
  + minutes + "m : " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo{{$i}}").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
  
											</div>
										</div>

										

										

									</div>
										</div>
										<?php $i++;?>
											@endforeach
										@endif	
									</div>
									
									
								</div>
							</div>
							
							
							
							
							
							
							
						</div>
   					
   					
   						
   					</div>
   				</div>
   				
   			</div>
   		</div>
   </section>     
        
        
   <section class="section_7">
   	<div class="container">
   		<div class="section_7_main_heading_1">
  			<p>Trending <span>Categories</span></p>
  		</div>
  		
  		<div class="section_7_main_heading_2">
  			<p>Level Up is an online learning destination and  our mission is to deliver high-quality educational content.</p>
  		</div>
  		
  		<div class="section_7_row_div_main">
  			<div class="row">

             @foreach($category as $category)  

  				<div class="col-12 col-md-2 col-lg-2">
  					<div class="section_7_category_main_div">
  						<div class="section_7_category_image_div1">
  						<a href="{{url('/')}}/category/{{$category->slug}}">	<img src="{{url('/')}}/public/uploads/images/{{$category->icon}}"></a>
  						</div>
  						
  						
  						<div class="section_7_category_heading_div">
  							<a href="{{url('/')}}/category/{{$category->slug}}"><p>{{$category->name}}</p></a>
  						</div>
  						
  						
  					</div>
  				</div>
  			  @endforeach

  			</div>
  		</div>
   	</div>
   </section>
           
         
   <section class="section_8">
   		<div class="container">
   			<div class="row">
   				<div class="col-12 col-md-7 col-lg-7">
   					<div class="section_8_left_div">
   						<div class="section_8_left_div_heading_1">
   							<p>Level Up for Corporate Trainings</p>
   						</div>
   						
   						<div class="row">
   							<div class="col-12 col-md-7 col-lg-7">
   								<div class="section_8_left_div_heading_2">
									<p>Make your employees into masters. Nurture talent with instructor-led courses on trending technologies</p>
								</div>							
   							</div>
   							<div class="col-12 col-md-5 col-lg-5">
   								
   							</div>
   						</div>
   						
   						
   						<div class="section_8_left_div_btn">
   							<a href="{{url('/corporate-training')}}">Learn More</a>
   						</div>
   					</div>
   				</div>
   				
   				<div class="col-12 col-md-5 col-lg-5">
   					<div class="section_8_right_div">
   						<div class="section_8_right_div_heading_1">
   							<p>Become an</p>
   						</div>		
   						<div class="section_8_right_div_heading_2">
   							<p>Instructor</p>
   						</div>		
   						<div class="section_8_right_div_btn">
   							<a href="{{url('/teacher/register')}}">Join Our Team</a>
   						</div>		
   					</div>
   				</div>
   					
   			</div>
   		</div>
   </section>        
                       
       
    <section class="counter_section">
    	<div class="container">
    		
    		
    		<div class="row">
    			<div class="col-12 col-md-6 col-lg-6">
    				<div class="counter_section_left_div">
    					<div class="counter_section_left_div_heading_1">
    						<p>Learn something new</p>
    					</div>
    					
    					<div class="counter_section_left_div_heading_2">
    						<p>Level Up is an online learning destination and  our mission is to deliver high-quality educational content.Level Up is an online learning destination and  our mission is </p>
    					</div>
    				</div>
    			</div>
    			<div class="col-12 col-md-1 col-lg-1"></div>
    			<div class="col-12 col-md-5 col-lg-5">
    				
    				<div class="counter_section_right_div">
    					<div class="row">
    					     		 @foreach($counters as $count) 

    					    
    						<div class="col-12 col-md-6 col-lg-6">
    							<div class="counter_main_div">
									<div class="counter_iamge_div">
    						<img src="{{ asset('uploads/images/')}}/{{$count->images}}">
									</div>

									<div class="counter_number_div">
    				            @if($count->countt)	<span class="Count">
    				    	{{$count->countt}}</span><p class="counter_suffix">+</p>	@endif
									</div>

									<div class="counter_heading_div">
    						<p>{{$count->name}}</p>
									</div>
								</div>
    						</div>
    					
    					@endforeach	
    					</div>
    					
    					<div class="row counter_spacing_row">
    					      <?php 
    					            $count = App\Counter::orderBy('id','DESC')->limit(2)->get();

    					    ?>
    					        					        		 @foreach($count as $count1) 

    						<div class="col-12 col-md-6 col-lg-6">
    							<div class="counter_main_div">
									<div class="counter_iamge_div">
    						<img src="{{url('/')}}/public/uploads/images/{{$count1->images}}">
									</div>

									<div class="counter_number_div">
    				@if($count1->countt)	<span class="Count">	{{$count1->countt}}</span><p class="counter_suffix">+</p>	@endif
									</div>

									<div class="counter_heading_div">
    						<p>{{$count1->name}}</p>
									</div>
								</div>
    						</div>
    				@endforeach
    						
    						</div>
    				</div>
    				
    			</div>
    		</div>
    	
    	
    		
    	</div>
    </section>                                    
                                                              
                                                                                                          
   <section class="section_9">
   		<div class="container">
   			<div class="section_9_main_heading_1">
  			<p>Our Student have been <span>placed</span></p>
			</div>

			<div class="section_9_main_heading_2">
				<p>Level Up is an online learning destination and  our mission is to deliver high-quality educational content.</p>
			</div>	<?php $placed=App\Studentplaced_images::where('studentplaced_id',$studplaced->id)->get();?>
               
  		
  			<div class="section_9_logo_main_div">
  						@foreach($placed as $placed)	
  					<div class="section_9_logo_inner_div">
  										<img src="{{ asset('uploads/images/')}}/{{$placed->imagess}}">
					</div>
 			
 						@endforeach
  				
  				
 					
  				</div>
  				
  				
  				
  			</div>
   		
   </section>
              
              
   <section class="section_10">
   		<div class="container">
   			<div class="section_10_main_heading_1">
  			<p>Our <span>Partners</span></p>
			</div>

			<div class="partner_logo_div_main">
				@foreach($patners as $patner)

				<div class="partner_logo_div">
				    <img src="{{ asset('uploads/images/')}}/{{$patner->image}}">
				</div>
				@endforeach

			
				
			</div>
			
   		</div>
   </section>
              
              
    <section class="testimonial_section">
    	<div class="container">
    			
    			<div class="testimonial_section_main_div">
    			
    				<div class="testimonial_left_div">
    					<div class="testimonial_left_heading_1">
							<p>See What Our Students <br>Have To<span> Say</span></p>
    					</div>
    					<div class="testimonial_left_heading_2">
    						<p>Level Up is an online learning destination and  our mission is to deliver high-quality educational content.</p>
    					</div>
    				</div>

    			
    				<div class="testimonial_right_div">
    					<div class="testimonial_main_div">
					<div class="stories_items">
					    
					       @foreach($testimonial as $test)

						<div class="card">
							<div class="blog_card-body">
								<div class="testimonial_card_main_div">
									<div class="testimonial_quotes">
										<i class="fa fa-quote-left"></i>
									</div>
									<div class="testimonial_description">
										<p>{{$test->long_desc}}</p>
									</div>
									
									<div class="testimonial_name">
										<p>{{$test->name}}, <span>{{$test->short_desc}}</span></p>
									</div>
								</div>
							</div>
						</div>
   				
   				   				@endforeach

						
    				</div>
    			</div>
    		</div>
    	</div>
			
		</div>
    </section>          

   
     @endsection
    