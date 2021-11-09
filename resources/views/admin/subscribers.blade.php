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
        Subscribers List       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Subscribers</li>
      </ol>
    
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
<input type="button" id="btnExport" value="Export" onclick="Export()" />

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
             <table id="tblCustomers" class="table table-bordered table-striped"> 
                
                  <thead>                  
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                    </tr> 
                  </thead>
                  <tbody>
                <?php $data=App\Subscribe::all();
                $i=1; ?>
                
                    @foreach($data as $row)
                    <tr>
                        <td>{{$i}}</td>
                      <td>
                        {{@$row->email}}</td>
                    <?php $i++; ?>
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

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="table2excel.js" type="text/javascript"></script>
    <script type="text/javascript">
     function Export() {
            $("#tblCustomers").table2excel({
                filename: "Table.xls"
            });
        }
    </script>

   @endpush
   
@endsection

