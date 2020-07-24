@extends('app')
@section('title','Users')
@section('content')
@include('layouts.frontend.menu')
<div class=" row  justify-content-center">
    <div class="col-md-4">
        <div class="card card-primary card-outline  special-card">
            <div class="card-body box-profile text-center">
                <div class="text-center">
                    <img class="" src="{{asset('images/logo.png')}}" alt="PR MEdication">
                </div>
                <h3 class="text-center">P R Medication</h3>
                <p class="text-muted text-center">ONLINE CLINIC</p>
                <a href="{{ route('registerpatient')}}"
                    class="btn btn-block btn-info btn-lg"><b>{{ __('NEW PATIENT') }}</b></a>
                <a href="{{ route('login') }}" class="btn btn-block btn-info btn-lg"><b>EXISTING PATIENT</b></a>
                <p class="text-muted"> </p>
                <hr>
                <!-- <strong><i class="fa fa-h-square"></i> &nbsp; <b> WELCOME TO ONLINE CLINIC</b></strong> -->

            </div>
        </div>
    </div>
    <!-- /.card -->
</div>
</div>
@endsection