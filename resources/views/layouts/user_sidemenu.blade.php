    @php
        $siteName = url('/');
        $url = url()->current();
        $dash = $siteName . '/profile';
        $orders1 = $siteName . '/orders';
        $products = $siteName . '/wishlist';
        $address = $siteName . '/my_tickets';
        $acc = $siteName . '/notification';
        $quizz=$siteName . '/userquizz';
        $cer=$siteName . '/certificate';
        $quizz=$siteName . '/userquizz';
        $crspage=$siteName . '/usercoursepage';
    @endphp
     <?php 
     $user=App\User::where('id',Auth::user()->id)->first();
     $tickets=App\Ticketing::where('user_id',Auth::user()->id)->get();
     
     $orders=App\Order::where('user_id',Auth::user()->id)->get();
      $wishlist=App\Wishlist::where('userid',Auth::user()->id)->get();
     ?>
      <div class="col-lg-3 col-md-3 col-sm-12">
            <aside class="user-info-wrapper">
                <div class="user-cover" style="background-image: url(https://bootdey.com/img/Content/bg1.jpg);">                    
                </div>
                <div class="user-info">
                    <div class="user-avatar">
                        <a class="edit-avatar" href="#"></a>
                        @if($user->image)
                          <img src="{{url('/')}}/public/uploads/images/{{$user->image}}" alt="{{$user->name}}">
                        @else
                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="User">
                        @endif
                        </div>
                     <div class="user-data">
                        <h4>{{$user->name}}</h4><span>Joined {{ \Carbon\Carbon::parse($user->created_at)->isoFormat('MMM Do YYYY')}}</span>
                    </div>
                </div>
            </aside>
            <nav class="list-group">
				<a class="list-group-item @if ($url==$dash) active @endif" href="{{url('/')}}/profile"><i class="fa fa-user"></i>Profile</a>
				<a class="list-group-item with-badge  @if ($url==$orders1) active @endif" href="{{url('/')}}/orders"><i class="fa fa-th"></i>Orders<span class="badge badge-primary badge-pill"> {{$orders->count()}}</span></a>
                
                <a class="list-group-item @if ($url==$cer) active @endif" href="{{url('/certificate')}}"><i class="fa fa-map"></i>Certificates</a>
                <a class="list-group-item with-badge @if ($url==$products) active @endif" href="{{url('/')}}/wishlist"><i class="fa fa-heart"></i>My Wishlist<span class="badge badge-primary badge-pill">
                   {{$wishlist->count()}}
                </span></a>
                <a class="list-group-item with-badge @if ($url==$address) active @endif" href="{{url('/')}}/my_tickets"><i class="fa fa-tag"></i>My Tickets
                <span class="badge badge-primary badge-pill">{{$tickets->count() }}</span></a>
                <a class="list-group-item with-badge @if ($url==$acc) active @endif" href="{{url('/')}}/notification"><i class="fa fa-bell"></i>My Notifications
                <span class="badge badge-primary badge-pill">{{ auth()->user()->unreadNotifications->count() }} </span></a>
                
                
                <a class="list-group-item with-badge @if ($url==$quizz) active @endif " href="{{url('/')}}/userquizz"><i class="fa fa-question-circle"></i> My Quizz
                </a>
                
                
                <a class="list-group-item with-badge  @if ($url==$crspage) active @endif" href="{{url('/')}}/usercoursepage"><i class="fa fa-book"></i> My Course
                </a>
            </nav>
			
			<div class="howtouse"><a href="#"><i class="fa fa-play-circle" aria-hidden="true"></i> How to Use LevelUp LMS</a></div>
        </div>
		
		
     