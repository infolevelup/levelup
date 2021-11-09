@extends('user.layouts.app')
 @push('before-styles')
  <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 
@endpush

@section('content')

 <section class="content-header">
      <h1>
        Batch List    
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}/user/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Batch List </li>
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
                  <th>Batch</th>   
                    <th>Time</th>
                    <th>Date</th>
                    <th>Status</th>
                    
                </tr>
                </thead>
                <tbody>
             <?php 
             $batches=App\Teacher_class_attended::where('user_id',Auth::user()->id)->get();
             ?>
           
             <?php $i=1;?>
            @if(count($batches)>0)
             @foreach($batches as $batches)
             <?php 
             $course=App\Course::where('id',$batches->course_id)->first();
             $batch=App\Batch::where('id',$batches->batch_id)->first();
             $class=App\classs::where('id',$batches->class_id)->first();
             ?>
           
                         <tr>
                                    <td class="table-plus"><?php echo $i;?></td>
                                    <td>{{$course->title}}</td>
                                    <td>{{$batch->batch_name}}</td>
                               <td>{{$class->time}}</td>
                               <td>{{$batches->date}}</td>
                              <td>{{$batches->status}}</td> 
                         </tr>
                                   <?php $i++;?>
             @endforeach
             @else
             <tr>No Btaches scheduled</tr>
             @endif
             
          
                    
             
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
