@extends('admin.layouts.app')

 @push('before-styles')
  <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    

@endpush

@section('content')

 <section class="content-header">
      <h1>
        Projects List       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Projects</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <a href="{{ route('admin.projects.create') }}" class="btn btn-success ">Create projects</a>
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
               <div class="ml-auto ">
                <div id="sorting" class="border rounded p-1 m-1"> <span class="text-muted">Sort by course</span> <select name="sort" id="sortBy">
                       <option value="">None</option>
                                <?php $course=App\Course::where('published',1)->get();?>
                                @foreach($course as $course)
                                <option value="{{$course->id}}">{{$course->title}}</option>
                                @endforeach
                    </select> </div>
            </div>
              <table id="example1" class="table table-bordered table-striped">     
                     
                  
           <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">#</th>
                                    <th>Project title</th>
                                    <th>Course</th>
                               
                                  <th>PDF </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;?>
                            @foreach($data as $row)  
                            <?php 
                            $cours=App\Course::where('id',$row->course_id)->first();
                            ?>
                                <tr>
                                    <td class="table-plus"><?php echo $i;?></td>
                                    <td>{{$row->title}}</td>
                                     <td>{{$cours->title}} </td>
                                      <td> 
                                     <?php  $decoded = json_decode($row->pdf, true); ?>

                                      @foreach($decoded as $pdf)
                                      <a href="{{url('/public/uploads')}}/{{$pdf}}" target="_blank">{{$pdf}}</a><br>
                                      @endforeach
                                      </td>
                                    
                                   
                                    <td>
                                       <a href="{{ route('admin.projects.edit',$row->id) }}"class="btn btn-info"  title="edit" data-bgcolor="#3b5998" data-color="#ffffff"><i class="icon-copy fa fa-pencil" aria-hidden="true"></i></a>
                                        
                                      
                            
                        <button form="resource-delete-{{ $row->id }}" class="btn btn-danger" title="delte"><i class="icon-copy fa fa-trash"  aria-hidden="true" color='red'></i></button>
                        <form id="resource-delete-{{ $row->id }}" action="{{ route('admin.projects.destroy', $row->id) }}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                          @csrf
                          @method('DELETE')
                        </form>  
                                    </td>
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
        $(document).ready(function () {
            $(document).on('change', '#sortBy', function () {
                if ($(this).val() != "") {
                    location.href = '{{url()->current()}}?type=' + $(this).val();
                } else {
                    location.href = '{{url('/')}}/admin/projects';
                }
            })

            @if(request('type') != "")
            $('#sortBy').find('option[value="' + "{{request('type')}}" + '"]').attr('selected', true);
            @endif
        });

    </script>
@endpush
   
@endsection

