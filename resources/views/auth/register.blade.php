@extends('layouts.frontend.index')

@section('content')
@include('layouts.frontend.menu')
<div class="row justify-content-center">
<div class="login-box">

    <div class="card special-card">

      <div class="card-header">

          <div class="text-center">
            <img class="" src="{{asset('images/logo.png')}}" alt="PR MEdication">
          </div>


      </div>
<h4 class="text-center" ><b>Register</b>Form</h4>
    <div class="card-body">
      <form method="POST" action="{{ route('register') }}">
          @csrf
          <form action="../../index.html" method="post">
            <div class="input-group mb-3">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

              @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror

            </div>
            <div class="input-group mb-3">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror

            </div>
            <div class="input-group mb-3">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror

            </div>
            <div class="input-group mb-3">

              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-info btn-block">Register</button>
              </div>
              <!-- /.col -->
            </div>
          </form>


          <a href="{{ route('login') }}" class="text-center">Already Members </a>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
</div>
@endsection
