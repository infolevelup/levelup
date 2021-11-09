  @extends('layouts.app')
@section('title','HOME')


@section('content')  
 
 
       
        <section class="breadcrumb_section">
	<div class="container">
		<div class="breadcrumb_section_div">
			<h2>Courses</h2>
			<p><a href="{{url('/')}}">Home </a>/ Courses</p>
		</div>
	</div>
</section>  
           
  
 <div class="courses_section_1">
 	<div class="container">
 	<!-- Navbar section -->

<div class="filter"> <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#mobile-filter" aria-expanded="true" aria-controls="mobile-filter">Filters<span class="fa fa-filter pl-1"></span></button>
</div>
<div id="mobile-filter">    
    <div class="border-bottom pb-2 ml-2">
        <h4 id="burgundy">Filters</h4>
    </div>
    <div class="py-2 border-bottom ml-3">
         <h6 class="font-weight-bold"><img src="images/options.png"> Category</h6>       
        
        <form>
             <?php 
                    $category=App\Category::where('status',1)->get();
                    
                    ?>
			 <?php $counter=0; ?>
                                @if(!empty($category))
                                @foreach ($category as $category)
			<div class="form-group">	
			<label class="textbox"  for="{{$category->id}}"><a href="{{url('/')}}/category/{{$category->slug}}">{{ucfirst($category->name)}}</a> 
		</label>	</div>
			
			  <?php $counter++; ?>
                                @endforeach
                                @endif
			
		
		           <div class="row m-0 causes_div">

                        </div>
        </form>
    </div>
    <div class="py-2 border-bottom ml-3">
        <h6 class="font-weight-bold">Popular Category</h6>       
        <form>
            <?php 
                    $cous=App\Category::where('status',1)->where('popular',1)->get();
                    
                    ?>
			 <?php $counter=0; ?>
                                @if(!empty($cous))
                                @foreach ($cous as $cous)
			<div class="form-group">	
			<label class="textbox"  for="{{$cous->id}}"><a href="{{url('/')}}/category/{{$category->slug}}"></a>{{ucfirst($cous->name)}}</a> </label>	</div>
			
			  <?php $counter++; ?>
                                @endforeach
                                @endif	
            
        </form>
        
    </div>
    
    <div class="py-2 border-bottom ml-3">
          <h6 class="font-weight-bold">Popular Coures</h6>        
        <form>
            
            <?php 
                    $pop=App\Course::where('published',1)->where('popular',1)->get();
                    
                    ?>
			 <?php $counter=0; ?>
                                @if(!empty($pop))
                                @foreach ($pop as $pop)
			<div class="form-group">	
			<label class="textbox"  for="{{$pop->id}}"><a href="{{url('/')}}/course/{{$pop->slug}}">{{ucfirst($pop->title)}} </a></label>	</div>
			
			  <?php $counter++; ?>
                                @endforeach
                                @endif
               </form>
    </div>

    
    <div class="py-2 ml-3">
         <h6 class="font-weight-bold">Featured Coures</h6>        
        <form>
          
           <?php 
                    $fea=App\Course::where('published',1)->where('featured',1)->get();
                    
                    ?>
			 <?php $counter=0; ?>
                                @if(!empty($fea))
                                @foreach ($fea as $fea)
			<div class="form-group">	
			<label class="textbox"  for="{{$fea->id}}"><a href="{{url('/')}}/course/{{$fea->slug}}">{{ucfirst($fea->title)}}</a> </label>	</div>
			
			  <?php $counter++; ?>
                                @endforeach
                                @endif
           
              </form>

    </div>
</div>
<!-- Sidebar filter section -->
	<section id="sidebar">    
    <div class=" ml-2">
        <h4 id="burgundy">Filters</h4>
    </div>
    
    <div class="new-classroom-box">
	
<div id="accordion" class="accordion-container">
  <h4 class="accordion-title js-accordion-title"><img src="{{url('/')}}/public/images/options.png"> Category</h4>
  <div class="accordion-content">
      <form>
          <ul>
             <?php 
                    $category=App\Category::where('status',1)->get();
                    
                    ?>
			 <?php $counter=0; ?>
                                @if(!empty($category))
                                @foreach ($category as $category)
            <li for="{{$category->id}}"><a href="{{url('/')}}/category/{{$category->slug}}">{{ucfirst($category->name)}}</a></li>
            
            <?php $counter++; ?>
                                @endforeach
                                @endif
            </ul>              
			
        </form>
  </div>
  <h4 class="accordion-title js-accordion-title"><img src="{{url('/')}}/public/images/popularity.png"> Popular Category</h4>
  <div class="accordion-content">
    <form>
        <ul>
            <?php 
                    $cous=App\Category::where('status',1)->where('popular',1)->get();
                    
                    ?>
			 <?php $counter=0; ?>
                                @if(!empty($cous))
                                @foreach ($cous as $cous)
			<li for="{{$category->id}}"><a href="{{url('/')}}/category/{{$category->slug}}"></a>{{ucfirst($cous->name)}}</a></li>
			
			  <?php $counter++; ?>
                                @endforeach
                                @endif	
            </ul> 
        </form>
  </div>
  
  <h4 class="accordion-title js-accordion-title"><img src="{{url('/')}}/public/images/online-learning.png"> Popular Coures</h4>
  <div class="accordion-content">
      <form>
         <ul>   
            <?php 
                    $pop=App\Course::where('published',1)->where('popular',1)->get();
                    
                    ?>
			 <?php $counter=0; ?>
                                @if(!empty($pop))
                                @foreach ($pop as $pop)
			<li for="{{$category->id}}"><a href="{{url('/')}}/course/{{$pop->slug}}">{{ucfirst($pop->title)}} </a></li>
			
			  <?php $counter++; ?>
                                @endforeach
                                @endif
      </ul>
      </form>
  </div>
  
  <h4 class="accordion-title js-accordion-title"><img src="{{url('/')}}/public/images/feature.png"> Featured Coures</h4>
  <div class="accordion-content">
     <form>
         <ul> 
           <?php 
                    $fea=App\Course::where('published',1)->where('featured',1)->get();
                    
                    ?>
			 <?php $counter=0; ?>
                                @if(!empty($fea))
                                @foreach ($fea as $fea)
			<li for="{{$category->id}}"><a href="{{url('/')}}/course/{{$fea->slug}}">{{ucfirst($fea->title)}}</a> </li>
			
			  <?php $counter++; ?>
                                @endforeach
                                @endif
           
            </ul>
              </form>
  </div>
</div>	
	
	</div>
   
   <!-- <div class="py-2 border-bottom ml-3 scrollbar-1 box-height" id="catFilters">
        <h6 class="font-weight-bold" >Category</h6>       
        
        <form>
             <?php 
                    $category=App\Category::where('status',1)->get();
                    
                    ?>
			 <?php $counter=0; ?>
                                @if(!empty($category))
                                @foreach ($category as $category)
			<div class="form-group">	
			<label class="textbox"  for="{{$category->id}}"><a href="{{url('/')}}/category/{{$category->slug}}">{{ucfirst($category->name)}}</a> 
		</label>	</div>
			
			  <?php $counter++; ?>
                                @endforeach
                                @endif
			
		
		           <div class="row m-0 causes_div">

                        </div>
        </form>
    </div> -->
   <!-- <div class="py-2 border-bottom ml-3 scrollbar-1 box-height">
        <h6 class="font-weight-bold">Popular Category</h6>       
        <form>
            <?php 
                    $cous=App\Category::where('status',1)->where('popular',1)->get();
                    
                    ?>
			 <?php $counter=0; ?>
                                @if(!empty($cous))
                                @foreach ($cous as $cous)
			<div class="form-group">	
			<label class="textbox"  for="{{$cous->id}}"><a href="{{url('/')}}/category/{{$category->slug}}"></a>{{ucfirst($cous->name)}}</a> </label>	</div>
			
			  <?php $counter++; ?>
                                @endforeach
                                @endif	
            
        </form>
    </div> -->
    
   <!-- <div class="py-2 border-bottom ml-3 scrollbar-1 box-height">
        <h6 class="font-weight-bold">Popular Coures</h6>        
        <form>
            
            <?php 
                    $pop=App\Course::where('published',1)->where('popular',1)->get();
                    
                    ?>
			 <?php $counter=0; ?>
                                @if(!empty($pop))
                                @foreach ($pop as $pop)
			<div class="form-group">	
			<label class="textbox"  for="{{$pop->id}}"><a href="{{url('/')}}/course/{{$pop->slug}}">{{ucfirst($pop->title)}} </a></label>	</div>
			
			  <?php $counter++; ?>
                                @endforeach
                                @endif
               </form>
    </div> -->
	
	<!--
	<div class="py-2 ml-3 scrollbar-1 box-height">
        <h6 class="font-weight-bold">Featured Coures</h6>        
        <form>
          
           <?php 
                    $fea=App\Course::where('published',1)->where('featured',1)->get();
                    
                    ?>
			 <?php $counter=0; ?>
                                @if(!empty($fea))
                                @foreach ($fea as $fea)
			<div class="form-group">	
			<label class="textbox"  for="{{$fea->id}}"><a href="{{url('/')}}/course/{{$fea->slug}}">{{ucfirst($fea->title)}}</a> </label>	</div>
			
			  <?php $counter++; ?>
                                @endforeach
                                @endif
           
              </form>
    </div> -->
</section>
<!-- products section -->
	<section id="products">
    <div class="container">
        <div class="d-flex flex-row pb-5">
            <div class="text-muted m-2" id="res">Showing  @if($courses->count() > 0) {{$courses->count()}} @endif results</div>
            <div class="ml-auto ">
                <div id="sorting" class="border rounded p-1 m-1"> <span class="text-muted">Sort by</span> <select name="sort" id="sortBy">
                                              <option value="">None</option>

                        <option value="popular"><b>Popularity</b></option>
                        <option value="priceL-H"><b>Price (Low-High)</b></option>
                        <option value="priceH-L"><b>Price(High-Low)</b></option>
                    </select> </div>
            </div>
        </div>
        <div class="row">      
		  @if($courses->count() > 0)

                                            @foreach($courses as $course)
		
		  
		  <?php 
		  
		  $lesson=App\Lesson::where('course_id',$course->id)->get();
		  $lessonCount = count($lesson);
            $batch=App\Batch::where('course_id',$course->id)->first();
		  ?>
		  @if($lessonCount >0)
           	<article class="col-12 col-md-4 col-lg-4">
				<div class="single_course">
                   <div class="course_head {{$course->color}} text-center">
                       @if($course->course_image)
                   <a href="{{url('/')}}/course/{{$course->slug}}"><img class="img-fluid" src="{{url('/')}}/public/uploads/course_images/{{$course->course_image}}" alt="" /></a></div>
                    @else
                                  <a href="{{url('/')}}/course/{{$course->slug}}"><img class="img-fluid" src="{{ asset('images/01.png')}}" alt="" /></a></div>
                

                    @endif
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
					   @if($course->type=='live class')
					   <span class="meta_info mr-1">
                       <a href="#"> <i class="fa fa-file-video-o"></i> Live Class</a></span>
                       @else					   <span class="meta_info mr-1">

                                              <a href="#"> <i class="fa fa-file-video-o"></i> Self paced</a></span>

                       @endif
                       <span class="meta_info mr-1">
                       <a href="#"> <i class="fa fa-clock-o"></i> 8 Weeks </a></span>
					    @if($batch)
					   <span class="meta_info mr-2">
                       <a href="#"> <i class="fa fa-calendar"></i>{{$batch->batch_name}}</a></span>
					   @endif
                       </div></div>
                 </div></div>
			</article>
			@endif
			
				@endforeach
           	@else
           	
           <p>No data found</p>
           	@endif
        </div>
        
        <div class="row">
           	<article class="col-12 col-md-12 col-lg-12">
				
					  <ul class="pagination pt-5">
					{{ $courses->links() }}
					  </ul>
				
				</article> 
        </div>
        
        
    </div>
</section>
 </div>   
                   
  </div>                  
                     
                    
                       
                        
                         
                          
                           
                            
         
     
     
     
   <div class="clearfix"></div>  
                          
                                                                                                          
   <section class="section_10">
   		<div class="container">	
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

$(document).ready(function() {
  
 $(document).on('click', '.category_checkbox', function () {
     
     
     var ids = [];

        var counter = 0;
       $('#catFilters').empty();
        $('.category_checkbox').each(function () {
            if ($(this).is(":checked")) {
                ids.push($(this).attr('id'));
                $('#catFilters').append(`<div class="alert fade show alert-color _add-secon" role="alert"> 
                ${$(this).attr('attr-name')}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> </div>`);
                counter++;
            }
        });


        $('._t-item').text('(' + ids.length + ' items)');

        if (counter == 0) {
            $('.causes_div').empty();
            $('.causes_div').append('No Data Found');
        } else {
            fetchCauseAgainstCategory(ids);
            
        }


    });
    
    
    
    
    
    
    
    
});


function fetchCauseAgainstCategory(id) {
//alert(id);
    $('.causes_div').empty();
        if (id!= "") {
                    location.href = '{{url()->current()}}?typee=' + id;
                } else {
                    location.href = '{{route('course.courseindex')}}';
                }
  @if(request('typee') != "")
            $('.category_checkbox').find('option[value="' + "{{request('typee')}}" + '"]').attr('selected', true);
            @endif
   /* $.ajax({
        type: 'GET',
        url: '{{url('/')}}/get_causes_against_category/' + id,
        success: function (response) {
            var response = JSON.parse(response);
            console.log(response);
            
            if (response.length == 0) {
                $('.causes_div').append('No Data Found');
            } else {
                response.forEach(element => {
                    $('.causes_div').append(`<div href="#" class="col-lg-4 col-md-6 col-sm-6 col-xs-12 r_Causes IMGsize">
                      
                          
                            <h3>${element.title}</h3>
                      
                    </div>`);
                });
            }
        }
    });
    */
}




 
    </script>
    
         <script type="text/javascript">
	 
	 $(function () {
  
	  $(".accordion-content:not(:first-of-type)").css("display", "none");  
	  $(".js-accordion-title:first-of-type").addClass("open"); 
	  $(".js-accordion-title").click(function () {
		$(".open").not(this).removeClass("open").next().slideUp(300);
		$(this).toggleClass("open").next().slideToggle(300);
	  });
	});
	

  
</script>
    
    
    
@endpush