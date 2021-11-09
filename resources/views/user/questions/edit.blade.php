@extends('user.layouts.app')
 @push('before-styles')
   <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/select2/dist/css/select2.min.css">

@endpush

@section('content')
   
 <section class="content-header">
      <h1>
       Questions      
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
              <a href="{{url('user/questions')}}" class="btn btn-success ">View questions</a>
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
           
              <form method="post" action="{{ route('user.questions.update',$data->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
             
               <input type="hidden" id="id" value="{{$data->id}}"> 
                <div class="container">
                 <div class="row">
                    <div class="col-sm-12">
                      
               
                             
        
         <div class="row">
                <div class="col-12 form-group">
                    <label for="question" class="control-label">Question*</label>
                    <textarea class="form-control " placeholder="" required="" name="question" cols="50" rows="10" id="question">{{$data->question}}</textarea>
                    <p class="help-block"></p>
                                    </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                     <img src="{{ URL::to('/') }}/public/uploads/images/{{ @$data->question_image }}" style="width: 10%;" /><br>
                    <label for="question_image" class="control-label">Question Image</label>
                    <input class="form-control" style="margin-top: 4px;" name="question_image" type="file" id="question_image">
                    <input name="question_image_max_size" type="hidden" value="8">
                    <input name="question_image_max_width" type="hidden" value="4000">
                    <input name="question_image_max_height" type="hidden" value="4000">
                    <p class="help-block"></p>
                                    </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    <label for="score" class="control-label">Score*</label>
                    <input class="form-control" placeholder="" required="" name="score" type="number" value="{{$data->score}}" id="score">
                    <p class="help-block"></p>
                                    </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    <label for="tests" class="control-label">Tests</label>
                   
                                             <select class="form-control select2 col-12"  name="tests" >
                                        <optgroup >
                            <option>Please select</option>
                            @foreach($test as $row)
                                    <option value="{{$row->id}}"<?php if($row->id==$data->id){echo 'selected';}?>>{{$row->title}}</option>
                                   
                                 @endforeach
                               </optgroup>
                                </select>
            </div>

        </div>
    </div>
</div>
        <?php   
        $new = \App\Question_option::where('question_id',$data->id)->get(); 
                        $count=count($new);
                        $i=1;
                          ?>
                    @foreach($new as $new)       
        <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                    <label for="option_text_{{$i}}" class="control-label">Option Text*</label>
                    <textarea class="form-control " rows="3" name="option_text_{{$i}}" cols="50" id="option_text_{{$i}}">{{$new->option_text}}</textarea>
                    <p class="help-block"></p>
                                    </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    <label for="explanation_{{$i}}" class="control-label">Option Explanation</label>
                    <textarea class="form-control " rows="3" name="explanation_{{$i}}" cols="50" id="explanation_{{$i}}">{{$new->explanation}}</textarea>
                    <p class="help-block"></p>
                                    </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    <label for="correct_{{$i}}" class="control-label">Correct</label>
                    <input name="correct_{{$i}}" type="hidden" value="0" id="correct_{{$i}}">
                    <input name="correct_{{$i}}" type="checkbox" id="correct_{{$i}}" <?php if($new->correct==1){echo 'checked';}?> value="1">
                    <p class="help-block"></p>
                                    </div>
            </div>
        </div>
    </div>
            <?php $i++; ?>
       @endforeach
                            
                     
  <button type="submit"   class="btn btn-success">Submit</button>
                 
                               <a href="{{ url('user/questions') }}"
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

