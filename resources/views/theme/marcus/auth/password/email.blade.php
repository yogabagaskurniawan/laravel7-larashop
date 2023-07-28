@extends('theme.marcus.layout.main')

@section('content')
<div class="container">
  <div class="row justify-content-center" style="margin-top: -100px">
    <div class="col-md-8 ml-auto mr-auto">
      <div class="card">
        <div class="shipping-outer" style="margin-bottom: 40px">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <form method="POST" action="{{ route('password.email') }}">
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
            <div class="form-group row mb-0">
              <div class="col-md-12">
                <div class="button-box">
                  <button type="submit" class="btn btn-primary">{{ __('Send Password Reset Link') }}</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection