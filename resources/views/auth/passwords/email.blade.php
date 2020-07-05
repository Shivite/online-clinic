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
         <h4 class="text-center" ><b>Reset</b>Password</h4>
         <div class="card-body login-card-body">
           @if (session('status'))
               <div class="alert alert-success" role="alert">
                   {{ session('status') }}
               </div>
           @endif

           <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
            <form method="POST" action="{{ route('password.email') }}">
               @csrf
               <div class="input-group mb-3">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                     </div>
                  </div>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
               </div>

               <div class="row">
                    <div class="col-12">
                     <button type="submit" class="btn btn-info btn-block">{{ __('Verify Email') }}</button>
                  </div>
                  <!-- /.col -->
               </div>
            </form>
            <p class="mb-1">
               @if (Route::has('password.request'))
               <a class="btn btn-link" href="{{ route('login') }}">
               {{ __('Login Page') }}
               </a>
               @endif
            </p>
            <p class="mb-0">
               <a class="btn btn-link" href="{{ route('registerpatient') }}">
               {{ __('Register Page') }}
               </a>
            </p>
         </div>
         <!-- /.login-card-body -->
      </div>
   </div>
</div>
@endsection
