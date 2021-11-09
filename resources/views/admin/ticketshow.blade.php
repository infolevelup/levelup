@extends('admin.layouts.app')

 @push('before-styles')
  <link rel="stylesheet" href="{{url('/')}}/public/teacher/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="{{url('/')}}/public/teacher/dist/css/custom.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    

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
                         <a href="{{ url('admin/tickets') }}" class="btn btn-success ">Back</a>

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
     @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
        <div class="panel">
            <div class="panel-heading">
                                       <h4>#{{ $ticket->ticket_id }} - {{ $ticket->title }}</h4> 

            </div>
            <div class="panel-content panel-activity">
               
                  <div class="table-responsive margin-bottom-2x">
                <table class="table margin-bottom-none">
                    <thead>
                        <tr>
                           <th>Category</th>
                            <th>Title</th>
                            <th>Message</th>

                            <th>Status</th>
                            <th>Priority</th>
                            <th>created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td> #{{ $ticket->ticket_id }} - {{ $ticket->title }}</td>
                            <td>  {!!$ticket->message !!}</td>

                            <td> @if ($ticket->status === 'Open')
                            <span class="badge badge-success">{{ $ticket->status }}</span>
                        @else
                          <span class="badge badge-danger">{{ $ticket->status }}</span>
                        @endif</td>
                            <td><span class="text-warning">{{$ticket->priority}}</span></td>
                            <td>{{ $ticket->created_at->diffForHumans() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
                        <div class="panel-heading">
                            <h3>Leave Your Message</h3>
                        </div>
                     <form action="{{ url('comment') }}" method="POST" class="panel-activity__status" enctype="multipart/form-data">
                            {!! csrf_field() !!}

                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                            <div class="form-group">
                                     <input  type="file" class="form-control" name="image">

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                                </div>
                    <textarea  name="comment" placeholder="Share what you've been up to..." class="form-control"></textarea>
                      @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                    @endif
                                     
                    <div class="actions">
                        <div class="btn-group">
                            <button type="submit" class="btn-link" title="" data-toggle="tooltip" data-original-title="Post an Image">
                                <i class="fa fa-image"></i>
                            </button>
                          
                        </div>
                        <button type="submit" class="btn btn-sm btn-rounded btn-info">
                            Post
                        </button>
                    </div>
                </form>
                <ul class="panel-activity__list">
                   @foreach ($comments as $comment)
                    <li>
                        <i class="activity__list__icon fa fa-question-circle-o"></i>
                        <div class="activity__list__header">
                            @if($comment->user->image)
                                    <img src="{{url('/')}}/public/uploads/images/{{$comment->user->image}}" alt="Avatar">
                                    @else
                                   
                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="" />
                                    @endif
                            <a href="#">Admin</a> Posted the question: <a href="#">#{{ $ticket->ticket_id }} - {{ $ticket->title }}</a>
                        </div>
                        <div class="activity__list__body entry-content">
                            <blockquote>
                                <p>
                                    {{ $comment->comment }}
                                </p>
                                <ul class="gallery">
                                <li>
                                      @if($comment->image)
                                       <a href="{{url('/')}}/public/uploads/images/{{$comment->image}}" target=”_blank”>
                                          <img src="{{url('/')}}/public/uploads/images/{{$comment->image}}" alt="" />
                                           </a>
                                        
                                        @endif
                                   
                                </li>
                                </ul>
                            </blockquote>
                            
                        </div>
                        <div class="activity__list__footer">
                           
                            <span> <i class="fa fa-clock"></i>{{ $comment->created_at->format('Y-m-d') }}</span>
                        </div>
                    </li>
                    
                    
                    @endforeach
                    
                    
                    
                   
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

