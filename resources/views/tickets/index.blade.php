@extends('admin.layouts.app')

 @push('before-styles')
  <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="{{url('/')}}/public/teacher/dist/css/custom.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
            <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css')}}">


@endpush

@section('content')

 <section class="content-header">
      <h1>
        Tickets List       
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tickets</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
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
               <div class="ml-auto ">
                   
                 
<div>
    <div class="col-lg-12">
    
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Activity Feed</h3>
            </div>
            <div class="panel-content panel-activity">
                <form action="#" class="panel-activity__status">
                    <textarea name="user_activity" placeholder="Share what you've been up to..." class="form-control"></textarea>
                    <div class="actions">
                        <div class="btn-group">
                            <button type="button" class="btn-link" title="" data-toggle="tooltip" data-original-title="Post an Image">
                                <i class="fa fa-image"></i>
                            </button>
                            <button type="button" class="btn-link" title="" data-toggle="tooltip" data-original-title="Post an Video">
                                <i class="fa fa-video-camera"></i>
                            </button>
                            <button type="button" class="btn-link" title="" data-toggle="tooltip" data-original-title="Post an Idea">
                                <i class="fa fa-lightbulb-o"></i>
                            </button>
                            <button type="button" class="btn-link" title="" data-toggle="tooltip" data-original-title="Post an Question">
                                <i class="fa fa-question-circle-o"></i>
                            </button>
                        </div>
                        <button type="submit" class="btn btn-sm btn-rounded btn-info">
                            Post
                        </button>
                    </div>
                </form>
                <ul class="panel-activity__list">
                    <li>
                        <i class="activity__list__icon fa fa-question-circle-o"></i>
                        <div class="activity__list__header">
                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="" />
                            <a href="#">John Doe</a> Posted the question: <a href="#">How can I change my annual reports for the better effect?</a>
                        </div>
                        <div class="activity__list__body entry-content">
                            <p>
                                <strong>Lorem ipsum dolor sit amet</strong>, consectetur adipisicing elit. Voluptatibus ab a nostrum repudiandae dolorem ut quaerat veniam asperiores, rerum voluptatem magni dolores corporis!
                                <em>Molestiae commodi nesciunt a, repudiandae repellendus ea.</em>
                            </p>
                        </div>
                        <div class="activity__list__footer">
                            <a href="#"> <i class="fa fa-thumbs-up"></i>123</a>
                            <a href="#"> <i class="fa fa-comments"></i>23</a>
                            <span> <i class="fa fa-clock"></i>2 hours ago</span>
                        </div>
                    </li>
                    <li>
                        <i class="activity__list__icon fa fa-question-circle-o"></i>
                        <div class="activity__list__header">
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" />
                            <a href="#">John Doe</a> Posted the question: <a href="#">How can I change my annual reports for the better effect?</a>
                        </div>
                        <div class="activity__list__body entry-content">
                            <blockquote>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus ab a nostrum repudiandae dolorem ut quaerat veniam asperiores, rerum voluptatem magni dolores corporis! Molestiae commodi nesciunt a,
                                    repudiandae repellendus ea.
                                </p>
                            </blockquote>
                        </div>
                        <div class="activity__list__footer">
                            <a href="#"> <i class="fa fa-thumbs-up"></i>123</a>
                            <a href="#"> <i class="fa fa-comments"></i>23</a>
                            <span> <i class="fa fa-clock"></i>2 hours ago</span>
                        </div>
                    </li>
                    <li>
                        <i class="activity__list__icon fa fa-image"></i>
                        <div class="activity__list__header">
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" />
                            <a href="#">John Doe</a> Uploaded 4 Image: <a href="#">Office Working Time</a>
                        </div>
                        <div class="activity__list__body entry-content">
                            <ul class="gallery">
                                <li>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" />
                                </li>
                                <li>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="" />
                                </li>
                                <li>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="" />
                                </li>
                                <li>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar4.png" alt="" />
                                </li>
                            </ul>
                        </div>
                        <div class="activity__list__footer">
                            <a href="#"> <i class="fa fa-thumbs-up"></i>123</a>
                            <a href="#"> <i class="fa fa-comments"></i>23</a>
                            <span> <i class="fa fa-clock"></i>2 hours ago</span>
                        </div>
                    </li>
                    <li>
                        <i class="activity__list__icon fa fa-question-circle-o"></i>
                        <div class="activity__list__header">
                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="" />
                            <a href="#">John Doe</a> Posted the question: <a href="#">How can I change my annual reports for the better effect?</a>
                        </div>
                        <div class="activity__list__body entry-content">
                            <blockquote>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus ab a nostrum repudiandae dolorem ut quaerat veniam asperiores, rerum voluptatem magni dolores corporis! Molestiae commodi nesciunt a,
                                    repudiandae repellendus ea.
                                </p>
                            </blockquote>
                        </div>
                        <div class="activity__list__footer">
                            <a href="#"> <i class="fa fa-thumbs-up"></i>123</a>
                            <a href="#"> <i class="fa fa-comments"></i>23</a>
                            <span> <i class="fa fa-clock"></i>2 hours ago</span>
                        </div>
                    </li>
                    <li>
                        <i class="activity__list__icon fa fa-lightbulb-o"></i>
                        <div class="activity__list__header">
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" />
                            <a href="#">John Doe</a> bookmarked a page: <a href="#">Awesome Idea</a>
                        </div>
                        <div class="activity__list__footer">
                            <a href="#"> <i class="fa fa-thumbs-up"></i>123</a>
                            <a href="#"> <i class="fa fa-comments"></i>23</a>
                            <span> <i class="fa fa-clock"></i>2 hours ago</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
                
                   
                   
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
   
<!-- DataTables -->
<script src="{{url('/')}}/public/teacher/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/public/teacher/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
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
        $(document).ready(function () {
            $(document).on('change', '#sortBy', function () {
                if ($(this).val() != "") {
                    location.href = '{{url()->current()}}?type=' + $(this).val();
                } else {
                    location.href = '{{url('/')}}/admin/batch';
                }
            })

            @if(request('type') != "")
            $('#sortBy').find('option[value="' + "{{request('type')}}" + '"]').attr('selected', true);
            @endif
        });

    </script>
@endpush
   
@endsection

