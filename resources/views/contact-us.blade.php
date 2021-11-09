 @extends('layouts.app')
 
 @section('content')  
 
 
 
 
 
 
    
         
    <section class="breadcrumb_section">
	<div class="container">
		<div class="breadcrumb_section_div">
			<h2>Contact Us</h2>
			<p>Home / Contact Us</p>
		</div>
		</div>
	</section>  
	
	<section class="contact_info_container">		
			<div class="container">
				<div class="row">

					<!-- Contact Form -->
					<div class="col-lg-6">
					        @if(Session::has('flash_successgeneral'))
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                  {{ Session::get('flash_successgeneral') }}
                  </div>
              @endif
              @if(Session::has('flash_errorgeneral'))
                  <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                  {{ Session::get('flash_errorgeneral') }}
                  </div>
              @endif
						<div class="contact_form">
							<div class="contact_info_title">General Form</div>
							<div>
							<form action="{{url('/')}}/generalform" method="post" class="comment_form">
							    @csrf
								<div>
									<div class="form_title">Name</div>
									<input type="text" class="comment_input" name="name" required="required">
								</div>
								<div>
									<div class="form_title">Mobile No</div>
									<input type="number" class="comment_input" name="mobile" required="required">
								</div>
								<div>
									<div class="form_title">Email</div>
									<input type="email" class="comment_input" name="email" required="required">
								</div>
								<div>
									<div class="form_title">Subject</div>
									<input type="text" class="comment_input" name="subject" required="required">
								</div>
								<div>
									<div class="form_title">Message</div>
									<textarea class="comment_input comment_textarea" name="message" required="required"></textarea>
								</div>
								<div>
									<button type="submit" class="comment_button trans_200">submit now</button>
								</div>
							</form></div>
						</div>
					</div>

					<!-- Contact Info -->
					<div class="col-lg-6">
					    <?php 
					    
					    $contact=App\Contact::where('id',23)->first();
					    ?>
						<div class="contact_info">
							<div class="contact_info_title">Contact Info</div>
							<div class="contact_info_text">
								<p>Get in touch with us for more information.</p>
							</div>
							<div class="contact_info_location">
								<div class="contact_info_location_title">Head Office</div>
								<ul class="location_list">
									<li><i class="fa fa-map-signs" aria-hidden="true"></i> <p>{{$contact->address}}</p></li>
									<li><i class="fa fa-volume-control-phone" aria-hidden="true"></i> <p>{{$contact->phone}}</p></li>
									<li><i class="fa fa-at" aria-hidden="true"></i> <p>{{$contact->email}}</p></li>
								</ul>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		
		
	</section>
	
	
	<section class="map-area">
	<div class="container-fluid">
	<div class="row">
	<!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d497699.9973874144!2d77.35074421903857!3d12.95384772557775!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae1670c9b44e6d%3A0xf8dfc3e8517e4fe0!2sBengaluru%2C%20Karnataka!5e0!3m2!1sen!2sin!4v1622025262100!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
-->
{!!$contact->map_link!!}
</div>	</div>
	</section>
		        @if(Session::has('flash_successfeedback'))
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                  {{ Session::get('flash_successfeedback') }}
                  </div>
              @endif
              @if(Session::has('flash_errorfeedback'))
                  <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                  {{ Session::get('flash_errorfeedback') }}
                  </div>
              @endif
	
	<section class="contact_info_container">		
			<div class="container">
				<div class="row">

					<!-- Contact Form -->
					<div class="col-lg-6">
						<div class="contact_form">
								<div class="contact_info_title">Feedback Form</div>
							<div>
							<form action="{{url('/')}}/feedback" method="post" class="comment_form">
					            @csrf
					                 @if(Session::has('flash_success2'))
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                  {{ Session::get('flash_success2') }}
                  </div>
              @endif
              @if(Session::has('flash_error2'))
                  <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                  {{ Session::get('flash_error2') }}
                  </div>
              @endif
								<div>
									<div class="form_title">Name</div>
									<input type="text" class="comment_input" name="name" required="required">
									  @if ($errors->has('name'))
                <div class="error">
                    {{ $errors->first('name') }}
                </div>
                @endif
								</div>
								<div>
									<div class="form_title">Mobile No</div>
									<input type="number" class="comment_input" name="phone" required="required">
									  @if ($errors->has('phone'))
                <div class="error">
                    {{ $errors->first('phone') }}
                </div>
                @endif
								</div>
								<div>
									<div class="form_title">Email</div>
									<input type="email" class="comment_input" name="email" required="required">
									  @if ($errors->has('email'))
                <div class="error">
                    {{ $errors->first('email') }}
                </div>
                @endif
								</div>
								<div>
									<div class="form_title">Message</div>
									<textarea class="comment_input comment_textarea" name="message" required="required"></textarea>
									  @if ($errors->has('message'))
                <div class="error">
                    {{ $errors->first('message') }}
                </div>
                @endif
								</div>	
								<div>
									<button type="submit" class="comment_button trans_200">submit now</button>
								</div>
							</form></div>
						</div>
					</div>
					
					
					
					<!-- Contact Form -->
					<div class="col-lg-6">
						<div class="contact_form">
								<div class="contact_info_title">Enquiry Form</div>
							<div>
								<form action="{{url('/')}}/enquiry" method="post" class="comment_form">
					            @csrf
					                    @if(Session::has('flash_successenquiry'))
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                  {{ Session::get('flash_successenquiry') }}
                  </div>
              @endif
              @if(Session::has('flash_errorenquiry'))
                  <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                  {{ Session::get('flash_errorenquiry') }}
                  </div>
              @endif
								<div>
									<div class="form_title">Name</div>
									<input type="text" class="comment_input" name="name" required="required">
								</div>
								<div>
									<div class="form_title">Mobile No</div>
									<input type="number" class="comment_input" name="phone" required="required">
								</div>
								
								<div>
									<div class="form_title">Enquiry</div>
									<select  class="comment_input" name="enquiry" required>
									  <option>-- Select Enquiry --</option>
									  <option value="course">Course</option>
									  <option value="corporate">Corporate Training</option>
									  <option value="media">Media</option>									  
									</select>
								</div>
								<div>
									<div class="form_title">Email</div>
									<input type="email" class="comment_input" name="email" required="required">
								</div>					
								<div>
									<button type="submit" class="comment_button trans_200">submit now</button>
								</div>
							</form></div>
						</div>
					</div>

					
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