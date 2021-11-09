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
        
  <form method="post" action="{{ route('admin.livelessons.update',$data->id) }}"enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                 <input type="hidden" id="id" name="id" value="{{$data->id}}"> 
<div class="card-body">
<div class="row">
<div class="col-md-12 col-lg-6 form-group">
<label for="course_id" class="control-label">Course</label>
<select class="select2 form-control" name="course_id" style="width: 100%; height: 38px;">
<optgroup >
@foreach($course as $row)
    <option @if($data->course_id ==$row->id)selected @endif value="{{$row->id}}">{{$row->title}}</option>

 @endforeach
</optgroup>
</select>
</div>
<div class="col-md-12 col-lg-6 form-group">
<label for="title" class="control-label">Lesson Title*</label>
<input class="form-control" value="{{$data->title}}" placeholder="Title" required name="title" type="text" id="title">
</div>
</div>


<div class="row">
<div class="col-md-12 col-lg-6 form-group">
<label for="slug" class="control-label">Slug</label>
<input class="form-control" placeholder="Input slug or it will be generated automatically" name="slug"value="{{$data->slug}}" type="text" id="slug">

</div>
<div class="col-md-12 col-lg-3 form-group">
<label for="lesson_image" class="control-label">Lesson Image</label>
<input class="form-control" accept="image/jpeg,image/gif,image/png" name="lesson_image" type="file" id="lesson_image">

</div>
<div class="col-md-12 col-lg-3 form-group">
    <img src="{{ URL::to('/') }}/public/uploads/lessons/{{ @$data->lesson_image }}" style="width: 100%;" />
    </div>
</div>
<div class="row">
<div class="col-md-12 form-group">
<label for="short_text" class="control-label">Short Text</label>
<textarea class="form-control " placeholder="Enter short text" name="short_text" cols="50" rows="10" id="editor2">{{$data->short_text}}</textarea>

</div>
</div>
<div class="row">
<div class="col-md-12 form-group">
<label for="full_text" class="control-label">Full Text</label>
<textarea class="textarea_editor form-control border-radius-0" placeholder="Enter full_tex ..."  id="editor1" name="full_text">{{$data->full_text}}</textarea>


</div>
</div>

<div class="row">
<div class="col-md-6 form-group">
<label for="downloadable_files" class="control-label">Presentation(.xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf)</label>
<input multiple class="form-control file-upload" id="downloadable_files" name="downloadable_files[]" type="file" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf">
 @if ($errors->has('downloadable_files '))
                                <span class="required">
                                    <strong>{{ $errors->first('downloadable_files ') }}</strong>
                                </span>
                            @endif 

</div>

    <div class="col-md-6 form-group">
        <?php $images = App\Lessons_media::where('lesson_id',$data->id)->where('name','=','downloadable_files')->get();?>
        @foreach($images as $row)
        <a href="{{ URL::to('/') }}/public/uploads/downloadable_files/{{ @$row->filename }}" target="_blank">{{$row->filename}}</a>
      <button  class="btn btn-danger" id="delete-multiple-image{{ $row->id }}" form="resource-delete-{{ $row->id }}"><i class="fa fa-trash"></i>
                            </button> 
                             <form action="{{url('admin/livelessons/delete-multiple-downloadable_files')}}?id={{$row->id}}" id="resource-delete-{{ $row->id }}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                            @csrf
                            </form>
    @endforeach
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

  <div class="col-md-6 form-group">
        <?php $images = App\Lessons_media::where('lesson_id',$data->id)->where('name','=','add_pdf')->get();?>
        @foreach($images as $row)
    <a href="{{ URL::to('/') }}/public/uploads/lessons/pdf/{{ @$row->filename }}" target="_blank">{{$row->filename}}</a>
      <button  class="btn btn-danger" id="delete-multiple-image{{ $row->id }}" form="resource-delete-{{ $row->id }}"><i class="fa fa-trash"></i>
                            </button> 
                             <form action="{{url('admin/livelessons/delete-multiple-addpdf')}}?id={{$row->id}}" id="resource-delete-{{ $row->id }}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                            @csrf
                            </form>
    @endforeach
    </div>
<div class="row">
      <div class="col-md-12 form-group">
        <?php $pdf = App\Lessons_media::where('lesson_id',$data->id)->where('name','=','add_pdf')->first();?>
      
    <input type="hidden" name="oldpdf" value="{{ @$pdf->filename }}">
@if( !empty( @$pdf->filename ))
    <embed
    src="{{ URL::to('/') }}/public/uploads/lessons/pdf/{{ @$pdf->filename }}"
    style="width:800px; height:700px;"
    frameborder="0">
   @endif
    </div>
    </div>
<!--
<div class="row">
<div class="col-md-6 form-group">
<label for="audio_files" class="control-label">Add Audio</label>
<input class="form-control file-upload" id="add_audio" accept="audio/mpeg3" name="add_audio" type="file" accept="audio/*">
 @if ($errors->has('add_audio '))
                                <span class="required">
                                    <strong>{{ $errors->first('add_audio ') }}</strong>
                                </span>
                            @endif 
</div>

      <div class="col-6 form-group">
        <?php $audio = App\Lessons_media::where('lesson_id',$data->id)->where('name','=','add_audio')->first();?>
    
  
  
    <audio controls>
    <source src="{{ URL::to('/') }}/public/uploads/lessons/audio/mp3/{{ @$audio->filename }}"type="audio/mp3">
   
</audio>
   
    </div>
  
</div>--->

                 
                 
                  <div class="row">
 <div class="col-md-12 col-sm-12">
                <div class="form-group">
                     <?php $aud = App\Lessons_media::where('lesson_id',$data->id)->where('name','embed')->first();?>
                  <label>Video</label>
                                    <input type="hidden" name="media_id" value="{{$aud->id}}">

                   <select class="form-control" name="type">
            <option>select one</option>
<!---            <option value="red" @if($aud->name=='youtube')selected @endif>Youtube</option>--->
            <option value="green"@if($aud->name=='embed')selected @endif>Embed</option>
          
        </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
          <div class="red box1"><input type="text" name="url1" placeholder="enter youtube link"class="form-control" value="{{$aud->url}}"></div>
    <div class="green box1"><input type="text" name="url2" placeholder="enter embed code"class="form-control" value="{{$aud->url}}"></div>
    <div class="blue box1"><input type="file" name="url3"class="form-control" value="{{$aud->url}}"></div>
                 </div>
                 </div>
                 </div>
                      
                 
<div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="custom-control custom-checkbox ">  
                 <input type="checkbox" class="custom-control-input" value="1"id="customCheck1" name="published" @if($data->published==1)checked
                 @else
                 @endif
                 >
                    <label class="custom-control-label" for="customCheck1">Published</label>
                  </div>
                </div>
              </div>
              <br>
<div class="col-12 text-left form-group">
 <button type="submit"   class="btn btn-success">Submit</button>
                 
                               <a href="{{ url('admin/livelessons') }}"
                       class="btn btn-danger">Cancel</a>
</div>
</form>




            <hr>

                 
                 
                 
                 
                    <div class="row">
                        @foreach($lessons_video as $row)
                        
                        <div class="col-sm-12">
                          <div style="position: relative;"><div class="col-3">
                        <input type="text" name="video_title" placeholder="enter Video Title"class="form-control" value="{{$row->video_title}}"></div>
                        <div class="col-3"><input type="text" name="Video_type" placeholder="enter Video Type"class="form-control" value="{{$row->type}}"></div>
                           <a href="{{$row->video_link}}">{{$row->video_link}}</a>
                            <button style="position: absolute; right: 0px;
                              font-size: 18px;" id="delete-multiple-video{{ $row->id }}" form="resource-delete-{{ $row->id }}"><i style="color: red;" class="fa fa-trash"></i>
                            </button>  
                            </div>
                          <div>
                            <form action="{{url('admin/livelessons/delete-multiple-video')}}?id={{$row->id}}" id="resource-delete-{{ $row->id }}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                            @csrf
                            </form>
                          </div>
                     
                        </div>
                        
                        @endforeach
                      </div>
                    <form enctype="multipart/form-data" method="post" action="{{url('admin/livesessons/addMoreVideo')}}">
                      @csrf
                      <input type="hidden" name="lesson_id" value="{{$data->id}}">
                      <h3>Add More Videos</h3>
                      <div class="form-group">
                        <div class="dynamicRadioo">
                          <div class="row">
                        
                                 <div class="col-md-2"><label>video title</label>
                                      <span class="required">*</span>
                                      <input name = "video_title[]" type="text" class="form-control" Placeholder="Enter name" />
                                  </div>
                                  <div class="col-md-2">
                                      <label>Video </label>
                                      <span class="required">*</span>
                                      <input name = "video_link[]" type="url" min="0" class="form-control" Placeholder="Enter Link" />
                                  </div>
                                   <div class="col-md-6">
                                      <label>Video short Description</label>
                                      <span class="required">*</span>
                                      <input name = "video_short_desc[]" type="url" min="0" class="form-control" Placeholder="Enter description"  />
                                  </div>
                                  <div class="col-md-2">
                                      <label>&nbsp;</label><br>
                                      <input id="btnCakePrice1" class="btn-primary" type="button" value="Add More" />
                                  </div>
                          <div>
                        </div>
                      </div>
                      <div id="ProductContainer"></div>
                      <br>
                      <div class="form-group">
                        <button id="submit" type="submit" class="btn btn-primary">Add Price</button>
                      </div>
                    </form>
                 
                 
              <hr>
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
      $("#ProductContainer").append(div);
  });
  $("body").on("click", ".removeRadioo", function () {
      $(this).closest(".dynamicRadioo").remove();
  });
  function GetDynamicProductPriceWeight1(value) {
      return '<div class="dynamicRadioo"><div class="row"><div class="col-md-2"> <br> <input name="video_title[]" type="text" class="form-control" placeholder="Enter name" required/></div><div class="col-md-6"> <br> <input name="video_link[]" type="url" min="0" class="form-control" placeholder="Enter link" required/></div><div class="col-md-2"><br> <input name="video_short_desc[]" type="text" min="0" class="form-control" placeholder="Enter description" required/></div><div class="col-md-2"> <br> <input type="button" value="Remove" class="removeRadioo btn btn-danger" /></div></div></div>'
  }
</script>

@endpush
                
@endsection

