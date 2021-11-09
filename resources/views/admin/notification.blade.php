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
        Notification List       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Notification</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
      
           <section class="col-lg-12 connectedSortable">


          <!-- Calendar -->
          <div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Unread Notification</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- button with a dropdown -->
              
                <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-black">
                                                   <a class="btn btn-default pull-right" href="{{ route('mark') }}">Mark as read</a>

              <div class="row">

                <div class="col-sm-12">
                  <!-- Progress bars -->
               
               
               
                                       <table id="example1" class="table table-bordered table-striped"> 
                      

                  <thead>                  
                    <tr>
                      <th>#</th>
                      <th>Data</th>
                      <th>Date</th>
                    </tr> 
                  </thead>
                  <tbody>
                  
                    <tr>
                         @if(auth()->user()->unreadNotifications->count()>0)
                         @php $i=1; @endphp
             @foreach(auth()->user()->unreadNotifications as $notification)

     
              
        
           
                
                              <td>{{$i}}</td>

                                 <td width="60%">
                        {!! $notification->data['data'] !!}                      </td>
                      <td>{{ $notification->created_at }}</td>
                    
                  
                     
                         </tr>
                                    <?php $i++;?>
                    @endforeach

               @else
                <td>
               <span>No Notifications</span>
               </td>
               @endif
                  </tbody>
                </table>
               
             
               
               
                </div>
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.box -->

        </section>
        <!-- right col -->
     
      
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


<div class="row">
        <div class="col-xs-12">
      
           <section class="col-lg-12 connectedSortable">


          <!-- Calendar -->
          <div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Unread Notification</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- button with a dropdown -->
              
                <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-black">

              <div class="row">

                <div class="col-sm-12">
                  <!-- Progress bars -->
               
               
               
                                       <table id="example1" class="table table-bordered table-striped"> 
                      

                  <thead>                  
                    <tr>
                      <th>#</th>
                      <th>Data</th>
                      <th>Date</th>
                    </tr> 
                  </thead>
                  <tbody>
                  
                    <tr>
                         @if(auth()->user()->readNotifications->count()>0)
                         @php $i=1; @endphp
             @foreach(auth()->user()->readNotifications as $notification)

     
              
        
           
                
                              <td>{{$i}}</td>

                                 <td width="60%">
                        {!! $notification->data['data'] !!}                      </td>
                      <td>{{ $notification->created_at }}</td>
                    
                  
                     
                         </tr>
                                    <?php $i++;?>
                    @endforeach

               @else
                <td>
               <span>No Notifications</span>
               </td>
               @endif
                  </tbody>
                </table>
               
             
               
               
                </div>
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.box -->

        </section>
        <!-- right col -->
     
      
        </div>
        <!-- /.col -->
      </div>
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

