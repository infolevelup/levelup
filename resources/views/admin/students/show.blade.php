 @extends('admin.layouts.app')

@push('after-styles')
<style>
    table th {
        width: 20%;
    }
</style>
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
             <a href="{{ route('admin.students.index') }}" class="btn btn-success ">View Students</a>
            </div>
            <!-- /.box-header -->
        
            <div class="box-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered table-striped">
                      

                        <tr>
                            <th>NAME</th>
                            <td>{{ $teacher->name }}</td>
                        </tr>

                        <tr>
                            <th>EMAIL</th>
                            <td>{{ $teacher->email }}</td>
                        </tr>
                        <tr>
                            <th>STATUS</th>
                            <td>{!! $teacher->status !!}</td>
                        </tr>
                        <tr>
                            <th>GENDER</th>
                            <td>{!! $teacher->gender!!}</td>
                        </tr>
                         <tr>
                            <th>PHONE</th>
                            <td>{!! $teacher->phone!!}</td>
                        </tr>
                         <tr>
                            <th>CREATED AT</th>
                            <td>{!! $teacher->created_at!!}</td>
                        </tr>
                         <tr>
                            <th>STREET</th>
                            <td>{!! $teacher->street!!}</td>
                        </tr>
                         <tr>
                            <th>STATE</th>
                            <td>{!! $teacher->state!!}</td>
                        </tr>
                         <tr>
                            <th>CITY</th>
                            <td>{!! $teacher->city!!}</td>
                        </tr>
                         <tr>
                            <th>COUNTRY</th>
                            <td>{!! $teacher->country!!}</td>
                        </tr>
                       
                                  </table>
                </div>
            </div><!-- Nav tabs -->
        </div>
    </div>
    
    
      </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
   
@stop
