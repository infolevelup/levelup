
<?php 

$user=App\User::where('id',Auth::user()->id)->first();
?>
 <div class="header_section">
            <div class="container">
               <div class="containt_main">
                 <div class="logo_header_div">
                 	<a href="{{url('/')}}"><img src="{{url('/')}}/public/images/logo.png"></a>
                 </div>
                 
                                  
                 <div id="menu_area">
		<div class="container">
        <div class="row">
            <nav class="navbar navbar-light navbar-expand-lg mainmenu">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">  
                        
                        <li class="dropdown">
							<div class="menu-icon"> <img src="{{ asset('images/Categories_icon.png')}}"></div>
                            <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Categories</a>
                            <?php  $category=App\Category::where('status',1)->get(); ?>
                            
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                             @foreach($category as $course1)
							<?php  $course=App\Course::where('category_id',$course1->id)->where('published',1)->get();?>
                             @if(!(App\Course::where('category_id',$course1->id)->where('published',1)->exists()))
                             
                            <li><a href="{{url('/')}}/category/{{$course1->slug}}">{{$course1->name}}</a></li>
                            @else
                            <li class="dropdown">
                                <a class="dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="{{url('/')}}/category/{{$course1->slug}}">
                                    {{$course1->name}}</a>
                                @endif    
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                 @foreach($course as $cou)    
                                <li><a href="{{url('/')}}/course/{{$cou->slug}}">{{$cou->title}}</a></li>
                                @endforeach
                                </ul>
                            </li>
                            @endforeach
                            
                            </ul>
                        </li> 

					
        						
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
                  <div class="main">
                      <form action="{{url('/')}}/search" method="post" class="form-search" accept-charset="utf-8">
                          @csrf
                     <!-- Another variation with a button -->
                     <div class="input-group">
                        <input type="text" name="search" class="form-control " placeholder="Enter a course, category or keyword">
                        <div class="input-group-append">
                           <button class="btn btn-secondary header_search_btn" type="submit" >
                           <i class="fa fa-search"></i>
                           </button>
                        </div>
                     </div>
                     </form>
                  </div>
                  <div class="header_box">  

                     <div class="login_menu">
                        <ul>
                            <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">{{ auth()->user()->unreadNotifications->count() }}</span>
            </a>
          <ul class="dropdown-menu">
              <li class="header">You have {{ auth()->user()->unreadNotifications->count() }} notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
        <!---        <ul class="menu">
                   @foreach(auth()->user()->unreadNotifications as $notification)

                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> {{ $notification->data['data'] }}
                    </a>
                  </li>
                
                @endforeach       
                
                </ul>--->
              </li>
              <li class="footer"><a href="{{ url('/') }}/notification">View all</a></li>
            </ul>
          </li>
                            
                           <li class="dropdown">
						   <a href="#" role="button" class="dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                              
                              <span class="padding_10">Courses</span></a>
							  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<a class="dropdown-item" href="{{url('/')}}/dashboard">My Classroom</a>
								<a class="dropdown-item" href="{{url('/')}}/course">All Courses</a>								
							  </div>
                           </li>
						   
                           <li class="dropdown">						      
						   <a href="#" role="button" class="dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                              
                              <span class="padding_10"> <i class="fa fa-user-circle-o"></i> {{$user->name}}</span></a>
							  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<a class="dropdown-item" href="{{url('/')}}/profile">Profile</a>
								  <a class="dropdown-item" href="{{url('/')}}/orders">My Order</a>
								  <a class="dropdown-item" href="{{url('/certificate')}}">Certificates</a>
								  <a class="dropdown-item" href="{{url('/')}}/wishlist">My Wishlist</a>								  
								  <a class="dropdown-item" href="{{url('/')}}/my_tickets">My Tickets</a>
								  <?php $us=App\User::where('id',Auth::user()->id)->first();
								  $role_id=$us->role_id;
								  
								  ?>
            					@if($role_id==2)
            												  
								  <a class="dropdown-item" href="{{url('/')}}/user/dashboard">My Dashboard</a>
            					@endif
            						  <a class="dropdown-item" href="{{'/logout'}}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">Logout</a>
                                 <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>  
								
								  
							  </div>						     
                           </li>                                                  
                           
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>