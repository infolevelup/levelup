 @extends('layouts.app')

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
<style>
    .param {
    margin-bottom: 7px;
    line-height: 1.4;
}
.param-inline dt {
    display: inline-block;
}
.param dt {
    margin: 0;
    margin-right: 7px;
    font-weight: 600;
}
.param-inline dd {
    vertical-align: baseline;
    display: inline-block;
}

.param dd {
    margin: 0;
    vertical-align: baseline;
} 

.shopping-cart-wrap .price {
    color: #007bff;
    font-size: 18px;
    font-weight: bold;
    margin-right: 5px;
    display: block;
}
var {
    font-style: normal;
}

.media img {
    margin-right: 1rem;
}
.img-sm {
    width: 90px;
    max-height: 75px;
    object-fit: cover;
}
</style>
   @section('content')  

<div class="container">


    <div class="row">
        <div class="col-md-12">


<div class="card">
<table class="table table-hover shopping-cart-wrap">
    
<thead class="text-muted">
<tr>
  <th scope="col">Product</th>
  <th scope="col" width="120">Price</th>
  <th scope="col" width="200" class="text-right">Action</th>
</tr>
</thead>
<tbody>
    
                                        @if(count($cartss) > 0)
                                        @foreach($cartss as $carts)
<?php 
$cour=App\Course::where('id',$carts->courseid)->first();
$cat=App\Category::where('id',$cour->category_id)->first();
						

?>
<tr>
	<td>
<figure class="media">
	<div class="img-wrap"><img src="{{url('/')}}/public/uploads/course_images/{{$cour->course_image}}" class="img-thumbnail img-sm"></div>
	<figcaption class="media-body">
		<h6 class="title text-truncate">{{$cour->title}}</h6>
		<dl class="param param-inline small">
		  <dt>Category: </dt>
		  <dd>{{$cat->name}}</dd>
		</dl>
	
	</figcaption>
</figure> 
	</td>

	<td> 
		<div class="price-wrap"> 
			<var class="price">₹ {{$cour->price}}</var> 
			<small class="text-muted"></small> 
		</div> <!-- price-wrap .// -->
	</td>
	<td class="text-right"> 
<!--	<a title="" href="" class="btn btn-outline-success" data-toggle="tooltip" data-original-title="Save to Wishlist"> <i class="fa fa-heart"></i></a> 
-->	<a href="#" class="btn btn-outline-danger"> Add to cart</a>
	</td>
</tr>
@endforeach

</tbody>

					@else
                                        <tr>
                                            <td colspan="4">No Items Found!!</td>
                                        </tr>
                                    @endif
</table>
</div> <!-- card.// -->

</div> </div>  </div> 
<!--container end.//-->

@endsection
