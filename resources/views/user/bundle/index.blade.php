@extends('user.layouts.app')
 @push('before-styles')
  <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 
@endpush

@section('content')

 <section class="content-header">
      <h1>
      Bundle List   
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}/user/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Bundle</li>
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
              <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                   <th>#</th>
                                    
                                    <th>Title</th>
                                    
                                    <th>Category</th>
                                    <th>Course count</th>
                                    <th>Price</th>
                                                       <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;?>
                                 @foreach($course as $course)
                          
                            <?php
                                      $users = App\Bundle::where('category_id',$course->category_id)->orderby('id','DESC')->get();

                            ?>
                             @foreach($users as $row)
                            <?php 
                            $cat=App\Category::where('id',$row->category_id)->first();
                            ?>
                           <tr>
                                    <td class="table-plus"><?php echo $i;?></td>
                                    <td>{{$row->title}}</td>
                                  
                                    <td>{{$cat->name}} </td>
                                
                                   <?php 
        $bundlecount=App\Bundle_course::where('bundle_id',$row->id)->get(); 
        
        $count=count($bundlecount);?>
        <td>{{$count}}</td>
        <td>{{$row->price}}</td>
                                    <td colspan="3">
                                        
                                       <a href="{{ route('user.bundle.show',$row->id) }}"class="btn btn-info" ><i class="icon-copy fa fa-eye" aria-hidden="true"></i></a>

                            
                       
                                    </td>
                                </tr>
                                <?php $i++;?>
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
