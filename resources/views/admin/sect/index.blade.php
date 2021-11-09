@extends('admin.layouts.app')
@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <div class="row">
        <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">News And events</h3>
                <a href="{{route('admin.studentplaced.create')}}" class="btn btn-primary float-right">Create</a>
              </div>
              @if(Session::has('flash_success'))
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                  {{ Session::get('flash_success') }}
                  </div>
              @endif
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th>Image</th>
                      <th>Name</th>
                     
                    
                      <th>Description</th>
                     
                   <th colspan='2'>Action</th>
                    </tr> 
                  </thead>
                  <tbody>
                    @foreach($data as $row)
                   
                    <tr>
                      <td>
                        <img src="{{ url('/') }}/public/uploads/images/{{ @$row->images }}" style="width: 100%;" />
                      </td>
                      <td>{{@$row->name}}</td>
                      <td>{{@$row->countt}}</td>
                    
                  
                     
                      <td>
                        <a href="{{ route('admin.studentplaced.edit', $row->id) }}"   class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i class="icon-copy fa fa-eye" aria-hidden="true"></i></a>

                     </td><td>
                        <button form="resource-delete-{{ $row->id }}" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i class="icon-copy fa fa-trash" aria-hidden="true" color='red'></i></button>
                    
                        <form id="resource-delete-{{ $row->id }}" action="{{ route('admin.studentplaced.destroy', $row->id) }}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                          @csrf
                          @method('DELETE')
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <br>
                {!! $data->links() !!}
              </div>
              <!-- /.card-body -->
              
        </div>
        <!-- /.card -->
        </div>
       </div>
      </div><!-- /.container-fluid -->
    </section>
@endsection
