@extends('app')
@section('title','Doctor Profile')
@section('content')
    @include('layouts.partials.adminmenu')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DOCTOR PROFILE</h1>
          </div>
          <div class="col-sm-6">

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

      <div class="container-fluid">
        <div class="row">
          <div class="col-10">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-user"></i>
                  <b>Doctor Profile</b>
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="unlock_inputs" class="btn-border  btn-sm" href="">Edit Details</a>
                    </li>
                  </ul>
                </div>
              </div>
              <form role="form" enctype="multipart/form-data" id="storeUserForm" action="{{route('doctor.update', $user->id)}}" method="POST" class = "lock_inputs" >
              @csrf
              {{ method_field('PUT') }}
                <div class="card-body">
                  @include('layouts.admin.doctor.partial.form')
                  <div class="card-footer">
                    <button type="submit" class="btn btn-block btn-info send_btn lock_items">
                     SUBMIT &nbsp;
                  </button>

                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>

</div>


@endsection
@section('pagespecificscripts')
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}" defer></script>
<script src="{{ asset('/plugins/jquery-validation/additional-methods.min.js') }}" defer></script>
<script src="{{ asset('js/forms/custom-validation.js') }}" defer></script>

<script src="../.."></script>
@endsection
