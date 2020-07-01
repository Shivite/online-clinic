<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.header')

    </head>
    <body  class="{{  Request::path() == 'registration/patient/reports'  || Request::path() == 'registerpatient'  || Request::path() == 'registration/create-step2'  || Request::path() == 'login' || Request::path() == 'register' || Request::path() == '/' ? 'background-image' : '' }}" >
      <div class="wrapper">
        <!-- @include('layouts.partials.alert') -->
        @yield('content')
        @include('layouts.partials.scripts')
        {!! Toastr::message() !!}
        <script>
            @if($errors->any())
                @foreach($errors->all() as $error)
                      toastr.error('{{ $error }}','Error',{
                          closeButton:true,
                          progressBar:true,
                       });
                @endforeach
            @endif
        </script>
      </div>
    </body>
</html>
