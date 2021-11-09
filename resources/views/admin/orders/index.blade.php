@extends('admin.layouts.app')

 @push('before-styles')
  <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    

@endpush

@section('content')

 <section class="content-header">
      <h1>
        Orders List       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">orders</li>
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
                                    <th>Course</th>
                                    <th>User</th>
                               
                                  <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;?>
                            @foreach($data as $row)   
                            <?php 
                            $user=App\User::where('id',$row->user_id)->first();
                            $od=App\OrderList::where('order_id',$row->order_id)->get();
                            
                            ?>
                                <tr>
                                    <td class="table-plus"><?php echo $i;?></td>
                                    <td>@foreach($od as $od)
                                    <?php $crs=App\Course::where('id',$od->course_id)->first();?>
                                    <p>@if($crs){{$crs->title}}@endif</p>
                                    @endforeach
                                    </td>
                                    <td>{{$user->name}}</td>

                                    <td>{{$row->payable_price}}</td>
                                    <td>{{$row->status}}</td>
                                    <td>{{$row->created_at}}</td>

                                    <td>
                                        
                                       <a href="{{ url('admin/invoice/') }}/{{$row->order_id}}"class="btn btn-info"  title="Invoice" data-bgcolor="#3b5998" data-color="#ffffff">
                                           <i class="icon-copy fa fa-file" aria-hidden="true"></i></a>

                            
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
                    location.href = '{{url('/')}}/admin/batch';
                }
            })

            @if(request('type') != "")
            $('#sortBy').find('option[value="' + "{{request('type')}}" + '"]').attr('selected', true);
            @endif
        });

    </script>
@endpush
   
@endsection

