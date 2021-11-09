@extends('admin.layouts.app')

 @push('before-styles')
  <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    

@endpush

@section('content')

 <section class="content-header">
      <h1>
        Students List       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Students</li>
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
                                    <th class="table-plus datatable-nosort">#</th>
                                    <th>Course</th>
                                    <th>Course Info</th>
                                                    

                                    <th>Grade</th>
                                    <th>Course Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;?>
                            @foreach($course as $row)  
                            <?php 
                            $cours=App\Course::where('id',$row->course_id)->first();
                            $batch=App\Batch::where('course_id',$row->course_id)->first();
                            ?>
                                <tr>
                                    <td class="table-plus"><?php echo $i;?></td>
                                    <td>{{$cours->title}}</td>
                                     @if($cours->type=='live class')
                                      <td> 
                                        <b>Batch-</b> {{$batch->batch_name}}<br>
                                      
                                    <b>Batch date -</b>{{$batch->batch_date}}<br>
                                    <b>Batch timings -</b>{{$batch->batch_timings}}
                                    <br>
                                    </td>
                                    @else
                                    <td> - </td>
                                    @endif
                                    <td><?php 
                                    $grade=App\Course_Student::where('user_id',$row->user_id)->where('course_id',$cours->id)->first();
                                    ?>
                                        @if($grade->grade=='A Grade'||$grade->grade=='B Grade' ||$grade->grade=='C Grade' )
                                        <p class="badge badge-success">{{$grade->grade}}</p>
                                        @else
                                        <p class="badge badge-danger">{{$grade->grade}}</p>
                                        @endif

                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal{{$i}}">
                        Change Grade
                      </button>
                  
                      
                      </td>
                                   
                                   <td>{{$cours->type}}</td>
                                    <td>
                                     
                                       <a href="{{ url('/admin') }}/assignment/{{$cours->id}}/{{$row->user_id}}"class="btn btn-warning"  
                                       title="Assignment" data-bgcolor="#3b5998" data-color="#ffffff"><i class="icon-copy fa fa-tasks"></i></a>
                                       
                                        <a href="{{ url('/admin') }}/project/{{$cours->id}}/{{$row->user_id}}"class="btn btn-success"  
                                       title="Project" data-bgcolor="#3b5998" data-color="#ffffff"><i class="icon-copy fa fa-tasks"></i></a>
                                         
                                         @if($grade->grade=='A Grade'||$grade->grade=='B Grade' ||$grade->grade=='C Grade' )
                                        <a href="{{url('/admin/cerificate/')}}/{{$grade->id}}"class="btn btn-info"  
                                       title="certificate" data-bgcolor="#3b5998" data-color="#ffffff"><i class='icon-copy fa fa-certificate'></i></a>
                                        @endif
                            
                                    </td>
                                </tr>
                               
                          
                  <!-- /.modal -->
                  
                  <div class="modal" tabindex="-1" id="modal{{$i}}" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Update Grade</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                                                 <?php     $grade=App\Grade::all(); ?>

                            <form method="post" action="{{url('/admin/changeGradeStatus')}}">
                                  @csrf
                                  <div class="form-group">
                                    <label>Select Grade</label>
                                    <select class="form-control" name="grade">
                                      @foreach($grade as $grade)
                                      <option value="{{$grade->grade_name}}">{{$grade->grade_name}}</option>
                                      @endforeach
                                          </select>
                                    <input type="hidden" name="course_id" value="{{ @$cours->id}}">
                                    <input type="hidden" name="user_id" value="{{$row->user_id}}"
                                  </div>
                                  <div class="modal-footer"> 
                                   <button type="submit" class="btn btn-primary">Submit</button>
                                                                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                  </div>

                                </form>      </div>
     
    </div>
  </div>
</div>
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
        $(document).ready(function () {
            $(document).on('change', '#sortBy', function () {
                if ($(this).val() != "") {
                    location.href = '{{url()->current()}}?type=' + $(this).val();
                } else {
                    location.href = '{{url('/')}}/admin/purchased_course';
                }
            })

            @if(request('type') != "")
            $('#sortBy').find('option[value="' + "{{request('type')}}" + '"]').attr('selected', true);
            @endif
        });

    </script>
@endpush
   
@endsection

