@extends('theme.marcus.layout.main')

@section('content')
<div class="container">
  <div class="row justify-content-center" style="margin-top: -100px">
    <div class="col-md-8 ml-auto mr-auto">
        <div class="card">
          <div class="shipping-outer" style="margin-bottom: 40px">
            <h3 style="margin-bottom: 40px">Login</h3>
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group row">
                <div class="col-md-12">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md-12">
                  <div class="button-box">
                    <div class="login-toggle-btn">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label style="margin-right: 50px" for="remember">{{ __('Remember Me') }}</label>
                        <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-top: 30px">LOGIN</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection