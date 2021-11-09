@extends('admin.layouts.app')
 @push('before-styles')
   <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/select2/dist/css/select2.min.css">

@endpush

@section('content')
<section class="content-header">
      <h1>
        Category List       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}/user/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Category</li>
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
              <a href="{{url('admin/batch')}}" class="btn btn-success ">View Category</a>
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
        
                 <input type="hidden" id="id" name="id" value="{{$data->id}}"> 
                 
                     <div class="row">

 <form method="get" action="">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <label>Course</label>
                            <select name="course_id" class="form-control" onchange="this.form.submit()">
                                
                               
                         
                                @foreach($categories  as $course)
                                <option @if(@$_REQUEST['course_id'] == $course->id) selected @endif  value="{{$course->id}}">{{$course->title}}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>        
</form>

<form method="post" action="{{ route('admin.assignbatch.store') }}"enctype="multipart/form-data">
                    @csrf
                    
                     @if(isset($_REQUEST['category_id']) && $_REQUEST['category_id'] != '')
                  <input type="hidden" name="course_id" value="{{@$_REQUEST['course_id']}}">
                @else
                  <input type="hidden" name="course_id" value="{{@$firstcategory->id}}">
                @endif
               
<div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <label>Batch</label>
                          
                                @if(count($subcategories))
                            <select name="batch_id" class="form-control" required>
                                
                                @foreach($subcategories as $batch)
                                <option @if(@$_REQUEST['subcategory_id'] == $batch->id) selected @endif value="{{$batch->id}}">{{$batch->batch_name}}</option>
                                @endforeach
                                
                              
                            @else
                            
                            <p>  No Batch Found.  Please Create a Subcategory for this category <a target="_blank" href="{{url('/')}}/admin/batch/create">Here</a></p>
                            @endif
                            </select>
                        </div>
                      </div>


<div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <label>Users</label>
                          
                            <select name="user_id[]" class="form-control select2" multiple="multiple" required data-placeholder="Select a user"
                        style="width: 100%;">
                                
                                @foreach($studid as $users)
                                <?php 
                                $user=App\User::where('id',$users->user_id)->first();
                                ?>
                                <option @if($users->id  ==$user->id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                             </select>
                        </div>
                      </div>


        
                </div>   
                 <div class="row">
        
        
        
        
                </div>  
  <button type="submit"   class="btn btn-success">Submit</button>
                 
                               <a href="{{ url('admin/batch') }}"
                       class="btn btn-danger">Cancel</a>
                    </form>
             

                 <form method="post" action="{{ route('admin.batch.update',$data->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
        
                </div>   
                 <div class="row">
        
        
        
        
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

