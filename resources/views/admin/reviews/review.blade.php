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
        Review List       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Review</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
          
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
                     
                      <th>Username </th>
                      <th>Course</th>
                      <td>Comments</td>
                      <td>Rating</td>
                      <th>Status</th>
                       <th>Action</th>
                  <th>Created at</th>
                    </tr> 
                  </thead>
                  <tbody>
                      <?php $i=1;?>
                    @foreach($data as $row)
                    <?php 
                    $course=App\Course::where('id',$row->course_id)->first();
                     $user=App\User::where('id',$row->user_id)->first();
                    ?>
                    <tr>
                         <td>{{$user->name}}</td>
                        <td>{{$course->title}}</td>
                      <td>{{@$row->comments}}</td>
                      <td>{{@$row->rating}}/5</td>
                          
                             
                             <td>@if($row->status == "approve") Approve @endif @if($row->status == "reject") Reject @endif 
                             
                             </td>
                             
                             <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal{{$i}}">
                        Change Status
                      </button></td>
                      <td>{{ \Carbon\Carbon::parse($row->created_at)->format('jS M Y') }}</td>
                     
                    </tr>
                  
                    
       
<!-- Modal -->
<div class="modal fade" id="exampleModal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
                                <form method="post" action="{{url('/admin/changereviewStatus')}}">
                                  @csrf
                                  <div class="form-group">
                                    <label>Select Status</label>
                                    <select class="form-control" name="order_status">
                                      <option @if($row->status == "approve") selected @endif value="approve">Approve</option>
                                      <option @if($row->status == "reject") selected @endif value="reject">Reject</option>
                                    
                                    </select>
                                    <input type="hidden" name="review_id" value="{{ @$row->id}}">
                                  </div>
                                  <div class="text-center"> 
                                   <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                                </form>
                           
        
        
      </div>
   
    </div>
  </div>
</div>
                    <?php $i++;
                    ?>
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

