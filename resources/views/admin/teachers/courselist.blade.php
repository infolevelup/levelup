

   @extends('admin.layouts.app')

 @push('before-styles')
  <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    

@endpush
@push('after-styles')

@endpush
@section('content')

 <section class="content-header">
      <h1>
        Teachers List       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Teachers</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <a href="{{ route('admin.teachers.create') }}" class="btn btn-success ">Add Teachers</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                  @if(Session::has('flash_success'))
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                  {{ Session::get('flash_success') }}
                  </div>
              @endif
              @if(Session::has('flash_error'))
                  <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                  {{ Session::get('flash_error') }}
                  </div>
              @endif
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
$batch=App\Batch::where('course_id',$course->id)->first();
             ?>
             
                         <tr>
                                    <td class="table-plus"><?php echo $i;?></td>
                                    
                                  <td>{{$course->title}}</td>
                                    <td><a href="{{url('admin/studentlist')}}/{{$course->id}}" title="student list">{{$count}}</a></td>
                                    <td>@if($course->type=='live class')Live class @else Seld paced @endif</td>
                                <td>@if($batch)<a href="{{url('/admin/')}}/batchlist/{{$batch->id}}">{{$batch->batch_name}}</a>@else - @endif</td>
                            
                         </tr>
                                   <?php $i++;?>
             @endforeach
             
             
          
                    
                            </tbody>
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

    <script>
  $(function() {
    $('.toggle-class').change(function() {
        //alert('aa');
        var status = $(this).prop('checked') == true ? 'Active' : 'Inactive'; 
        var user_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{url('/')}}/changeStatus',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
</script>
   @endpush
   
@endsection

