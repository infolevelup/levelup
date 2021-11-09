@extends('user.layouts.app')
 @push('before-styles')
  <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 
@endpush

@section('content')

 <section class="content-header">
      <h1>
        Test List       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}/user/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Test</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <a href="{{url('/')}}/user/test/create" class="btn btn-success ">Add Test</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Course</th>
                     
                    <th>Test name</th>
                      <th>Description</th>
                      <th>Published</th>
                   <th >Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($course as $cour)
                    <?php 
                     $data = App\Test::where('course_id',$cour->id)->orderBy('id','DESC')->get();

                    ?>
               @foreach($data as $row)
                   <?php 
                   $course=App\Course::where('id',$row->course_id)->first();
                   ?>
                    <tr>
                     
                      <td>{{@$course->title}}</td>
                      <td>{{$row->title}}</td>
                      <td>{!!@$row->description!!}</td>
                    
                  <td><?php if($row->published==1){echo 'Yes';}else{
                  echo 'No';}?></td>
                     
                      <td>
                        <a href="{{ route('user.test.edit', $row->id) }}"  class="btn btn-info"><i class="icon-copy fa fa-pencil" aria-hidden="true"></i></a>

                  
                        <button form="resource-delete-{{ $row->id }}" class="btn btn-danger"><i class="icon-copy fa fa-trash" aria-hidden="true" color='red'></i></button>
                    
                        <form id="resource-delete-{{ $row->id }}" action="{{ route('user.test.destroy', $row->id) }}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                          @csrf
                          @method('DELETE')
                        </form>
                      </td>
                    </tr>
                    @endforeach
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
