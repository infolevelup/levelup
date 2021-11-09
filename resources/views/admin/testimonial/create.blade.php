@extends('admin.layouts.app')
@push('before-styles')
   <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/select2/dist/css/select2.min.css">

@endpush
 
@section('content')
<section class="content-header">
      <h1>
        Testimonial List       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}/user/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Testimonial</li>
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
              <a href="{{route('admin.testimonial.index')}}"  class="btn btn-success ">View Testimonial</a>
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
                    
         
              <form enctype="multipart/form-data" role="form" id="myform" method="post" action="{{ route('admin.testimonial.store') }}">
                @csrf
               
                
                 <div class="row">
                    <div class="col-sm-12">
                       
                          <div class="form-group">
                            <label for="productname">Name<span class="required">*</span></label>
                            <input type="text" name="name" id="title" class="form-control" value="{{old('title')}}" placeholder="Enter name" required/>
                            @if ($errors->has('name'))
                                <span class="required" style="color:red">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif  
                          </div>
                            <div class="form-group">
                            <label for="productname">Location </label>
                            <input type="text" name="short_desc" id="newsdate" class="form-control" value="{{old('newsdate')}}" placeholder="Enter description" />
                            @if ($errors->has('short_desc'))
                                <span class="required">
                                    <strong>{{ $errors->first('short_desc') }}</strong>
                                </span>
                            @endif  
                          </div>
                               <div class="form-group">
                            <label for="productname">Video </label>
                            <input type="text" name="video" id="newsdate" class="form-control" value="{{old('newsdate')}}" placeholder="Enter Video link" />
                            @if ($errors->has('video'))
                                <span class="required">
                                    <strong>{{ $errors->first('video') }}</strong>
                                </span>
                            @endif  
                          </div>
                             <div class="form-group">
                            <label for="productname">Description <span class="required">*</span></label>
                           <textarea name="long_desc" class="form-control" required></textarea>
                            @if ($errors->has('long_desc'))
                                <span class="required">
                                    <strong>{{ $errors->first('long_desc') }}</strong>
                                </span>
                            @endif  
                          </div>
                        
                        
                        
                            <div class="form-group">
                              <label for="images">Choose Image </label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" name="images" class="custom-file-input" id="images" multiple>
                                    @if ($errors->has('images'))
                                      <span class="required">
                                          <strong>{{ $errors->first('images') }}</strong>
                                      </span>
                                    @endif  
                                    <label class="custom-file-label" for="images">Choose image file</label>
                                  </div>
                                </div>
                            </div>
                          
                            <div class="form-group">
                              <div class="dynamicRadio">
                             
                            <div id="ProductContainer"></div>
                            <br>
                           <div class="form-group">
                            <button id="submit" type="submit" class="btn btn-primary">Create Testimonial</button>
                          </div>
                    </div>
                 </div>
                </div>
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

