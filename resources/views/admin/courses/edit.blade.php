@extends('admin.layouts.app')
 @push('before-styles')
   <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/select2/dist/css/select2.min.css">

@endpush
@push('after-styles')
    <!-- switchery css -->
    <link rel="stylesheet" type="text/css" href="src/plugins/switchery/switchery.min.css">
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
             
        
              <form method="post" action="{{ route('admin.courses.update',$coursedetails->id) }}"enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                 <input type="hidden" id="id" name="id" value="{{$coursedetails->id}}"> 
                        
            <div class="row">
              <div class="col-md-9 col-sm-12">
                <div class="form-group">
                  <label>Teacher</label>
                  <select class="form-control select2 col-md-9" name="teacher_id">
                    @foreach($teachers as $row)

                                    <option value="{{$row->id}}" @if(@$course_user->user_id == $row->id) selected @endif>{{$row->name}}</option>
                                   
                                 @endforeach
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
                    @foreach($categoryy as $row)
                                    <option value="{{$row->id}}" @if(@$coursedetails->category_id == $row->id) selected @endif>{{$row->name}}</option>
                                   
                                 @endforeach
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
                  <label>Title*</label>
                  <input type="text" name="title"class="form-control" placeholder="Title" required value="{{$coursedetails->title}}">
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <label>Slug</label>
                  <input type="text" name="slug"class="form-control" placeholder="Slug or it will be generated automatically" value="{{$coursedetails->slug}}" >
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <label>Color* [section-color-1,section-color-2,section-color-3,section-color-4]</label>
                  <input type="text" name="color"class="form-control" placeholder="please add class" value="{{$coursedetails->color}}">
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <input type="radio" name="typee" @if($coursedetails->type=='self peaced')checked @endif value="self peaced" >
                   <label>Self Peaced class</label>
                  <br>
                  <input type="radio" name="typee"  @if($coursedetails->type=='live class')checked @endif value="live class">
                  <label>Live class</label>

                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label>Description</label>
                 <div class="html-editor pd-20 card-box mb-30">
         
          <textarea class="textarea_editor form-control border-radius-0" placeholder="Enter text ..." name="description" id="editor1">{{$coursedetails->description}}</textarea>
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
                  <input type="text" class="form-control" placeholder="Price" name="price" value="{{$coursedetails->price}}" required>
                </div>
              </div>
              <div class="col-md-3 col-sm-12">
                <div class="form-group">
                  <label>strike price</label>
                  <input type="text" name="strike_price" placeholder="Strike Price" class="form-control" value="{{$coursedetails->strike_price}}">
                </div>
              </div>
              <div class="col-md-3 col-sm-12">
                <div class="form-group">
                  <label>Course Image</label>
                  <input type="file" name="course_image" class="form-control">
                </div>
                     @if($coursedetails->course_image)
                      <img src="{{ URL::to('/') }}/public/uploads/course_images/{{ $coursedetails->course_image }}" alt="" class="img-responsive" width="40%" />
                    @endif
                        
              </div>
              <div class="col-md-3 col-sm-12">
                <div class="form-group">
                  <label>Video</label>
                               
                   <select class="form-control" name="type">
            <option>select one</option>
            <option value="red" <?php if($media->type=='youtube'){ echo 'selected'; }?>>Youtube</option>
            <option value="green" <?php if($media->type=='embed'){ echo 'selected'; }?>>Embed</option>
          
        </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
          <div class="red box1"><input type="text" name="url1" placeholder="enter youtube link"class="form-control" value="{{$media->url}}"></div>
    <div class="green box1"><input type="text" name="url2" placeholder="enter embed code"class="form-control" value="{{$media->url}}"></div>
    <div class="blue box1"><input type="file" name="url3"class="form-control" ></div>
    <div >
        @if($media->url)
        @if($media->type=='youtube')
              <?php
$link = $media->url;
$video_id = str_replace('http://www.youtube.com/watch?v=', '', $link);
//echo $video_id;
?>


<?php 
$url= $media->url;

parse_str( parse_url( $url, PHP_URL_QUERY ), $youtube_id_v ); 
//echo $youtube_id_v['v'] . "\n"; 

?> 
     <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $youtube_id_v['v'];?>" 
     frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
@endif
@else
 <iframe width="560" height="315" src="{{$media->url}}" 
     frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
@endif
    </div>
                 </div>
                 </div>
                 </div>  
                <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="custom-control custom-checkbox "> 
                                <div class="custom-control custom-checkbox"> 
                <div class="checkbox d-inline mr-3">

                 <input type="checkbox" class="custom-control-input" value="1"id="customCheck1" name="featured" <?php if($coursedetails->featured==1){echo 'checked';}?>>
                    <label class="custom-control-label" for="customCheck1">Featured</label>
                    </div>
                                    <div class="checkbox d-inline mr-3">

                      <input type="checkbox" class="custom-control-input" value="1"id="customCheck2"name="published"<?php if($coursedetails->published==1){echo 'checked';}?>>
                    <label class="custom-control-label" for="customCheck2">Active</label></div>
                                    <div class="checkbox d-inline mr-3">

                    <input type="checkbox" class="custom-control-input" value="1"id="customCheck3" name="trending" <?php if($coursedetails->trending==1){echo 'checked';}?>>
                 
                      <label class="custom-control-label" for="customCheck3">Trending</label></div>
                                      <div class="checkbox d-inline mr-3">

                 <input type="checkbox" class="custom-control-input" value="1" id="customCheck4" name="popular" <?php if($coursedetails->popular==1){echo 'checked';}?>>
                 
                        <label class="custom-control-label" for="customCheck4">Popular</label></div>
                                        <div class="checkbox d-inline mr-3">

                 
                 <input type="checkbox" class="custom-control-input" value="1" id="customCheck5" name="free" <?php if($coursedetails->free==1){echo 'checked';}?>>
                          <label class="custom-control-label" for="customCheck5">Free</label></div></div>
                                    <div class="checkbox d-inline mr-3">

                 
                 <input type="checkbox" class="custom-control-input" value="1" id="customCheck6" name="corporate" <?php if($coursedetails->corporate==1){echo 'checked';}?>>
                          <label class="custom-control-label" for="customCheck6">Corporate</label></div></div>
</div>
</div></div>
  <div class="col-md-3 col-sm-12">
                <div class="form-group">
                  <label>Course certificate</label>
                  <input type="file" name="certificate" class="form-control">
                </div>
              </div>
                  <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label>Metatitle</label>
                  <input type="text" class="form-control" placeholder="meta titlet" name="meta_title" value="{{$coursedetails->meta_title}}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label>Meta keywords</label>
                  <textarea name="meta_keywords" placeholder="meta keywords" class="form-control">{{$coursedetails->meta_keywords}}</textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label>Meta Description</label>
                  <textarea name="meta_description" placeholder="meta description" class="form-control">{{$coursedetails->meta_description}}</textarea>
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

