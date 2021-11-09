 @extends('layouts.app')
 
 @section('content')  
 
 
 
         
       <section class="breadcrumb_section">
	<div class="container">
		<div class="breadcrumb_section_div">
			<h2>Our Company</h2>
			<p>Home / Our Company</p>
		</div>
	</div>
</section>  
          
        
  <section class="general_section_1">
  	<div class="container">
  		<div class="general_section_1_div_main">
  			
  			
  			
  			
  			
  		
  			
  			
  			
  			 <div class="row">
            <div class="col-md-3">
                <!-- Tabs nav -->
                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <?php $i=1;
                    ?>
                    @foreach($page as $page)
                    <a class="nav-link mb-3 p-3 shadow @if($i==1)active @endif" id="v-pills-home-tab{{$i}}" data-toggle="pill" href="#v-pills-home{{$i}}" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <i class="{{$page->icon}}"></i>
                        <span class="font-weight-bold small text-uppercase">{{$page->title}}</span></a>
                        <?php $i++; ?>
                    @endforeach
                  

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                        <i class="fa fa-check mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">FAQ</span></a>
                        
                    </div>
            </div>


            <div class="col-md-9">
                
                <!-- Tabs content -->
                <div class="tab-content" id="v-pills-tabContent">
                    <?php $i=1;
                    ?>
                    @foreach($page1 as $page)
                    <div class="tab-pane fade shadow rounded bg-white @if($i==1)show active @endif p-5" id="v-pills-home{{$i}}" role="tabpanel" aria-labelledby="v-pills-home-tab{{$i}}">
                        <h4 class="font-italic mb-4">{{$page->title}}</h4>
                        <p class="font-italic text-muted mb-2">
                            {!!$page->content!!}
                            </p>
                             </div>
                  <?php $i++; ?>
                    @endforeach   
                  
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <h4 class="font-italic mb-4">FAQ</h4>
                        <div id="accordion">
                          <?php 
                       
                          $j=1;
                          ?>
                          @foreach($faq as $faq)
                          <div class="card">
                            <div class="card-header" id="headingOne">
                              <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne{{$j}}" aria-expanded="true" aria-controls="collapseOne{{$j}}">
                                  {{$faq->qustion}} #{{$j}}
                                </button>
                              </h5>
                            </div>
                        
                            <div id="collapseOne{{$j}}" class="collapse @if($j==1)show @endif" aria-labelledby="headingOne" data-parent="#accordion">
                              <div class="card-body">
                               {!!$faq->answer!!}
                                 </div>
                            </div>
                          </div>
                          <?php $j++;
                          ?>
                          @endforeach
                          
                        </div> 
                        
                        
                        
                        
                        
                        
                        
                        </div>
                                       
                </div>
            </div>
            
			</div>
            
            
            
  			

  		</div>
  	</div>
  </section>         
        
        
        
     
   <div class="clearfix"></div>  
 
 
 
 
 
 @endsection
 
 
@push('after-scripts')

@endpush