@extends('user.layouts.app')
 @push('before-styles')
  <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 
@endpush

@section('content')

 <section class="content-header">
      <h1>
        Course List    
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}/user/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Course List </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
           
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                     <th>Sr.No</th>
                  <th>Course</th>
                     
                    <th>Total students </th>
                    <th>Course Type</th>
                      <th>Batch</th>
                 
                </tr>
                </thead>
                <tbody>
             
           
             <?php $i=1;?>
              @foreach($course as $course)
             <?php 
             $purchased_course=App\Course_student::where('course_id',$course->id)->get();
$count=count($purchased_course);
$batch=App\Batch::where('teacher_id',Auth::user()->id)->where('course_id',$course->id)->first();
             ?>
             
                         <tr>
                                    <td class="table-plus"><?php echo $i;?></td>
                                    
                                  <td>{{$course->title}}</td>
                                    <td><a href="{{url('user/studentlist')}}/{{$course->id}}" title="student list">{{$count}}</a></td>
                                    <td>@if($course->type=='live class')Live class @else Seld paced @endif</td>
                                <td>@if($batch)<a href="{{url('/user/')}}/batch/{{$batch->id}}">{{$batch->batch_name}}</a>@else - @endif</td>
                            
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
