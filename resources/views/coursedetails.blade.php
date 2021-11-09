@extends('layouts.app')


@section('content')



   
        
			<main id="main">
			<!-- heading banner -->
			<header class="heading-banner text-white {{$course->color}} bgCover">
				<div class="container holder">
					<div class="row">
					<article class="col-md-8">
					<div class="align">
						<h1>  {{$course->title}}</h1>
						     @if($course->trending == 1)
						<span class="udlite-badge udlite-badge-bestseller">Trending</span>
						@endif
						    @if($course->featured == 1)
						<span class="udlite-badge udlite-badge-bestseller">Featured</span>
						@endif
						@if($course->popular == 1)
						<span class="udlite-badge udlite-badge-bestseller">Popular</span>
						@endif
							@if($course->free == 1)
						<span class="udlite-badge udlite-badge-bestseller">free</span>
						@endif
						<span class="star-number">{{$course_rating}}</span>												
						<ul class="star-rating list-unstyled">
					
			            	 @for($r=1; $r<=$course_rating; $r++)
                            	<li><span class="fa fa-star"><span class="sr-only">star</span></span></li>
                            @endfor
						</ul>
						<span class="">({{$total_ratings}} ratings)</span>	
					</div>
					
		  <?php 
		  
		  $lesson=App\Lesson::where('course_id',$course->id)->get();
		  $lessonCount = count($lesson);
            $batch=App\Batch::where('course_id',$course->id)->first();
		  ?>
					    <div><ul class="list-unstyled course-list">
								<li><i class="fa fa-book"></i> Lessons: {{$lessonCount}}</li>
								@if($course->type=='live class')
								<li><i class="fa fa-file-video-o"></i> Live Class</li>
								@else
																<li><i class="fa fa-file-video-o"></i>Self Peaced Class</li>

@endif								
								<li><i class="fa fa-clock-o"></i> 8 Weeks</li>
								@if($batch)
								<li><i class="fa fa-calendar"></i> {{$batch->batch_name}}</li>								
							    @endif
							</ul></div>
					<ul class="list-unstyled course-list">
				     <?php 
					    $counter =App\Counter::OrderBy('id','ASC')->limit(3)->get();
					    ?>
					    @foreach($counter as $counter)
				    <li><span>{{$counter->countt}} +</span> {{$counter->name}}</li>
				
					@endforeach
				    </ul>
					
					
						</article>
					</div>
				</div>
			</header>
			<!-- breadcrumb nav -->
			
			<!-- two columns -->
			<div id="two-columns" class="container">
				<div class="row">
					<!-- content -->
					<article id="content" class="col-xs-12 col-md-7">
						
	<div>    
    <div class="tabpanel">
		
        <input type="radio" name="tab" id="tabpanel__tab-1" class="tabpanel__tab" checked="checked"/>
        <label for="tabpanel__tab-1" class="tabpanel__tablabel">Overview</label>
        <input type="radio" name="tab" id="tabpanel__tab-2" class="tabpanel__tab" />
        <label for="tabpanel__tab-2" class="tabpanel__tablabel">Curriculum</label>
        <input type="radio" name="tab" id="tabpanel__tab-3" class="tabpanel__tab" />
        <label for="tabpanel__tab-3" class="tabpanel__tablabel">Schedules</label>
  <!--  <input type="radio" name="tab" id="tabpanel__tab-4" class="tabpanel__tab" />
        <label for="tabpanel__tab-4" class="tabpanel__tablabel">Certificate</label>-->
        <input type="radio" name="tab" id="tabpanel__tab-5" class="tabpanel__tab" />
        <label for="tabpanel__tab-5" class="tabpanel__tablabel">Course Benefits</label>
	<!--<input type="radio" name="tab" id="tabpanel__tab-6" class="tabpanel__tab" />
        <label for="tabpanel__tab-6" class="tabpanel__tablabel">Instructors</label> -->
		<input type="radio" name="tab" id="tabpanel__tab-7" class="tabpanel__tab" />
        <label for="tabpanel__tab-7" class="tabpanel__tablabel">FAQ</label>
		<input type="radio" name="tab" id="tabpanel__tab-8" class="tabpanel__tab" />
        <label for="tabpanel__tab-8" class="tabpanel__tablabel">Review</label>
		

        <div class="tabpanel__panels">
            <div class="tabpanel__panel" id="tabpanel__panel-1">
                <div class="media">                    
                    <div class="media__body">
                                             
					        <p>  {!! $course->description !!}</p>
					</div>
                </div>
                
            </div>
            <div class="tabpanel__panel" id="tabpanel__panel-2">
                <div class="media">                    
                    <div class="media__body">
                      <h2>Curriculum</h2>
						<!-- sectionRow -->
						
					 @if(count($lessons)  > 0)
                                    @php $count = 0; @endphp
                                 
						<section class="sectionRow">
						    
							<h2 class="h6 text-uppercase fw-semi rowHeading">Section-{{$count}}:  {{$course->title}}</h2>
							<!-- sectionRowPanelGroup -->
							<div class="panel-group sectionRowPanelGroup" id="accordion" role="tablist" aria-multiselectable="true">
								<!-- panel -->
								   @foreach($lessons as $lessons)
                                  <?php 
                                 
                                  $less=App\Lesson::where('id',$lessons->lesson_id)->first();
                                  
                                  ?>
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingOne">
										<h3 class="panel-title fw-normal">
											<a class="accOpener" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$count}}" aria-expanded="false" aria-controls="collapseOne">
												<span class="accOpenerCol">
													<i class="fa fa-chevron-circle-right accOpenerIcn"></i><i class="fa fa-play-circle inlineIcn"></i> {{$less->title}}
													<!--<span class="label label-primary text-white text-uppercase">Video</span>-->
												</span>
												<span class="accOpenerCol hd-phone">
													<span class="tagText bg-primary fw-semi text-white text-uppercase">preview</span>
													<!--<time datetime="2011-01-12" class="timeCount">17 Min</time>-->
												</span>
											</a>
										</h3>
									</div>
									<!-- collapseOne -->
									<div id="collapse{{$count}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
										<div class="panel-body">
											<p>
											   {!!$less->short_text!!} 
											    
											</p>
										</div>
									</div>
								</div>
							
							
							
							
							
								@php $count++; @endphp
						@endforeach
							
							</div>
						</section>
						
				
						@endif
						
                    </div>
                </div>                
            </div>
            <div class="tabpanel__panel" id="tabpanel__panel-3">
                <div class="media">                               
                    <div class="media__body">
                        @if($course->schedule)
                        <p>{!! $course->schedule !!}</p>
                        @else
                        <p>No schedules for this course</p>
                        @endif
                    </div>
                </div>
            </div>
        <!--    <div class="tabpanel__panel" id="tabpanel__panel-4">
                <div class="media">                    
                    <div class="media__body">
                        @if($course->certificate)
                        <h2>Certificate</h2>
                        <p><img src="{{url('/')}}/public/uploads/course_images/{{$course->certificate}}"></p>
                        @else
                        <p>No certificate for this course</p>
                        @endif
                    </div>
                </div>
            </div> -->
            <div class="tabpanel__panel" id="tabpanel__panel-5">
                <div class="media">                    
                    <div class="media__body">
                        @if($course->benefits)
                        <h2>Benefits</h2>
                        <p>{!!$course->benefits!!}</p>
                        @else
                        No benefits for this course
                        @endif
                    </div>
                </div>
            </div>
		<!--	<div class="tabpanel__panel" id="tabpanel__panel-6">
                <div class="media">                    
                    <div class="media__body">
                        <h2>Creation</h2>
                        <p>Charlie was created by InGen as an attraction for the IBRIS Project. She is the youngest of the park's Velociraptor pack consisting of Blue, Delta, and Echo. Her skin pattern is the result of using Green Iguana DNA in his genetic coding. In her birth, Owen Grady imprinted on her and trained her along with her siblings.</p>
                    </div>
                </div>
            </div> -->
			<div class="tabpanel__panel" id="tabpanel__panel-7">
                <div class="media">                    
                    <div class="media__body">
                        <h2>Course FAQ</h2>
                        <p>
                            	<section class="sectionRow">
							<?php 
							
							$faq=App\Course_FAQ::where('course_id',$course->id)->get();
							$i=1;
							?>
							<!-- sectionRowPanelGroup -->
							@if(count($faq))
							
							<div class="panel-group sectionRowPanelGroup" id="accordion{{$i}}" role="tablist" aria-multiselectable="true">
							@foreach($faq as $faq)
							
								<!-- panel -->
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="heading2One">
										<h3 class="panel-title fw-normal">
											<a class="accOpener" role="button" data-toggle="collapse" data-parent="#accordion{{$i}}" href="#collapse{{$i}}One" aria-expanded="false" aria-controls="collapse2One">
												<span class="accOpenerCol">
													<i class="fa fa-chevron-circle-right accOpenerIcn"></i><i class="fa fa-play-circle inlineIcn"></i>
													{!!$faq->question!!}
												</span>
											
											</a>
										</h3>
									</div>
									<!-- collapseOne -->
									<div id="collapse{{$i}}One" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2One">
										<div class="panel-body">
											<p>
											  {!!$faq->answer!!}  
											</p>
										</div>
									</div>
								</div>
								<?php $i++; ?>
							@endforeach
							</div>
							@else
							<p>No FAQ's for this course</p>
							@endif
						</section> 
                            
                        </p>
                    </div>
                </div>
            </div>
			<div class="tabpanel__panel" id="tabpanel__panel-8">
                <div class="media">                    
                    <div class="media__body">
                         @if(empty(Auth::check()))
                   <p>Please login to give review </p>
                   <a href="{{url('/')}}/login" class="btn-login">Login </a>
                        @else
                             
                        <div>
<div>
    <div class="offer-dedicated-body-left">
        <div class="tab-content" id="pills-tabContent">
            
            
            <div class="tab-pane fade active show" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
                
                <div class="bg-white rounded shadow-sm p-4 mb-4 clearfix graph-star-rating">
                    <h5 class="mb-0 mb-4">Ratings and Reviews</h5>
                    <div class="graph-star-rating-header">
                    
                        
                        <div class="star-rating">
                            @for($r=1; $r<=$course_rating; $r++)
                            <a href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
                            @endfor
                            <b class="text-black ml-2">{{$total_ratings}}</b>
                        </div>
                        
                       
                        
                        <p class="text-black mb-4 mt-2">Rated {{$course_rating}} out of 5</p>
                        
                        
                    </div>
                    
                      
                    
                    
                    
                    <div class="graph-star-rating-body">
                   
                     @for($r=5; $r>=1; $r--)
                  <?php   
                  $rating5=App\Rating::where('rating',$r)->where('course_id',$course->id)->where('status','approve')->get();
                  if($rating5 === null){
       $rating5count=$rating5->count();
       
         $star5= ($rating5count*100/$total_ratings);
                    ?>
                        <div class="rating-list">
                            <div class="rating-list-left text-black">
                               {{$r}} Star
                            </div>
                            <div class="rating-list-center">
                                <div class="progress">
                                    <div style="width:  {{$star5}}%" aria-valuemax="" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                        <span class="sr-only"> {{$star5}}% Complete (danger)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="rating-list-right text-black"> {{$star5}}%</div>
                        </div>
                        
                       
               <?php        
                }
                     ?>  @endfor
                   
                    </div>
                    <div class="graph-star-rating-footer text-center mt-3 mb-3">
                        <button type="button" class="btn btn-outline-primary btn-sm">Rate and Review</button>
                    </div>
                </div>
               @if(isset($review) || ($is_reviewed == false)) 
                <div class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
                    <h5 class="mb-4">Leave Comment</h5>
                    <p class="mb-2">Rate the Place</p>
                    <div class="mb-4">
                        <span class="star-rating">
                                 <a href="#"><i class="fa fa-star icon-size" aria-hidden="true"></i></a>
                                 <a href="#"><i class="fa fa-star icon-size" aria-hidden="true"></i></a>
                                 <a href="#"><i class="fa fa-star icon-size" aria-hidden="true"></i></a>
                                 <a href="#"><i class="fa fa-star icon-size" aria-hidden="true"></i></a>
                                 <a href="#"><i class="fa fa-star icon-size" aria-hidden="true"></i></a>
                                 </span>
                    </div>
                    <form>
                        <div class="form-group">
                            <label>Your Comment</label>
                            <textarea class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm" type="button"> Submit Comment </button>
                        </div>
                    </form>
                </div>
                
                @endif
            </div>
            
            
            
            
               </div>
    </div>
</div>
</div>
                        
                        
                        
                  
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
	</div>			
	</article>












					<!-- sidebar -->
					<aside class="col-xs-12 col-md-4" id="sidebar">
						<!-- widget course select -->
						<section class="widget widget_box widget_course_select">
							<header class="widgetHead text-center bg-theme">
							    	<?php 
							    	$video =App\Media::where('course_id',$course->id)->first();
							    	?>	
							    	@if($video->type=='youtube')
							    	<?php 
$url= $video->url;

parse_str( parse_url( $url, PHP_URL_QUERY ), $youtube_id_v ); 
//echo $youtube_id_v['v'] . "\n"; 

?> 
								<iframe width="100%" height="315" 
							src="https://www.youtube.com/embed/<?php echo $youtube_id_v['v'];?>"
								title="YouTube video player" frameborder="0" 
								allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								@endif
															    	@if($video->type=='embed')

									<iframe width="100%" height="185" src="{{$video->url}}" frameborder="0" 
									allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  						@endif
  					
								
								
								
							</header>
						
							<h4>Preview this course</h4>
							<strong class="price element-block font-lato">Price: ₹ {{$course->price}}</strong>
							
							<form action="{{ route('cart.checkout') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="course_id" value="{{ $course->id }}"/>
                                            <input type="hidden" name="amount" value="{{($course->free == 1) ? 0 : $course->price}}"/>
                                            <button class="btn btn-bynow"
                                                    href="#">Buy Now</button>
                                        </form>
							<h5>This course include</h5>
							<ul class="list-unstyled font-lato">
								<li><i class="fa fa-user icn no-shrink user"></i> 199 Students</li>
								<li><i class="fa fa-language icn no-shrink language"></i> Language - English</li>
								<li><i class="fa fa-mobile icn no-shrink access"></i> Access on Desktop & Tablet</li>
								<li><i class="fa fa-clock-o icn no-shrink lifetime"></i> Full lifetime access</li>
								<li><i class="fa fa-address-card icn no-shrink certificate"></i> Certificate of Completion</li>
							</ul>
						</section>
						
						
						
					</aside>
				</div>
			</div>
		</main>
		<!-- footer area container --> 

    
     <div class="clearfix"></div> 

	 
     <article class="talk-experts">
	 <div class="container">
<div id="fh5co-main">
<div class="fh5co-narrow-content animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
				
				<div class="row">
					<div class="col-md-4 col-md-offset-1">
						<h1>Talk to Our Experts</h1>
					</div>          
				</div>
	        @if(Session::has('flash_success'))
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                  {{ Session::get('flash_success') }}
                  </div>
              @endif
              @if(Session::has('flash_error'))
                  <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                  {{ Session::get('flash_error') }}
                  </div>
              @endif
				<form action="{{url('/')}}/courseenquiry" method="post">
				    @csrf
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div class="row">
								<div class="col-md-6">
								    <input type="hidden" name="course_name" value="{{ $course->title }}">
									<div class="form-group">
										<input type="text" class="form-control" name="name" placeholder="Name" required>
									</div>
									<div class="form-group">
										<input type="email" class="form-control" name="email" placeholder="Email" required>
									</div>
									<div class="form-group">
										<input type="number" class="form-control" name="phone" placeholder="Phone" required>
									</div>
									<div class="form-group">
										<input type="date" class="form-control" name="date" placeholder="Preferred Date of Call Back" required>
									</div>
									
								</div>
								<div class="col-md-6">
								<div class="form-group">
										<input type="time" class="form-control" name="time_to_call_back" placeholder="Preferred Time of Call Back" required>
									</div>
									<div class="form-group">
										<input type="text" class="form-control" name="course_name" value="{{ $course->title }}" placeholder="Specific Course Name" readonly>
									</div>
									
									<div class="form-group">
										<textarea  id="message" cols="30" rows="7" name="message" class="form-control" placeholder="Message"></textarea>
									</div>
									<div class="form-group">
										<input type="submit" class="btn btn-primary btn-md" value="Send Message">
									</div>
								</div>
								
							</div>
						</div>
						
					</div>
				</form>
			</div>
</div>
</div>
	 
	 
	 </article>
     
       <section class="future-section">
	   <div class="container">
		<div class="row">
		<article class="col-lg-12">
		<h2>Future of Level Up</h2></article>
	<?php $future=App\Future::all(); ?>
	    @foreach($future as $future)
		<article class="col-lg-4">
		<div class="boxIn">		
		<p>{!!$future->description!!}</p>
		</div>
		</article>
		@endforeach
		
	<!--	<article class="col-lg-4">
		<div class="boxIn">		
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
		</div>
		</article>
		
		<article class="col-lg-4">
		<div class="boxIn">		
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
		</div>
		</article>----->
		
		
		</div>
		</div>                      
      </section>
                                                                                                        
   

@endsection