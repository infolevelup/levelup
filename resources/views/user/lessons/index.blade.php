@extends('user.layouts.app')
 @push('before-styles')
  <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/select2/dist/css/select2.min.css">


@endpush
@section('content')
 <section class="content-header">
      <h1>
        Course Details        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
  <section class="content">
      <div class="row">
 <div class="col-xs-12">
          <div class="box">
                  
<div class="box-body">
    <div class="box-header">
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div class="col-md-6">
              <div class="form-group">
                <label>Select course</label>
                <select class="form-control select2" style="width: 100%;" name="record">
                  <option selected="selected">select the course</option>
                  <?php $course=App\Course::where('published','1')->where('teacher_id',Auth::user()->id)->get();?>
                 @foreach($course as $course)
                 <option value="{{$course->id}}">{{$course->title}}</option>
                 @endforeach
                </select>
              </div>
              </div>
            </div>
       </div>
       </div>
       </div>
       </div>
       </section>
      @push('after-scripts')
   
<!-- DataTables -->
<script src="{{url('/')}}/public/teacher/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script>
    $("[name='record']").on("change", function (e) {
    let edit_id = $(this).val();
    window.location.href = '{{url('/')}}/user/lessons_details/' + edit_id ;
});
</script>
   @endpush
   
@endsection
