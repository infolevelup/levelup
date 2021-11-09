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
        Pages List       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pages</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <a href="{{route('admin.pages.create')}}" class="btn btn-success ">Add Pages</a>
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
                      <th>Banner Image</th>
                      <th>title</th>
                     
                    
                      <th>Content</th>
                      <th>Status</th>
                   <th>Action</th>
                    </tr> 
                  </thead>
                  <tbody>
                    @foreach($data as $row)
                   
                    <tr>
                      <td >
                        <img src="{{ URL::to('/') }}/public/uploads/images/{{ @$row->image }}" width="100%"/>
                      </td>
                      <td>{{@$row->title}}</td>
                      <td>   <?php  $con= Str::limit(@$row->content, 100);?>

{!! @$con!!}</td>
                    <td><?php if($row->published==1){echo '<span class="badge badge-pill badge-success">Published</span>';}else{echo '<span class="badge badge-pill badge-warning">Drafted</span>';}?></td>
                  
                     
                      <td>
                        <a href="{{ route('admin.pages.edit', $row->id) }}"   class="btn btn-info" data-bgcolor="#3b5998" data-color="#ffffff"><i class="icon-copy fa fa-pencil" aria-hidden="true"></i></a>

               
                        <button form="resource-delete-{{ $row->id }}" class="btn btn-danger" data-bgcolor="#3b5998" data-color="#ffffff"><i class="icon-copy fa fa-trash" aria-hidden="true" color='red'></i></button>
                    
                        <form id="resource-delete-{{ $row->id }}" action="{{ route('admin.pages.destroy', $row->id) }}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                          @csrf
                          @method('DELETE')
                        </form>
                      </td>
                    </tr>
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


   @endpush
   
@endsection

