@extends('admin.layouts.app')
@push('before-styles')
   <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/select2/dist/css/select2.min.css">

@endpush
 
@section('content')
<section class="content-header">
      <h1>
        Pages List       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}/user/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pages</li>
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
              <a href="{{route('admin.pages.index')}}"  class="btn btn-success ">View Pages</a>
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
                    
           
              <form method="post" action="{{ route('admin.pages.update',$data->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
             
               <input type="hidden" id="id" value="{{$data->id}}"> 
            
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="title" class="control-label">Title</label>
                    <input class="form-control" placeholder="Title" name="title" type="text" id="title" value="{{$data->title}}">
                </div>

            </div>

            <div class="row">
                <div class="col-md-12 col-lg-4 form-group">
                    <label for="slug" class="control-label">Slug</label>
                    <input class="form-control" placeholder="Input slug or it will be generated automatically" name="slug" type="text" id="slug"value="{{$data->slug}}">

                </div>
                <div class="col-md-12 col-lg-4 ">
                     <img src="{{ URL::to('/') }}/public/uploads/images/{{ @$data->image}}" style="width: 50%;" /><br>
                    </div>
                                <div class="col-md-12 col-lg-4 form-group">

                    <label for="page_image" class="control-label">Banner image</label>
                    <input class="form-control" accept="image/jpeg,image/gif,image/png" name="page_image" type="file" id="page_image">
                    <input name="page_image_max_size" type="hidden" value="8">
                    <input name="page_image_max_width" type="hidden" value="4000">
                    <input name="page_image_max_height" type="hidden" value="4000">

                </div>
            </div>
            
            <div class="row">
                <div class="html-editor col-md-12 form-group">
                    <label for="content" class="control-label">Content</label>
                    <textarea class="textarea_editor form-control editor" placeholder="" id="editor" name="content" cols="50" rows="10">{{$data->content}}</textarea>

                </div>
            </div>

  <div class="row">
                <div class="col-md-12 form-group">
                    <label for="meta_title" class="control-label">icon</label>
                    <input class="form-control" placeholder="icon" value="{{$data->icon}}" name="icon" type="text" id="meta_title">

                </div>
                </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="meta_title" class="control-label">Meta Title</label>
                    <input class="form-control" placeholder="Meta Title" name="meta_title" type="text" id="meta_title" value="{{$data->meta_title}}">

                </div>
                <div class="col-md-12 form-group">
                    <label for="meta_description" class="control-label">Meta Description</label>
                    <textarea class="form-control" placeholder="Meta Description" name="meta_description" cols="50" rows="10" id="meta_description">{{$data->meta_description}}</textarea>
                </div>
                <div class="col-md-12 form-group">
                    <label for="meta_keywords" class="control-label">Meta Keywords</label>
                    <textarea class="form-control" placeholder="Meta Keywords" name="meta_keywords" cols="50" rows="10" id="meta_keywords">{{$data->meta_keywords}}</textarea>
                </div>
                <div class="col-md-12 form-group">
                    <div class="checkbox d-inline mr-3">
                        <input name="published" type="hidden" value="0">
                        <input name="published" type="checkbox" value="1" <?php if($data->published==1){echo 'checked';}?>>
                        <label for="published" class="checkbox control-label font-weight-bold">Published</label>
                    </div>
                   
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center form-group">
                    <button type="submit" class="btn btn-info waves-effect waves-light ">
                       Save
                    </button>
                  
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
    CKEDITOR.replace('editor')
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

