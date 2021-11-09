@extends('admin.layouts.app')
 @push('before-styles')
   <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="{{url('/')}}/public/teacher/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-----datepicker disable--->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<!----end disable------->
@endpush

@section('content')
<section class="content-header">
      <h1>
        Batch List       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}/user/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Batch</li>
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
              <a href="{{url('admin/batch')}}" class="btn btn-success ">View Batch</a>
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
        
                 <form method="post" action="{{ route('admin.batch.update',$data->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                 <input type="hidden" id="id" name="id" value="{{$data->id}}"> 
                 
                     <div class="row">
                      <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <label>Batch name</label><span>*</span>
                          <input type="text" name="batch_name" value="{{$data->batch_name}}"class="form-control" >
                           @if ($errors->has('batch_name '))
                                        <span class="required">
                                            <strong>{{ $errors->first('batch_name ') }}</strong>
                                        </span>
                                    @endif 
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <label>Batch date</label>
                             <input type="text" name="batch_date" value="{{$data->batch_date}}" class="form-control" id="datepicker">
                                 @if ($errors->has('batch_date'))
                                              <span class="required">
                                                  <strong>{{ $errors->first('batch_date') }}</strong>
                                              </span>
                                 @endif  
                        </div>
                      </div>
             <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <label>Course</label>
                            <select name="course_id" class="form-control">
                                <?php $course=App\Course::where('published',1)->where('type','live class')->get();?>
                                @foreach($course as $course)
                                <option @if($data->course_id ==$course->id)selected @endif value="{{$course->id}}">{{$course->title}}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>


        
                </div>   
                 <div class="row">
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label>course Batach</label><span>*</span>
                  	<select  class="form-control" name="batch_days">
                  	     <?php $course=App\Batch::all();?>
                                @foreach($course as $course)
						<option @if($data->id ==$course->id)selected @endif value="{{$course->id}}">{{$course->batch_days}}</option>
						@endforeach
					</select>
<!---                  <input type="text" name="batch_days" value="{{$data->batch_days}}" class="form-control">
                   @if ($errors->has('course_batch '))
                                <span class="required">
                                    <strong>{{ $errors->first('course_batch ') }}</strong>
                                </span>
                            @endif --->
                </div>
              </div>
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label>Batch Timings</label>
                                        
    <input type="text" name="batch_timings" class="form-control timepicker"  value="{{$data->batch_timings}}"id="image">
                                  @if ($errors->has('batch_timings'))
                                      <span class="required">
                                          <strong>{{ $errors->first('batch_timings') }}</strong>
                                      </span>
                                  @endif  
                </div>
              </div>
        

     <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <label>Teacher</label>
                            <select name="teacher_id" class="form-control">
                                <?php $teacher=App\User::where('status','Active')->where('role_id',2)->get();?>
                                @foreach($teacher as $teacher)
                                <option @if($data->teacher_id ==$course->teacher_id)selected @endif  value="{{$teacher->id}}">{{$teacher->name}}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>
        
                </div>  
  <button type="submit"   class="btn btn-success">Submit</button>
                 
                               <a href="{{ url('admin/batch') }}"
                       class="btn btn-danger">Cancel</a>
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
  <!-----datepicker disable--->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<!----end disable------->
<script>
  $(function () {
  
  
    //Date picker

   $('#datepicker').datepicker({
           minDate: 0 

   //   autoclose: true
    })

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
@endpush
                
@endsection

