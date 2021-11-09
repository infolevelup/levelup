@extends('user.layouts.app')

@section('content')
 <section class="content-header">
      <h1>
        Course Details        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
  <section class="content">
      <div class="row">
 <div class="col-xs-12">
          <div class="box">
               
              <table class="table table-bordered table-striped">
                        <tbody><tr>
                            <th>Title</th>
                            <td>{{$bundle->title}}           </td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{$bundle->slug}}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>{{$category->name}}</td>
                        </tr>
                        <tr>
                            <th>Courses</th>
                            <td>
                                <ol class="pl-3 mb-0">
                                    @foreach($bundle_course as $bundleid)
                                    <?php 
                                    $course=App\Course::where('id',$bundleid->course_id)->first();
                                    ?>
                                 <li>
                                      {{$course->title}} </li>
                                                                         
                                      @endforeach
                                                                    </ol>
                            </td>
                        </tr>
                        <tr>
                            <th>Description</th>
      <td>{{$bundle->description}}</td></tr>
                        <tr>
                            <th>Price</th>
                            <td>{{$bundle->price}}</td>
                        </tr>
                        <tr>
                            <th>Course Image</th>
                            <td><img src="{{url('/')}}/public/uploads/images/{{$bundle->course_image}}" height="50px"></a></td>
                        </tr>
                        <tr>
                            <th>Start Date</th>
                            <td>{{$bundle->start_date}}</td>
                        </tr>
                        <tr>
                            <th>Published</th>
                            <td><input disabled="" <?php if($bundle->published==1){echo 'checked';} ?> name="published" type="checkbox" value="1"></td>
                        </tr>
                        <tr>
                            <th>Meta Title</th>
                            <td>{{$bundle->meta_title}}</td>
                        </tr>
                        <tr>
                            <th>Meta Description</th>
                            <td>{{$bundle->meta_description}}</td>
                        </tr>
                        <tr>
                            <th>Meta Keywords</th>
                            <td>{{$bundle->meta_keywords}}</td>
                        </tr>
                    </tbody></table> 
               
                 <a href="{{url('/')}}/user/bundle" class="btn btn-default border float-left">Back to list</a>

                </div>
                
            
</div>
    </div>
</section>

@endsection