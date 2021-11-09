@extends('layouts.auth')

@section('content')
     <div class="card-body">
         <div class="text-center mb-3"><img src="{{url('/')}}/public/assets/images/logo.png" class="img-fluid"></div>
            <h5 class="card-title text-center">Forgotten Password</h5>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="form-signin">
                        @csrf

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
  <hr>

              

              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
            
			  <hr class="my-4">
			  <p class="login-card-footer-text">Don't have an account? <a href="{{ route('register') }}" class="text-reset">Register here</a></p>
              
           
                    </form>
              </div>

@endsection
