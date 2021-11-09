@extends('admin.layouts.app')
@section('content')
    <section class="content">
      <div class="container-fluid">
       <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Counter</h3>
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
           
              <form method="post" action="{{ route('admin.studentplaced.update',$data->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
             
               <input type="hidden" id="id" value="{{$data->id}}"> 
                <div class="container">
                 <div class="row">
                    <div class="col-sm-12">
                      
                          <div class="form-group">
                            <label for="productname">Title <span class="required">*</span></label>
                            <input type="text" name="heading" id="title" class="form-control" value="{{$data->heading}}" placeholder="Enter title" />
                            @if ($errors->has('heading'))
                                <span class="required">
                                    <strong>{{ $errors->first('heading') }}</strong>
                                </span>
                            @endif  
                          </div>
                             <div class="form-group">
                            <label for="productname">Description<span class="required">*</span></label>
                            <input type="text" name="short_desc" id="title" class="form-control" value="{{$data->short_desc}}"  />
                            @if ($errors->has('short_desc'))
                                <span class="required">
                                    <strong>{{ $errors->first('short_desc') }}</strong>
                                </span>
                            @endif  
                          </div>
                          
                      
                          <div class="form-group">
                            <img src="{{ URL::to('/') }}/public/uploads/images/{{ @$data->images }}" style="width: 10%;" /><br>
                              <label for="images">Choose Image <span class="required">*</span></label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" name="images" class="custom-file-input" id="images">
                                    @if ($errors->has('images'))
                                      <span class="required">
                                          <strong>{{ $errors->first('images') }}</strong>
                                      </span>
                                    @endif  
                                    <label class="custom-file-label" for="images">Choose image file</label>
                                  </div>
                                </div>
                            </div>
                      
                          <div class="form-group">
                              <?php 
                              $mimg=App\Studentplaced_images::where('studentplaced_id',$data->id)->get();
                              ?>
                            @foreach($mimg as $mimg)
                            
                            <img src="{{ URL::to('/') }}/public/uploads/images/{{ $mimg->imagess }}" style="width: 10%;" />
                             <button
                              id="delete-multiple-image{{ $mimg->id }}" form="resource-delete-{{ $mimg->id }}" class="btn" 
                              data-bgcolor="#3b5998" data-color="#ffffff"><i class="icon-copy fa fa-trash" aria-hidden="true" color='red'></i>
                              </button>  
                         
                            
                            <form action="{{url('admin/delete-multiple-image')}}?id={{$mimg->id}}" id="resource-delete-{{ $mimg->id }}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                            @csrf
                            </form>
                           
                            @endforeach
                            <br>
                              <label for="images">Choose Multiple Image <span class="required">*</span></label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" name="imagess[]" class="custom-file-input" id="images" multiple>
                                    @if ($errors->has('imagess'))
                                      <span class="required">
                                          <strong>{{ $errors->first('imagess') }}</strong>
                                      </span>
                                    @endif  
                                    <label class="custom-file-label" for="images">Choose image file</label>
                                  </div>
                                </div>
                            </div>
                        
                            
                           <div class="form-group">
                            <button id="submit" type="submit" class="btn btn-primary">Update Product</button>
                          </div>
                    </div>
                 </div>
                </div>
              </form>
       
        </div>
       </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
