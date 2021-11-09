@extends('admin.layouts.app')
 @push('before-styles')
   <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/select2/dist/css/select2.min.css">

@endpush

@section('content')
<section class="content-header">
      <h1>
        Teachers List       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}/user/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Teachers</li>
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
              <a href="{{url('admin/teachers')}}" class="btn btn-success ">View Teachers</a>
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
                   <form method="post" action="{{ route('admin.teachers.store') }}"enctype="multipart/form-data">
                    @csrf

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">First Name</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="firstname" placeholder="First Name" required>
                            </div>
                            @if ($errors->has('firstname '))
                                <span class="required">
                                    <strong>{{ $errors->first('firstname ') }}</strong>
                                </span>
                            @endif 
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Last Name</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="lastname" placeholder="Last Name" >
                            </div>
                            @if ($errors->has('lastname '))
                                <span class="required">
                                    <strong>{{ $errors->first('lastname ') }}</strong>
                                </span>
                            @endif 
                        </div>
                       
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" placeholder="email" type="email" name="email" required>
                            </div>
                            @if ($errors->has('email '))
                                <span class="required">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif 
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Password</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="password" placeholder="Password" type="password" required>
                            </div>
                            @if ($errors->has('password '))
                                <span class="required">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif 
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">About Teachers</label>
                            <div class="col-sm-12 col-md-10">
                                <textarea id="editor1" class="form-control" row='2' cols="3" name="description"></textarea>
                            </div>
                             @if ($errors->has('description'))
                                <span class="required">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif 

                        </div>
                       
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Gender</label>
                            <div class="col-sm-12 col-md-10">
                                <select class="custom-select col-12" name="gender" required>
                                    <option selected="">Choose...</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                 
                                </select>
                                 @if ($errors->has('gender'))
                                      <span class="required">
                                          <strong>{{ $errors->first('gender') }}</strong>
                                      </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Image</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="images" type="file">
                            </div>
                             @if ($errors->has('images'))
                                      <span class="required">
                                          <strong>{{ $errors->first('images') }}</strong>
                                      </span>
                                    @endif
                        </div>
                       <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Status</label>
                            <div class="col-sm-12 col-md-10">
                                 <input type="checkbox" name="status"checked class="switch-btn" data-color="#0059b2" value="active">
                            </div>
                        </div>
  <button type="submit"   class="btn btn-success">Submit</button>
                 
                               <a href="{{ url('admin/teachers') }}"
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

