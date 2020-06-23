<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.header')
    </head>
    <body  class="{{ Request::path() == 'login' || Request::path() == 'register' || Request::path() == '/' ? 'background-image' : '' }}" >
      <div class="wrapper">
        <!-- @include('layouts.partials.alert') -->
        @yield('content')
        @include('layouts.partials.scripts')
      </div>
    </body>
</html>
