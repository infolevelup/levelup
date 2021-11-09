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
                   
                  
<div class="">
<div class="">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			<div class="table-responsive">
				<table class="table user-list">
					<thead>
						<tr>
							<th><span>User</span></th>
							<th>Ticket Id</th>
							<th><span>Updated at</span></th>
							<th class="text-center"><span>Status</span></th>
							<th><span>Email</span></th>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
					    
					   @if ($tickets->isEmpty())
					   <tr>
					       <td colspna="4">There are currently no tickets.</td>
					       </tr>
                     
                    @else 
                     @foreach ($tickets as $ticket)
						<tr>
							<td>
							    @if($ticket->user->image)
							    	<img src="{{url('/')}}/public/uploads/images/{{$ticket->user->image}}" alt="">
							    @else
								<img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
								@endif
								<a href="{{ url('admin/tickets/'. $ticket->ticket_id) }}" class="user-link">{{$ticket->user->name}}</a>
								<?php 
								$user=App\User::where('id',$ticket->user->id)->first();
								?>
								@if($user->role_id==1)
								<span class="user-subhead">Admin</span>
								@elseif($user->role_id==2)
									<span class="user-subhead">Instructor</span>
								@else
									<span class="user-subhead">Student</span>
								@endif
							</td>
							<td>
							    <a href="{{ url('admin/tickets/'. $ticket->ticket_id) }}">
                                            #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                                        </a>
							</td>
							<td>
								{{ $ticket->updated_at }}
							</td>
							<td class="text-center">
								 @if ($ticket->status === 'Open')
                                        <span class="label label-success">{{ $ticket->status }}</span>
                                    @else
                                        <span class="label label-danger">{{ $ticket->status }}</span>
                                    @endif
							</td>
							<td>
								<a href="{{ url('admin/tickets/'. $ticket->ticket_id) }}">{{$ticket->user->email}}</a>
							</td>
							<td>
								<a href="{{ url('admin/tickets/'. $ticket->ticket_id) }}" class="table-link">
									<span class="fa-stack">
									    
									<i class="fa fa-reply" aria-hidden="true"></i>
									</span>
								</a>
							
							</td>
							<td>
								  <form action="{{ url('close_ticket/' . $ticket->ticket_id) }}" method="POST">
                                            {!! csrf_field() !!}
                                            <button type="submit" class="btn btn-danger">Close</button>
                                        </form>
							</td>
						</tr>
					
					 @endforeach
                         

                      
                    @endif
					
					</tbody>
				</table>
			</div>
			<ul class="pagination pull-right">
			
			  {{ $tickets->render() }}
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

