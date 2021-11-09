@extends('admin.layouts.app')
@section('content')
<!-- Main-body start -->

                    
   <!-- Page-header end -->
   <!-- Page body start -->
 
 
  <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="align-left"></i></span></span>Form Layout</h4>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <h5 class="hk-sec-title">Create Contacts</h5>
                            <p class="mb-25"></p>
                            <div class="row">
                                <div class="col-sm">
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
                  <form enctype="multipart/form-data" role="form" id="myform" method="post" action="{{ route('admin.contacts.store') }}">
                  @csrf
                                      
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="firstName">Email</label>
                                                <input class="form-control" id="firstName" placeholder="email" value="" type="email" name="email" required>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="lastName">Phone number</label>
                                                <input class="form-control" id="lastName" placeholder="number" value="" type="number" name="phone" required>
                                            </div>
                                        </div>
                                     <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="firstName">Address</label>
                                               <textarea name="address"></textarea>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="lastName">Map</label>
                                                <input class="form-control" id="lastName" placeholder="link" value="" type="text" name="map_link">
                                            </div>
                                        </div>
                                            <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="firstName">facebook</label>
                                                <input class="form-control" id="firstName" placeholder="facebook" value="" type="url" name="facebook" required>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="lastName">Instagram</label>
                                                <input class="form-control" id="lastName" placeholder="instagram" value="" type="url" name="instagram">
                                            </div>
                                        </div>
                                   <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="firstName">Twitter</label>
                                                <input class="form-control" id="firstName" placeholder="twitter" value="" type="url" name="twitter" required>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="lastName">Instagram</label>
                                                <input class="form-control" id="lastName" placeholder="linkedin" value="" type="url" name="linkedin">
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="firstName">pintrest</label>
                                                <input class="form-control" id="firstName" placeholder="pintrest" value="" type="url" name="pintrest" required>
                                            </div>
                                            </div>
                                        <hr>
                                        <button class="btn btn-gradient-success" type="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </section>
                </div>
                
            </div>
            
            </div>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
@endsection