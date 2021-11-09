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
        <li class="active">Contact Details</li>
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
                    
                   <form method="post" action="{{ route('admin.contacts.update',$data->id) }}">
                @csrf
                @method('PATCH')
                 <input type="hidden" id="id" name="id" value="{{$data->id}}"> 
                 <div class="row">
                    <div class="col-sm-12">
                      
                        <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">Change Contact details</h3>
            <div class="float-right">
               
            </div>
        </div>    
                                  <div class="card-body">       <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="firstName">Email</label>
                                                <input class="form-control" id="firstName" placeholder="email" value="{{$data->email}}" type="email" name="email" required>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="lastName">Phone number</label>
                                                <input class="form-control" id="lastName" placeholder="number" value="{{$data->phone}}"type="number" name="phone" required>
                                            </div>
                                        </div>
                                    <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="firstName">Address</label>
                                                <textarea  class="form-control" type="text" name="address" required>{{$data->address}}</textarea>
                                            </div>
                                           <div class="col-md-6 form-group">
                                                <label for="firstName">pintrest</label>
                                                <input class="form-control" id="firstName" placeholder="pintrest" 
                                                value="{{$data->pintrest}}" type="url" name="pintrest" >
                                            </div>
                                        </div>
        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="firstName">facebook</label>
                                                <input class="form-control" id="firstName" placeholder="facebook" value="{{$data->facebook}}" type="url"
                                                name="facebook" >
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="lastName">Instagram</label>
                                                <input class="form-control" id="lastName" placeholder="instagram" 
                                                value="{{$data->instagram}}" type="url" name="instagram">
                                            </div>
                                        </div>
                                   <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="firstName">Twitter</label>
                                                <input class="form-control" id="firstName"
                                                placeholder="twitter" value="{{$data->twitter}}" type="url" name="twitter" >
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="lastName">Linkedin</label>
                                                <input class="form-control" id="lastName" placeholder="linkedin" 
                                                value="{{$data->linkedin}}" type="url" name="linkedin">
                                            </div>
                                        </div>
                                         <div class="row">
                                           
                                              <div class="col-md-6 form-group">
                                                <label for="lastName">Map</label>
                                                <textarea class="form-control" id="lastName"  type="text" name="map_link"lastname"map_link">{{$data->map_link}}</textarea>
                                            </div>
                                            <div class="col-6 ">
                                    <h3>How to embed Location for Map?</h3>
                                <p>Do following simple steps and you are good to go:</p>
                                <ol >
                                    <li>Go to <a class="text-bold" target="_blank" href="//maps.google.com">Google Map</a> </li>
                                    <li>Search the place you want to add by Entering address / location in input box located on upper-left corner</li>
                                    <li>Once you get the place you want. It shows details in left sidebar. Click on <i class="fa fa-share-alt text-primary"></i> button</li>
                                    <li>A popup will appear which will have two tabs <b>Send a link</b> and <b>Embed a Map</b></li>
                                    <li>Click on <b>Embed a map</b> It will show you chosen Place on Map</li>
                                    <li>Now click on the dropdown from the left. By default <b>Medium</b> is selected. Click on it and Select <b>Large</b></li>
                                    <li>Now Click on <b class="text-primary">COPY HTML</b> link from it and <b>Paste</b> that code here in <b>Location on Map</b>.</li>
                                </ol>
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

