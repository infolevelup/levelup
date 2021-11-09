@extends('admin.layouts.app')
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
                  <th>Time</th>
                     
                    <th>Date</th>
                    <th>Zoom Link</th>
                    
                </tr>
                </thead>
                <tbody>
             
           
             <?php $i=1;?>
            @if(count($batches)>0)
             @foreach($batches as $batches)
           
                         <tr>
                                    <td class="table-plus"><?php echo $i;?></td>
                               <td>{{$batches->time}}</td>
                               <td>{{$batches->date}}</td>
                               <td><a href="{{$batches->zoom_link}}" target="_blank"> {{$batches->zoom_link}}</a></td>
                               
                       
                         
                         
                         
                         
                         
                          <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$i}}">
  Add
</button>
                            </td>
                         </tr>
                                   
                                   
                                   <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Batch List
</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
   
   <h4>Instructor Has attended the class?</h4>
   <form method="post" action="{{url('admin/teacherattendance')}}">
              @csrf                             
              
              <input type="hidden" name="class_id" value="{{ @$batches->id}}">
<input type="hidden" name="batch_id" value="{{ @$batches->batch_id}}">
<input type="hidden" name="date" value="{{ @$batches->date}}">
   <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="atteneded" id="inlineRadio1" value="attended">
  <label class="form-check-label" for="inlineRadio1">yes</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="atteneded" id="inlineRadio2" value="not attended">
  <label class="form-check-label" for="inlineRadio2">No</label>
</div>

   <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </div>
   </form>
    </div>
  </div>
</div>
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
