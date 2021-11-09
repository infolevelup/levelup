@extends('user.layouts.app')
 @push('before-styles')
  <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
@endpush

@section('content')

 <section class="content-header">
      <h1>
        Categories List        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Title</th>
                  <th>category</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Lessons</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                   @foreach($users as $users) 
                   <?php 
                   $category=App\Category::where('id',$users->category_id)->first();
                   ?>
                <tr>
                  <td>{{$users->title}}</td>
                  <td>{{$category->name}}
                  </td>
                  <td>@if($users->price){{$users->price}}
                    @else
                    N/A
                    @endif
                  </td>
                   <td>@if($users->published==1)<span class="badge badge-success bg-green">published</span>@endif
                    @if($users->featured==1)
                    <span class="badge badge-primary bg-blue">Featured</span>
                    
                    @endif
                     @if($users->trending==1)
                    <span class="badge badge-primary bg-yellow">Trending</span>
                    
                    @endif
                    @if($users->popular==1)
                    <span class="badge badge-primary bg-purple">Popular</span>
                    
                @endif
                @if($users->free==1)
                    <span class="badge badge-primary bg-maroon">Free</span>
                    
                    @endif
                   </td>
                   <td>
                       <a href="{{url('/')}}/user/lessons_details/{{$users->id}}" class="btn mb-1 btn-warning text-white"><i class="fa fa-arrow-circle-right"></i></a>
                      </td>
                    <td><a href="{{ route('user.courses.show',$users->id) }}" class="btn btn-primary mb-1"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                  
                </tr>
              
                @endforeach
                </tbody>
                <!-- <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </tfoot> -->
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
   
   @push('after-scripts')
   
<!-- DataTables -->
<script src="{{url('/')}}/public/teacher/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/public/teacher/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

   @endpush
   
@endsection
