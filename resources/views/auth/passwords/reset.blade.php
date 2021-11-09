@extends('layouts.auth')

@section('content')

                   <div class="card-body">
            <h5 class="card-title text-center">Welcome Back!</h5>
            
              <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
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
             

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                       <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Reset Password</button>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
