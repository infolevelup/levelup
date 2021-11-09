 @extends('layouts.app')
 
 @section('content')  
 
 
 
  
  
         
        <section class="breadcrumb_section">
	<div class="container">
		<div class="breadcrumb_section_div">
			<h2>Labs</h2>
			<p>Home / Labs</p>
		</div>
	</div>
</section>  
          
           
            
  <section class="lab_section_1">
  	<div class="container">
  		<div class="lab_section_1_div">
  			<div class="row">
  			
  			@if($lab->count()>0)
  			@foreach($lab as $lab)
  				<div class="col-12 col-md-4 col-lg-4">
  					<div class="lab_section_1_div_video_div">
  					    
  					    @if($lab->type=='youtube')
  					    					    	<?php 
$url= $lab->video;

parse_str( parse_url( $url, PHP_URL_QUERY ), $youtube_id_v ); 
//echo $youtube_id_v['v'] . "\n"; 

?> 
  						<iframe width="100%" height="195" src="https://www.youtube.com/embed/<?php echo $youtube_id_v['v'];?>" title="YouTube video player"
  						frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  						<h2>{{$lab->title}}</h2>
  					@else
  						<iframe width="100%" height="195" src="{{$lab->video}}" title="YouTube video player"
  						frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  						<h2>{{$lab->title}}</h2>
  						@endif
  						
  					
  						
  						
  						
  					</div>
  				</div>
  			@endforeach
  			
  			@else
  			<p>No labs </p>
  			@endif
  			

  				
  			</div>
  			
  			
  			
  	
  			
  			
  		</div>
  	</div>
  </section>           
              
               
                
                
   <div class="clearfix"></div>  
 
 
 
 
 
 @endsection
 
 
@push('after-scripts')

@endpush