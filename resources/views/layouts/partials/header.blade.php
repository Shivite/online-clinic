<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />  <meta name="csrf-token" content="{{ csrf_token() }}">
<!-- <title>{{ config('app.name', 'Online Clinic | P R Medication') }}</title> -->
<title>@yield('title'){{ config('app.name', ' : | P R Medication') }}</title>
<script src="{{ asset('js/app.js') }}" ></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link href="{{ asset('css/required/icheck-bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/required/admin.min.css') }}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<link href="{{ asset('css/required/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/required/responsive.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">

@yield('pagespecificstyles')
