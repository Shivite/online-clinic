@extends('app')
@section('title','Users')
@section('content')
@include('layouts.frontend.menu')
<div class=" row  justify-content-center">
<div class="col-md-4">
      <div class="card card-primary card-outline  special-card">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="" src="{{asset('images/logo.png')}}" alt="PR MEdication">
          </div>
          <h3 class="text-center">P R Medication</h3>
          <p class="text-muted text-center">India's First Online Cancer Clinic</p>
          <a href="{{ route('registerpatient')}}" class="btn btn-block btn-info btn-xs">{{ __('New Patient') }}</a>
          <a href="{{ route('login') }}" class="btn btn-block btn-info btn-xs">EXISTING PATIENT</a>
          <p class="text-muted"> </p>
          <hr>
          <strong><i class="fas fa-pencil-alt mr-1"></i> Specialities</strong>
          <p class="text-muted">
            <span class="tag tag-danger">Covid</span>
            <span class="tag tag-success">Onocology</span>
            <span class="tag tag-info">Gastro</span>
            <span class="tag tag-warning">Pulmonology</span>
            <span class="tag tag-primary">Orthopedic</span>
          </p>
        </div>
      </div>
  </div>
      <!-- /.card -->
    </div>
</div>
@endsection
