<!DOCTYPE html>
<html>
<head>
	<title>Invoice PDF</title>
	   

 
</head>
<body>
         <section>
      <!-- banner bg main start -->
      <div class="banner_bg_main">         
         <!-- header section start -->
         <div class="header_section">
            <div class="container">
                 
    <?php 
                            $order=App\Order::where('order_id',$orderid)->first();
                          $user=App\User::where('id',Auth::user()->id)->first();
                        $orderlist=App\OrderList::where('order_id',$orderid)->get();
                    
                            ?>          
	
	
	
<article class="col-lg-9 col-md-8 col-sm-12 col-xs-12">			
	

<div class="page-content container">
    <div class="page-header text-blue-d2">
        <h1 class="page-title text-secondary-d1">
            Invoice
            <small class="page-info">
                <i class="fa fa-angle-double-right text-80"></i>
                ID: #{{$order->order_id}}
            </small>
        </h1>

    </div>

    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-10 offset-lg-1">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center text-150">                            
                            <span class="text-default-d3"><img src="{{url('/')}}/public/images/logo.png" width="150px"></span>
                        </div>
                    </div>
                </div>
                <!-- .row -->

                <hr class="row brc-default-l1 mx-n1 mb-4" />

                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">To:</span>
                            <span class="text-600 text-110 text-blue align-middle">{{$user->name}}</span>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                {{$user->street}},{{$user->city}}
                            </div>
                            <div class="my-1">
                                {{$user->state}}, {{$user->country}}
                            </div>
                            <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600">{{$user->phone}}</b></div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">
                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                Invoice
                            </div>
                         
                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> #{{$orderid}}</div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> {{ \Carbon\Carbon::parse($order->created_at)->isoFormat('MMM Do YYYY')}}</div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> <span class="badge badge-warning badge-pill px-25">{{$order->status}}</span></div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

                <div class="mt-4">
                    <div class="row text-600 text-white bgc-default-tp1 py-25">
                        <div class="d-none d-sm-block col-1">#</div>
                        <div class="col-9 col-sm-5">Course</div>
                        
                        <div class="d-none d-sm-block col-sm-2">Unit Price</div>
                        <div class="col-2">Amount</div>
                    </div>

                    <div class="text-95 text-secondary-d3">
                
                      	@foreach($orderlist as $orderlist)
                      	<?php 
                      	$course=App\Course::where('id',$orderlist->course_id)->first();
                      	?>
                       	<?php $i=1; ?>
	                @if($i % 2 == 0) 
                        <div class="row mb-2 mb-sm-0 py-25">
                            <div class="d-none d-sm-block col-1">{{$i}}</div>
                            <div class="col-9 col-sm-5">{{$course->title}}</div>
                            
                            <div class="d-none d-sm-block col-2 text-95"> ₹ {{$course->strike_price}}</div>
                            <div class="col-2 text-secondary-d2"> ₹  {{$orderlist->price}} </div>
                        </div>
                    @else
                        <div class="row mb-2 mb-sm-0 py-25 bgc-default-l4">
                          <div class="d-none d-sm-block col-1">{{$i}}</div>
                            <div class="col-9 col-sm-5">{{$course->title}}</div>
                            
                            <div class="d-none d-sm-block col-2 text-95"> ₹ {{$course->strike_price}}</div>
                            <div class="col-2 text-secondary-d2"> ₹  {{$orderlist->price}} </div>
                        </div>

                       
                  	@endif
            	<?php $i++;?>
                @endforeach
                  
                    </div>

                    <div class="row border-b-2 brc-default-l2"></div>                    

                    <div class="row mt-3">
                        <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                            Extra note such as company or payment information...
                        </div>

                        <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    SubTotal
                                </div>
                                <div class="col-5">
                                    <span class="text-120 text-secondary-d1"> ₹  {{$order->payable_price}}</span>
                                </div>
                            </div>

                           <!-- <div class="row my-2">
                                <div class="col-7 text-right">
                                    Tax (10%)
                                </div>
                                <div class="col-5">
                                    <span class="text-110 text-secondary-d1">$225</span>
                                </div>
                            </div>-->

                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    Total Amount
                                </div>
                                <div class="col-5">
                                    <span class="text-150 text-success-d3 opacity-2"> ₹  {{$order->payable_price}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div>
                        <span class="text-secondary-d1 text-105">Thank you for your business</span>                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>