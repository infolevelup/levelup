@extends('admin.layouts.app')
@section('content')




 <div class="container">

                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="database"></i></span></span>Contacts</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <h5 class="hk-sec-title"> <a href="{{route('admin.contacts.create')}}" class="btn btn-gradient-success float-left">Add Contacts</a>
                            
              </h5>
                       <p class="mb-40"></p>
                             @if(Session::has('flash_success'))
               <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  {{ Session::get('flash_success') }}
               </div>
               @endif
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap">
                                        <table id="datable_3" class="table table-hover w-100 display pb-30">
                                       <thead>
                                                    <tr>
                                                       <th>Email</th>
                                                       <th>Phone</th>
                                                       <th>Address</th>
                                                       <th>Action</th>
                                                    </tr>
                                                 </thead>
                                                 <tbody>
                                                    @foreach($data as $row)
                                                    <tr>
                                                      
                                                       <td>{{@$row->email}}</td>
                                                        <td>{{@$row->phone}}</td>
                                                       <th>{{@$row->address}}</th>
                                                       <td>
                                                          <a href="{{ route('admin.contacts.edit', $row->id) }}" class="btn btn-icon btn-icon-circle btn-secondary btn-icon-style-2">
                                                        <span class="btn-icon-wrap"><i class="fa fa-pencil"></i></span></a>
                                                          <button form="resource-delete-{{ $row->id }}"class="btn btn-icon btn-icon-circle btn-danger btn-icon-style-2"> 
                                                  <i class="icon-trash"></i></span></button>
                                                          <form id="resource-delete-{{ $row->id }}" action="{{ route('admin.contacts.destroy', $row->id) }}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                                                             @csrf
                                                             @method('DELETE')
                                                          </form>
                                                       </td>
                                                    </tr>
                                                    @endforeach
                                                 </tbody>
                                    
                                            
                                            
                                          </table>
                                    </div>
                                    
                                            {{ $data->links() }}
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>





@push('after-scripts')
<!-- Data Table JavaScript -->
    <script src="{{url('/')}}/public/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{url('/')}}/public/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{url('/')}}/public/vendors/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <script src="{{url('/')}}/public/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{url('/')}}/public/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{url('/')}}/public/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{url('/')}}/public/vendors/jszip/dist/jszip.min.js"></script>
    <script src="{{url('/')}}/public/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{url('/')}}/public/vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="{{url('/')}}/public/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{url('/')}}/public/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{url('/')}}/public/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{url('/')}}/public/dist/js/dataTables-data.js"></script>

@endpush
@endsection