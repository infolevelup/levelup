@extends('user.layouts.app')
 @push('before-styles')
   <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/select2/dist/css/select2.min.css">

@endpush

@section('content')
   
 <section class="content-header">
      <h1>
        Test List       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}/user/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Test</li>
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
              <a href="{{url('user/test')}}" class="btn btn-success ">View Test</a>
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
              <form method="post" action="{{ route('user.test.update',$data->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
             
               <input type="hidden" id="id" value="{{$data->id}}"> 
                <div class="container">
                
            <div class="row">
              <div class="col-md-6 ">
                <div class="form-group">
                  <label>select Course</label>
                  <select class="form-control select2 col-12" name="course_id" required>
                                        <optgroup >
                            <option>Please select</option>
                            @foreach($course as $row)
                                    <option value="{{$row->id}}"<?php if($row->id==$data->course_id) {echo 'selected';}?> >{{$row->title}}</option>
                                   
                                 @endforeach
                               </optgroup>
                                </select>
  @if ($errors->has('course_id'))
                                <span class="required" style="color:red">
                                    <strong>{{ $errors->first('course_id') }}</strong>
                                </span>
                            @endif 
                </div>
              </div>
               <div class="col-md-4">
                <div class="form-group">
                  <label>Lesson</label>
                  <select class="form-control select2 " name="lesson_id" required>
                                        <optgroup >
                            <option>Please select lesson</option>
                            @foreach($lesson as $roww)
                                    <option value="{{$roww->id}}" <?php if($roww->id==$data->lesson_id){echo 'selected';}?>>{{$roww->title}}</option>
                                   
                                 @endforeach
                               </optgroup>
                                </select>
                            @if ($errors->has('lesson_id'))
                                <span class="required" style="color:red">
                                    <strong>{{ $errors->first('lesson_id') }}</strong>
                                </span>
                            @endif 
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                
                  <label>Title*</label>
                  <input type="text" name="title"class="form-control" placeholder="Title" value="{{$data->title}}"required>
                    @if ($errors->has('title'))
                                <span class="required" style="color:red">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif 
                </div>
              </div>
            
            </div>

     
            <div class="row">
              <div class="col-md-10 col-sm-12">
                <div class="form-group">
                  <label>Description</label>
                 <div class="html-editor pd-20 card-box mb-30">
         
          <textarea id="editor1"  rows="10" cols="80"  placeholder="Enter text ..." name="description">{{$data->description}}</textarea>
            @if ($errors->has('description'))
                                <span class="required" style="color:red">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif 
        </div>
                </div>
              </div>
            </div>
     
                <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="form-group ">  
                                         <input type="checkbox" class="custom-control-input" value="1"id="customCheck1"name="published" <?php if($data->published==1) {echo 'checked';}?>>

                    <label class="custom-control-label" for="customCheck1">Published</label>
                  
                  </div>
                    </div></div>
                   
              <button type="submit"   class="btn btn-success">Submit</button>
                 
                               <a href="{{ url('user/test') }}"
                       class="btn btn-danger">Cancel</a>
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