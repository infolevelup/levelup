@extends('admin.layouts.app')
@push('before-styles')
   <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/select2/dist/css/select2.min.css">

@endpush
@push('after-styles')
    <!-- switchery css -->

 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $("select").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".box1").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".box1").hide();
            }
        });
    }).change();
});
</script>

    @endpush

@section('content')
<section class="content-header">
      <h1>
        Lessons List       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}/user/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Lessons</li>
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
              <a href="{{url('admin/livelessons')}}"  class="btn btn-success ">View Lessons</a>
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
        

<form method="post" action="{{ route('admin.livelessons.store') }}" enctype="multipart/form-data">
@csrf
<div class="card-body">
<div class="row">
<div class="col-md-12 col-lg-6 form-group">
<label for="course_id" class="control-label">Select Course</label>
<select class="select2 form-control" name="course_id" style="width: 100%; height: 38px;" data-placeholder="Select a course" required>
<optgroup >
@foreach($category as $row)

                                    <option value="{{$row->id}}">{{$row->title}}</option>
                                   
                                 @endforeach
</optgroup>
</select>
</div>
<div class="col-md-12 col-lg-6 form-group">
<label for="title" class="control-label">Lesson Title*</label>
<input class="form-control" placeholder="Title" required name="title" type="text" id="title">
</div>
</div>


<div class="row">
<div class="col-md-12 col-lg-6 form-group">
<label for="slug" class="control-label">Slug</label>
<input class="form-control" placeholder="Input slug or it will be generated automatically" name="slug" type="text" id="slug">

</div>
<div class="col-md-12 col-lg-6 form-group">
<label for="lesson_image" class="control-label">Lesson Image</label>
<input class="form-control" accept="image/jpeg,image/gif,image/png" name="lesson_image" type="file" id="lesson_image">
</div>
</div>
<div class="row">
<div class="col-md-12 form-group">
<label for="short_text" class="control-label">Short Text</label>
<textarea class="form-control " placeholder="Enter short text" id="editor3" name="short_text" cols="50" rows="10" ></textarea>

</div>
</div>
<div class="row">
<div class="col-md-12 form-group">
<label for="full_text" class="control-label">Full Text</label>
<textarea class="textarea_editor form-control border-radius-0" id="editor2" placeholder="Enter full_tex ..." name="full_text"></textarea>


</div>
</div>

<div class="row">
<div class="col-md-12 form-group">
<label for="downloadable_files" class="control-label">Presentation(.xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf)</label>
<input multiple class="form-control file-upload" id="downloadable_files" name="downloadable_files[]" type="file" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf">
 @if ($errors->has('downloadable_files '))
                                <span class="required">
                                    <strong>{{ $errors->first('downloadable_files ') }}</strong>
                                </span>
                            @endif 
<div class="photo-block">
<div class="files-list"></div>
</div>

</div>
</div>
<div class="row">
<div class="col-md-12 form-group">
<label for="pdf_files" class="control-label">Add PDF</label>
<input multiple class="form-control file-upload" id="add_pdf" accept="application/pdf" name="add_pdf" type="file" >
 @if ($errors->has('add_pdf '))
                                <span class="required">
                                    <strong>{{ $errors->first('add_pdf ') }}</strong>
                                </span>
                            @endif 
</div>
</div>

<div class="row">
 <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label>Video</label>
                   <select class="form-control" name="type">
            <option>select one</option>
            <option value="green">Embed</option>
          
        </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
          <div class="red box1"><input type="text" name="url1" placeholder="enter youtube link"class="form-control"></div>
    <div class="green box1"><input type="text" name="url2" placeholder="enter embed code"class="form-control"></div>
    <div class="blue box1"><input type="file" name="url3"class="form-control"></div>
                 </div>
                 </div>
                 </div>  

              
              
                        <div class="dynamicRadioo">
                                <div class="row">
                               
                                 <div class="col-md-2"><label>video title</label>
                                      <span class="required">*</span>
                                      <input name = "video_title[]" type="text" class="form-control" Placeholder="Enter name" required/>
                                  </div>
                                  <div class="col-md-2">
                                      <label>Video </label>
                                      <span class="required">*</span>
                                      <input name = "video_link[]" type="url" min="0" class="form-control" Placeholder="Enter Link" required/>
                                  </div>
                                   <div class="col-md-6">
                                      <label>Video short Description</label>
                                      <span class="required">*</span>
                                      <input name = "video_short_desc[]" type="text" min="0" class="form-control" Placeholder="Enter description" required />
                                  </div>
                                  <div class="col-md-2">
                                      <label>&nbsp;</label><br>
                                      <input id="btnCakePrice1" class="btn-primary" type="button" value="Add More" />
                                  </div>
                                <div>
                              </div>
                            </div>
              
							<div id="ProductContainer1"></div>
              <br>
              
<div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="custom-control custom-checkbox ">  
                 <input type="checkbox" class="custom-control-input" value="1"id="customCheck1" name="published">
                    <label class="custom-control-label" for="customCheck1">Published</label>
                  </div>
                </div>
              </div>
                            
<div class="col-12 text-left form-group">
 <button type="submit"   class="btn btn-success">Submit</button>
                 
                               <a href="{{ url('admin/lessons') }}"
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
     CKEDITOR.replace('editor2')
      CKEDITOR.replace('editor3')
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

<script type="text/javascript">

  $("#btnCakePrice1").bind("click", function () {
	 // alert('a');
      var div = $("<div />");
      div.html(GetDynamicProductPriceWeight1(""));
      $("#ProductContainer1").append(div);
  });
  $("body").on("click", ".removeRadioo", function () {
      $(this).closest(".dynamicRadioo").remove();
  });
  function GetDynamicProductPriceWeight1(value) {
      return '<div class="dynamicRadioo"><div class="row"><div class="col-md-2"> <br> <input name="video_title[]" type="text" class="form-control" placeholder="Enter name" required/></div><div class="col-md-2"> <br> <input name="video_link[]" type="url" min="0" class="form-control" placeholder="Enter link" required/></div><div class="col-md-6"><br> <input name="video_short_desc[]" type="text" min="0" class="form-control" placeholder="Enter description" required/></div><div class="col-md-2"> <br> <input type="button" value="Remove" class="removeRadioo btn btn-danger" /></div></div></div>'
  }
</script>

@endpush
                
@endsection

