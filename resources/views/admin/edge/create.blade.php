@extends('admin.layouts.app')
 @push('before-styles')
   <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/select2/dist/css/select2.min.css">

@endpush

@section('content')
<section class="content-header">
      <h1>
        Blog List       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}/user/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edge</li>
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
              <a href="{{url('admin/edge')}}" class="btn btn-success ">View Edge</a>
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
        
                   <form method="post" action="{{ route('admin.edge.store') }}"enctype="multipart/form-data">
                    @csrf
           
                     <div class="row">
                     <div class="col-md-4 col-sm-12">

                      <div class="form-group">
                            <label for="productname">Title <span class="required">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}" placeholder="Enter title" required/>
                            @if ($errors->has('title '))
                                <span class="required" style="color:red">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif  
                          </div>
                          </div>
                                                    </div>
                                                                         <div class="row">

                                        <div class="col-md-12 col-sm-12">


                             <div class="form-group">
                            <label for="productname">Description <span class="required">*</span></label>
                           <textarea name="description" class="form-control" id="editor3"></textarea>
                            @if ($errors->has('description'))
                                <span class="required">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif  
                          </div>
                        
                                                  </div>
                                                  </div>                   
                            <div class="form-group">
                              <div class="dynamicRadio">
                                <div class="row">
                                  <div class="col-md-2"><label>SubTitle</label>
                                      <span class="required">*</span>
                                      <input name = "name[]" type="text" min="0" class="form-control" Placeholder="Enter Sub Title" />
                                  </div>
                                  <div class="col-md-2"><label>Images</label>
                                      <span class="required">*</span>
                                      <input name = "logo[]" type="file" class="form-control" Placeholder="Enter logo" />
                                  </div>
                                  
                                  <div class="col-md-2">
                                      <label>&nbsp;</label><br>
                                      <input id="btnCakePrice" class="btn-primary" type="button" value="Add More" />
                                  </div>
                                <div>
                              </div>
                            </div>
                            <div id="ProductContainer"></div>
                         </div>

        
                </div>   
                
  <button type="submit"   class="btn btn-success">Submit</button>
                 
                               <a href="{{ url('admin/edge') }}"
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

<!-- CK Editor -->

<script type="text/javascript">

  $("#btnCakePrice").bind("click", function () {
      var div = $("<div />");
      div.html(GetDynamicProductPriceWeight(""));
      $("#ProductContainer").append(div);
  });
  $("body").on("click", ".removeRadio", function () {
      $(this).closest(".dynamicRadio").remove();
  });
  function GetDynamicProductPriceWeight(value) {
      return '<div class="dynamicRadio"> <div class="row"> <div class="col-md-2"> <br> <input name="name[]" type="text" min="0" class="form-control" placeholder="Enter Sub Title"></div> <div class="col-md-2"> <br> <input name="logo[]" type="file" class="form-control" placeholder="Enter Logo"></div><br> <div><input type="button" value="Remove" class="removeRadio btn btn-danger"></div> </div></div>'
  }
</script>

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
@endpush
                
@endsection

