@extends('admin.layouts.auth')


@section('content')
<div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="{{('/vendors/images/login-page-img.png')}}" alt="">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Login To DeskApp</h2>
                        </div>
                        <form method="POST" action="{{ url('/admin/login') }}"  class="md-float-material">
                        @csrf
                           @if(Session::has('flash_error'))
                                  <div class="alert alert-danger">
                                      <button type="button" class="close" data-dismiss="alert">×</button>
                                  {{ Session::get('flash_error') }}
                                  </div>
                            @endif
                            <div class="input-group custom">
                                <input type="email"   id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                             @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="password" id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                   
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="row pb-30">
                               
                                <div class="col-6">
                                    <div class="forgot-password"><a href="forgot-password.html">Forgot Password</a></div>
                                </div>
                            </div>
                           <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        {{ __('Login') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


@endsection
