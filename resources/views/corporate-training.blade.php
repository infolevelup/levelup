 @extends('layouts.app')
 
 @section('content')  
          
        
        
<section class="breadcrumb_section_inner">
	<div class="container">
		<div class="breadcrumb_section_main_div">
		<!--	<div class="breadcrumb_heading_1">
				<p>Corporate Traning</p>
			</div>
			<div class="blueunderline"></div>-->
		<!--	<div class="breadcrumb_heading_2">
				<p>Corporate Traning</p>
			</div>-->
			
			<div class="breadcrumb_heading_3">
				<p>Corporate Traning</p>
			</div>
			
			<div class="breadcrumb_heading_btn">
				<a href="#training">Contact Us</a>
			</div>
			
		</div>
	</div>
</section>
       
       
<section class="corporate_section_1">
	<div class="container">
		<div class="corporate_section_1_div_1">
			<ul>
				<li class="trustedtxt">Trusted by</li>
		<?php $corp=App\Corporate::all(); ?>
		@foreach($corp as $corp)
				<li>
					<img src="{{url('/')}}/public/uploads/images/{{$corp->image}}" style="width:30%;hieght:30%;">
				</li>
		@endforeach
			</ul>
		</div>
	</div>
</section>    
       
       
 <section class="corporate_section_2">
 	<div class="conatiner">
 		<div class="corporate_section_2_heading_main">
 			<h2>Explore more resources to drive skills-first learning</h2>
 		</div>
 		
 		
 	</div>
 </section>
      
          
          
          
          
          
           
    <section class="corporate_section_4">
  		<div class="container">
  			<div class="corporate_section_4_div_main">
  				<div class="row">
  					<div class="col-12 col-md-3 col-lg-3">
  						<div class="corporate_section_4_div_main_left scrollbar-1">
  						    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  						    <?php $course=App\Category::where('status','1')->get();
  						    $i=1;?>  
  						    @foreach($course as $course)    
                              <a class="nav-link @if($i==1) active @endif" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home{{$i}}" role="tab" >{{$course->name}}</a>
                              <?php $i++; ?>
                            @endforeach
                            </div>
  							<ul>
  						</div>
  					</div>
					
  				<div class="col-12 col-md-9 col-lg-9">
  				    <div class="tab-content" id="v-pills-tabContent">
                  
                   <?php $course1=App\Category::where('status','1')->get();
  						    $i=1;?>  
  						    @foreach($course1 as $course1) 
                  <div class="tab-pane fade show @if($i==1) active @endif" id="v-pills-home{{$i}}" role="tabpanel" aria-labelledby="v-pills-home-tab">
                      
                      <?php 
                      $crs=App\Course::where('corporate',1)->where('category_id',$course1->id)->get();
                      ?>
                      
                      @if($crs->count()>0)
                      @foreach($crs as $crs)
                            
                            
                            <article class="col-12 col-md-4 col-lg-4">
				<div class="single_course">
                   <div class="course_head section-color-1 text-center">
                   <a href="#training"><img class="img-fluid" src="{{url('/')}}/public/uploads/course_images/{{$crs->course_image}}" alt="" /></a></div>
                    
					<div class="course_content">                                                         
                    <h4><a href="#training">{{$crs->title}}</a></h4> 
					<div class="">
					<?php 
					$total_ratings=App\Rating::where('course_id',$crs->id)->where('status','approve')->get()->count();
					$course_rating=App\Rating::where('course_id',$crs->id)->where('status','approve')->avg('rating');

					?>
					      
					<div class="">
					@for($r=1; $r<=$course_rating; $r++)
                       
					<span class="fa fa-star checked"></span>
				    @endfor
                           
					<span class="star_text">5.0 ({{$total_ratings}} Rating)</span>
					</div>                
					  
                 </div></div>
			    </article>
                            
                        @endforeach                      
                      @else
                      <p>No Courses</p>
                      @endif
                  </div>
                  <?php $i++;?>
                        @endforeach
                  
                  </div>
  				    
  				    
  							
  							
  							
  						</div>
  					</div>
  				</div>		
  		</div>
  </section>                 
   
       
       
  
       
     <section class="corporate_section_5" id="training">
     	<div class="container">
     		<div class="row">
     			<div class="col-12 col-md-1 col-lg-1"></div>
     			<div class="col-12 col-md-10 col-lg-10">
     				<div class="corporate_section_5_main_div">
     					<div class="corporate_section_5_main_div_heading">
     						<h2>Talk to our training advisor</h2>
     					</div>
     					
     					<div class="blueunderline_form"></div>
     					
     					<div class="corporate_section_5_form_div">
     						<form action="{{url('/')}}/corporate"  method="post">
     						    @csrf
                            <div class="form-group">
                               <label>Name</label>
                                <input type="text" class="form-control" name="name" id="contact-name" placeholder="Name" required>
                            </div>
                            
                            
                            <div class="row">
                            	<div class="col-12 col-md-6 col-lg-6">
                            		<div class="form-group">
                               		<label>Company Name</label>
                                		<input type="text" class="form-control" name="company_name" id="company-name" placeholder="Company Name" required>
                            		</div>
                            	</div>
                            	<div class="col-12 col-md-6 col-lg-6">
                            		<div class="form-group">
                           		<label>Training Need</label>
										<select id="appointment_time" name="reason" class="form-control" required>
											<option value="">--Select An Option--</option>
											<option value="for-corporate">For Corporate</option>
											<option value="for-myself">For Myself</option>
										</select>
                            		</div>
                            	</div>
                            </div>
                            
                            <div class="row">
                            	<div class="col-12 col-md-6 col-lg-6">
                            		<div class="form-group">
                               		<label>Email ID</label>
                                		<input type="email" class="form-control" id="contact-email" name="email" placeholder="Email" required>
                           			 </div>
                            	</div>
                            	<div class="col-12 col-md-6 col-lg-6">
                            		<div class="form-group">
                            		<label>Phone Number</label>
										<input type="tel" id="contact-phone" class="form-control" name="phone" pattern="[0-9]{10}" placeholder="Phone" required>
									</div>
                            	</div>
                            </div>
                            
                            <div class="form-group">
                               <label>Query</label>
                                <textarea class="form-control" name="message" id="message" cols="30" rows="6" placeholder="Enter Your Query" tabindex="1" style="overflow: hidden; outline: none;" ></textarea>
                            </div>
                            <button type="submit" name="submit" class="btn hospital-btn btn_contact-uS_SEcN">Submit</button>
                        </form>
     					</div>
     				</div>
     			</div>
     			<div class="col-12 col-md-1 col-lg-1"></div>
     		</div>
     	</div>
     </section>  
       
 
                       
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