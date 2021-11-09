@extends('admin.layouts.app')
 
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@section('content')
    <section class="content">
      <div class="container-fluid">
       <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create Counter</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
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
         
              <form enctype="multipart/form-data" role="form" id="myform" method="post" action="{{ route('admin.sect.store') }}">
                @csrf
               
                
                <div class="container">
                 <div class="row">
                    <div class="col-sm-12">
                       
                          <div class="form-group">
                            <label for="productname">Name<span class="required">*</span></label>
                            <input type="text" name="heading" id="title" class="form-control" value="{{old('title')}}" placeholder="Enter name" required/>
                            @if ($errors->has('heading'))
                                <span class="required" style="color:red">
                                    <strong>{{ $errors->first('heading') }}</strong>
                                </span>
                            @endif  
                          </div>
                            <div class="form-group">
                            <label for="productname">Location<span class="required">*</span></label>
                            <input type="text" name="short_desc" id="newsdate" class="form-control" value="{{old('newsdate')}}" placeholder="Enter description" />
                            @if ($errors->has('short_desc'))
                                <span class="required">
                                    <strong>{{ $errors->first('short_desc') }}</strong>
                                </span>
                            @endif  
                          </div>
                     
                           
                            <div class="form-group" id="dynamicTable">
                      <tr>  
                <td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control" /></td>  
                <td><input type="file" name="images[]" placeholder="Enter your file" class="form-control" /></td>  
                
                <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                </tr> 
                             </div>
                            <br>
                           <div class="form-group">
                            <button id="submit" type="submit" class="btn btn-primary">Create Product</button>
                          </div>
                    </div>
                 </div>
                </div>
              </form>
          </div>
        </div>
       </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  @push('after-scripts')
<script type="text/javascript">
   
    var i = 0;
       
    $("#add").click(function(){
   
        ++i;
   
        $("#dynamicTable").append('<tr><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control" /></td><td><input type="file" name="images[]" placeholder="Enter your file" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    });
   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  
   
</script>

@endpush
@endsection
