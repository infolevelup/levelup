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
                            <th>Teachers</th>
                            <td>
                                                                    <span class="label label-info label-many">{{$teacher->name}}</span>
                                                            </td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>
                                                                    <a target="_blank" href="#">{{$course->title}}</a>
                                                            </td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{$course->slug}}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>{{$category->name}}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{!!$course->description!!}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>{{$course->price}}</td>
                        </tr>
                        <tr>
                            <th>Course Image</th>
                            <td>   <img src="{{ URL::to('/') }}/public/uploads/images/{{ @$course->course_image }}" style="width: 100%;" />
                      </td>
                        </tr>
                        <tr>
                            <th>Media Video</th>
                            <td>
                                                                    <p>No Videos</p>
                                                            </td>
                        </tr>
                      
                        <tr>
                            <th>Published</th>
                            <td><input disabled="" <?php if($course->published==1){echo 'checked';} ?> name="published" type="checkbox" value="1"></td>
                        </tr>

                        <tr>
                            <th>Meta Title</th>
                            <td>{{$course->meta_title}}</td>
                        </tr>
                        <tr>
                            <th>Meta Description</th>
                            <td>{{$course->meta_description}}</td>
                        </tr>
                        <tr>
                            <th>Meta Keywords</th>
                            <td>{{$course->meta_keywords}}</td>
                        </tr>
                    </tbody></table>
                </div>
                
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-12  ">
                        
                        <div class="col-lg-8 col-12  ">
                        <h4 class="">Course timeline</h4>
                        <p class="mb-0">Only Published Lessons and Tests will be Displayed</p>
                       
                        <ul class="sorter d-inline-block" data-action="false">

                            @foreach($lessons as $lesson)
                                
                                    <li>
                                        <span data-id="360" data-sequence="1">
                                                                          <p class="d-inline-block mb-0 btn btn-success">
                                        Lesson                                     </p>
                                 <p class="title d-inline ml-2">{{$lesson->title}}</p>
                                                                         </span>

                                    </li>
                                            
                                 @endforeach                           
                                 <a href="{{url('/')}}/user/courses" class="btn btn-default border float-left">Back to list</a>

                       
                    </div>

                </div>

    </div>
</section>

@endsection