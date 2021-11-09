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
        Course List       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}/user/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Course</li>
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
              <a href="{{url('admin/courses')}}" class="btn btn-success ">View Course</a>
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
             
        
                   <form method="post" action="{{ route('admin.courses.store') }}"enctype="multipart/form-data">
                    @csrf
                    
                        
        
            <div class="row">
              <div class="col-md-9 col-sm-12">
                <div class="form-group">
                  <label>Teacher</label>
                  <select class="form-control select2 col-md-9" name="teacher_id">
                      <option>Select Teacher</option>
                                        <optgroup >

                    @foreach($teachers as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                   
                                 @endforeach
                               </optgroup>
                                </select>

                </div>
              </div>
             
              <div class="col-md-3 col-sm-12">
                <div class="form-group">
                  <label>Or</label><br>
                  <a href="{{url('admin/teachers')}}" target="_blank" class="btn btn-primary btn-sm scroll-click">Add Teachers</a>
                </div>
              </div>
            
            </div>
            <div class="row">
              <div class="col-md-9 col-sm-12">
                <div class="form-group">
                  <label>Category</label>
                  <select class="form-control select2 col-md-9" name="category_id">
                      <option>Select Category</option>
                    <optgroup >
@foreach($category as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                   
                                 @endforeach
</optgroup>
                                </select>

                </div>
              </div>
             
              <div class="col-md-3 col-sm-12">
                <div class="form-group">
                  <label>Or</label><br>
                  <a href="{{url('admin/categories')}}" target="_blank" class="btn btn-primary btn-sm scroll-click">Add category</a>
                </div>
              </div>
            
            </div>

            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <label>Course Name*</label>
                  <input type="text" name="title"class="form-control" placeholder="Title" required>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <label>Slug</label>
                  <input type="text" name="slug"class="form-control" placeholder="Slug or it will be generated automatically" >
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <label>Color* [section-color-1,section-color-2,section-color-3,section-color-4]</label>
                  <input type="text" name="color"class="form-control" placeholder="please add class" required>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <input type="radio" name="typee" checked  value="self peaced" >
                   <label>Self Peaced class</label>
                  <br>
                  <input type="radio" name="typee"  value="live class">
                  <label>Live class</label>

                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label>Description</label>
                 <div class="html-editor pd-20 card-box mb-30">
         
          <textarea class="textarea_editor form-control border-radius-0" id="editor1" placeholder="Enter text ..." name="description"></textarea>
        </div>
                </div>
              </div>
</div>
    <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label>Course Benefits</label>
                 <div class="html-editor pd-20 card-box mb-30">
         
          <textarea class="textarea_editor form-control border-radius-0" id="editor2" placeholder="Enter text ..." name="benefits"></textarea>
        </div>
                </div>
              </div>
</div>
    <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label>Course Schedules</label>
                 <div class="html-editor pd-20 card-box mb-30">
         
          <textarea class="textarea_editor form-control border-radius-0" id="editor3" placeholder="Enter text ..." name="schedule"></textarea>
        </div>
                </div>
              </div>
</div>
        <div class="row">
              <div class="col-md-3 col-sm-12">
                <div class="form-group">
                  <label>Price<span>*</span></label>
                  <input type="text" class="form-control" placeholder="Price" name="price" required>
                </div>
              </div>
              <div class="col-md-3 col-sm-12">
                <div class="form-group">
                  <label>strike price</label>
                  <input type="text" name="strike_price" placeholder="Strike Price" class="form-control">
                </div>
              </div>
              <div class="col-md-3 col-sm-12">
                <div class="form-group">
                  <label>Course Image</label>
                  <input type="file" name="course_image" class="form-control">
                </div>
              </div>
              <div class="col-md-3 col-sm-12">
                <div class="form-group">
                  <label>Video</label>
                   <select class="form-control" name="type">
            <option>select one</option>
            <option value="red">Youtube</option>
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
                <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="custom-control custom-checkbox"> 
                
                <div class="checkbox d-inline mr-3">
                 <input type="checkbox" class="custom-control-input" value="1" id="customCheck1" name="featured">
                    <label class="custom-control-label" for="customCheck1">Featured</label></div>
                    
                    <div class="checkbox d-inline mr-3">
                    <input type="checkbox" class="custom-control-input" value="1" id="customCheck2"name="published">
                    <label class="custom-control-label" for="customCheck2">Active</label></div>
                    
                    <div class="checkbox d-inline mr-3">
                    <input type="checkbox" class="custom-control-input" value="1" id="customCheck3" name="trending">
                    <label class="custom-control-label" for="customCheck3">Trending</label></div>
                    
                    <div class="checkbox d-inline mr-3">  
                      <input type="checkbox" class="custom-control-input" value="1" id="customCheck4" name="popular">
                      <label class="custom-control-label" for="customCheck4">Popular</label> </div>
                      
                    <div class="checkbox d-inline mr-3">    
                    <input type="checkbox" class="custom-control-input" value="1" id="customCheck5" name="free">
                 <label class="custom-control-label" for="customCheck5">Free</label> </div>
                 
                  <div class="checkbox d-inline mr-3">
                    <input type="checkbox" class="custom-control-input" value="1" id="customCheck6"name="corporate">
                    <label class="custom-control-label" for="customCheck6">Corporate</label></div>
                    
</div>
</div></div>


  <!-- <div class="row" >
              <div class="col-md-12 col-sm-12 dynamicRadio">
                <div class="form-group">
                  <label>Future of Levelup</label>
              <input name = "future[]" type="text" min="0" class="form-control" Placeholder="Enter future" />
                </div>
                 <input id="btnCakePrice" class="btn-primary" type="button" value="Add More" />
              </div>
              
              <div id="ProductContainer"></div>
            </div>-->

<div class="row">
     <div class="col-md-12 col-sm-12">
    <div class="form-group">
                  <label>Certificate Image</label>
                  <input type="file" name="certificate" class="form-control">
                </div>
                </div>
</div>
                  <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label>Metatitle</label>
                  <input type="text" class="form-control" placeholder="meta titlet" name="meta_title">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label>Meta keywords</label>
                  <textarea name="meta_keywords" placeholder="meta keywords" class="form-control"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label>Meta Description</label>
                  <textarea name="meta_description" placeholder="meta description" class="form-control"></textarea>
                </div>
              </div>
            </div>
  <button type="submit"   class="btn btn-success">Submit</button>
                 
                               <a href="{{ url('admin/courses') }}"
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


<script type="text/javascript">

  $("#btnCakePrice").bind("click", function () {
      //alert('aa');
      var div = $("<div />");
      div.html(GetDynamicProductPriceWeight(""));
      $("#ProductContainer").append(div);
  });
  $("body").on("click", ".removeRadio", function () {
      $(this).closest(".dynamicRadio").remove();
  });
  function GetDynamicProductPriceWeight(value) {
      return '<div class="dynamicRadio"><div class="row"><div class="col-md-12"> <br> <input name="future[]" type="text" min="0" class="form-control" placeholder="Enter future" /></div><div class="col-md-2"> <br> <input type="button" value="Remove" class="removeRadio btn btn-danger" /></div></div></div>'
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

