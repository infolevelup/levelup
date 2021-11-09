@extends('admin.layouts.app')
 @push('before-styles')
   <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="{{url('/')}}/public/teacher/plugins/timepicker/bootstrap-timepicker.min.css">

@endpush

@section('content')
<section class="content-header">
      <h1>
Class List      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}/user/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Class</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
           <div class="box box-primary">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <a href="{{url('admin/class')}}" class="btn btn-success ">View Class</a>
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
             
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        
                   <form method="post" action="{{ route('admin.class.store') }}"enctype="multipart/form-data">
                    @csrf
           
                     <div class="row">
                     
                     
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <label>Select Batch</label>
                            <select name="batch_id" class="form-control">
                                <?php $teacher=App\Batch::all();?>
                                @foreach($teacher as $teacher)
                                <option value="{{$teacher->id}}">{{$teacher->batch_name}}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>
       
                      <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <label>Zoom link</label>
                             <input type="text" name="zoom_link" class="form-control" id="image">
                                 @if ($errors->has('zoom_link'))
                                              <span class="required">
                                                  <strong>{{ $errors->first('zoom_link') }}</strong>
                                              </span>
                                 @endif  
                        </div>
                      </div>
               <div class="col-md-4 col-sm-12">        
              <div class="input-group">
                    <label>Time</label>
                    <input type="text" class="form-control timepicker" name="time">
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  </div>
                  
                </div>   
                 <div class="row">
             
                          <div class="col-md-4 col-sm-12">
                        <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker" name="date">
                </div>
                      </div></div>
             <div style="padding-top:20px;">        
                      
  <button type="submit"   class="btn btn-success">Submit</button>
                 
                               <a href="{{ url('admin/class') }}"
                       class="btn btn-danger">Cancel</a></div> 
                    </form>
                 
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
<!-- CK Editor -->
<script src="{{url('/')}}/public/teacher/bower_components/ckeditor/ckeditor.js"></script>
<script src="{{url('/')}}/public/teacher/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{url('/')}}/public/teacher/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="{{url('/')}}/public/teacher/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>


<script>
  $(function () {
  
  
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
@endpush
                
@endsection

