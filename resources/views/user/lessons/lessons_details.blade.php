@extends('user.layouts.app')
 @push('before-styles')
  <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/select2/dist/css/select2.min.css">

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
           <div class="col-md-6">
              <div class="form-group">
                <label>Select course</label>
                <select class="form-control select2" style="width: 100%;" name="record">
                  <option selected="selected">select the course</option>
                  <?php $course=App\Course::where('published','1')->where('teacher_id',Auth::user()->id)->get();?>
                 @foreach($course as $course)
                 <option value="{{$course->id}}">{{$course->title}}</option>
                 @endforeach
                </select>
              </div>
              </div>
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
                    <th>Sr.No</th>
                  <th>title</th>
                 
                  <th>Published</th>
                 <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                   @foreach($lessons as $users) 
                <tr>
                    <td>{{$i}}</td>
                  <td>{{$users->title}}</td>
                  <td>@if($users->published==1)<span class="badge badge-success bg-green">published</span>@endif
                  </td>
                  <td>
                      
                <a href="{{ route('user.lessons.show',$users->id) }}" class="btn btn-primary mb-1"><span class="glyphicon glyphicon-eye-open"></span></a></td>
               
                  
                </tr>
              <?php $i++;?>
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
<script src="{{url('/')}}/public/teacher/bower_components/select2/dist/js/select2.full.min.js"></script>

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
<script>
    $("[name='record']").on("change", function (e) {
    let edit_id = $(this).val();
    window.location.href = '{{url('/')}}/user/lessons_details/' + edit_id ;
});
</script>
   @endpush
   
@endsection
