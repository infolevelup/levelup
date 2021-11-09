@extends('layouts.auth')

@section('content')

          <div class="card-body">
              <div class="text-center mb-3"><img src="{{url('/')}}/public/assets/images/logo.png" class="img-fluid"></div>
            <h5 class="card-title text-center">Welcome Back!</h5>
          
             <form method="POST" action="{{ route('login.custom') }}" class="form-signin">
                        @csrf
                        
                           @if(Session::has('flash_error'))
                                  <div class="alert alert-danger">
                                      <button type="button" class="close" data-dismiss="alert">×</button>
                                  {{ Session::get('flash_error') }}
                                  </div>
                            @endif
                         

			  <div class="form-label-group">
                  <input type="email" id="inputEmail"name="email"  class="form-control @error('email') is-invalid @enderror" placeholder="Email address" 
                  required   >
                  
                             @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                  <label for="inputEmail">Email address</label>
                </div>
				<div class="form-label-group">
                  <input type="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password"  required>
                                 
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                  <label for="inputPassword">Password</label>
                </div>
              <div class="custom-control custom-checkbox mb-3">
                  <input type="checkbox" class="custom-control-input" id="customCheck1">
                  <label class="custom-control-label" for="customCheck1">Remember password</label>
                </div>
              <hr>

              

              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
              <a class="d-block text-center mt-2 small" href="{{ route('password.request') }}">Forgot password?</a>
			  <hr class="my-4">
			  <p class="login-card-footer-text">Don't have an account? <a href="{{ route('register') }}" class="text-reset">Register here</a></p>
              
             <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i>Login with Google</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Login with Facebook</button>
           </form>
          </div>




@endsection
