@extends('admin.layouts.app')
@push('before-styles')
   <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/select2/dist/css/select2.min.css">

@endpush
 
@section('content')
<section class="content-header">
      <h1>
       Contact Details List       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}/user/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">About Us</li>
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
                    
                   <form method="post" enctype="multipart/form-data" action="{{ route('admin.aboutus.update',$data->id) }}">
                @csrf
                @method('PATCH')
                 <input type="hidden" id="id" name="id" value="{{$data->id}}"> 
                 <div class="row">
                    <div class="col-sm-12">
                      
                        <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">Change About us Page</h3>
            <div class="float-right">
               
            </div>
        </div>    
                                  <div class="card-body">       <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="firstName">Certificates</label>
                                                <input class="form-control" id="firstName" required placeholder="Certificates" value="{{$data->certificates}}" type="text" name="certificates" required>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="lastName">Degree</label>
                                                <input class="form-control" id="lastName" required placeholder="degree" value="{{$data->degree}}"type="text" name="degree" required>
                                            </div>
                                        </div>
                                    <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="firstName">Teaching Experience</label>
                                                    <input class="form-control" id="firstName" required placeholder="teaching experience" 
                                                value="{{$data->teaching_experience}}" type="text" name="teaching_experience" >
                                               
                                            </div>
                                           <div class="col-md-6 form-group">
                                                <label for="firstName">Instructor</label>
                                                <input class="form-control" id="firstName" required  placeholder="instructor" 
                                                value="{{$data->instructor}}" type="text" name="instructor" >
                                            </div>
                                        </div>
        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label for="firstName">About Content</label>
                                                 <textarea  class="textarea_editor form-control border-radius-0" id="editor1" type="text" name="about" required>{{$data->about}}</textarea>
                                            </div>
                                          
                                        </div>
                                   <div class="row">
                                             <div class="col-md-12 form-group">
                                                <label for="firstName">Stories Content</label>
                                                 <textarea  class="textarea_editor form-control border-radius-0" id="editor2" type="text" name="stories_content" required>{{$data->stories_content}}</textarea>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="lastName">Stories Image</label>
                                                <input class="form-control" id="lastName" placeholder="Image" 
                                                 type="file" name="stories_image">
                                                 @if($data->stories_image)
                                                 <img src="{{url('/')}}/public/uploads/images/{{$data->stories_image}}">
                                                 @endif
                                            </div>
                                        </div>
                                        
                                          <div class="row">
                                             <div class="col-md-12 form-group">
                                                <label for="firstName">Vision Content</label>
                                                 <textarea  class="textarea_editor form-control border-radius-0" id="editor3" type="text" name="vision_content" required>{{$data->stories_content}}</textarea>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="lastName">vision Image</label>
                                                <input class="form-control" id="lastName" placeholder="Image" 
                                                 type="file" name="vision_image">
                                                 @if($data->vision_image)
                                                 <img src="{{url('/')}}/public/uploads/images/{{$data->vision_image}}">
                                                 @endif
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                             <div class="col-md-12 form-group">
                                                <label for="firstName">Mision Content</label>
                                                 <textarea  class="textarea_editor form-control border-radius-0" id="editor4" type="text" name="Mision_content" required>{{$data->stories_content}}</textarea>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="lastName">Mision Image</label>
                                                <input class="form-control" id="lastName" placeholder="Image" 
                                                 type="file" name="mision_image">
                                                 @if($data->mission_image)
                                                 <img src="{{url('/')}}/public/uploads/images/{{$data->mission_image}}">
                                                 @endif
                                            </div>
                                        </div>
                                   <div class="row">
                                             <div class="col-md-12 form-group">
                                                <label for="firstName">Accreditations</label>
                                                 <textarea  class="textarea_editor form-control border-radius-0" id="editor5" type="text" name="accrediations" required>{{$data->accrediations}}</textarea>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="lastName">video</label>
                                                <input class="form-control" id="lastName" placeholder="Image" 
                                                 type="url" name="video" value="{{$data->video}}">
                                                 @if($data->video)
                                                 
                                                 
                                                 @endif
                                            </div>
                                        </div>
                                        <hr>
                                        <button class="btn btn-info waves-effect waves-light " type="submit">Submit</button>
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
    CKEDITOR.replace('editor2')
    CKEDITOR.replace('editor3')
    CKEDITOR.replace('editor4')
     CKEDITOR.replace('editor5')
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

