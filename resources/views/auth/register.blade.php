@extends('layouts.auth')

@section('content')
  <div class="card-body">
            <div class="text-center mb-3"><img src="{{url('/')}}/public/assets/images/logo.png" class="img-fluid"></div>
            <h5 class="card-title text-center">Register</h5>
            
                 <form method="POST" action="{{ route('register') }}" class="form-signin">
                        @csrf
              <div class="form-label-group">
                <input type="text" id="inputUserame"name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Username" required autofocus>
                               
                <label for="inputUserame">Username</label>
                  @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>

              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email address" required>
              
                <label for="inputEmail">Email address</label>
                   @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>
              
              <hr>

              <div class="form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                <label for="inputPassword">Password</label>
                  @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>
              
              <div class="form-label-group">
                <input type="password" id="inputConfirmPassword"  name="password_confirmation" class="form-control" placeholder="Password" required>
                <label for="inputConfirmPassword">Confirm password</label>
              </div>

              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Register</button>
              <a class="d-block text-center mt-2 small" href="{{url('/')}}/login">Sign In</a>
              <hr class="my-4">
              <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign up with Google</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign up with Facebook</button>
            </form>
          </div>
		  
		
@endsection
