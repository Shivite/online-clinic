@extends('app')
@section('title','Create User')
@section('content')
@include('layouts.partials.adminmenu')
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>CREATE USER</h1>
            </div>
            <div class="col-sm-6">
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <div class="container-fluid">
      <div class="row">
         <div class="col-10">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">
                     <i class="fas fa-user"></i>
                     <b>Create User</b>
                  </h3>
               </div>
               <form role="form" id="storeUserForm" action="{{route('admin.users.store')}}" method="POST" >
                  @csrf
                  <div class="alert alert-success d-none" id="msg_div">
                     <span id="res_message"></span>
                  </div>
                  <div class="card-body">
                     @include('layouts.admin.user.partial.form')
                  </div>
                  <div class="card-footer">
                     <button class="btn btn-block btn-info send_btn">
                     CREATE &nbsp; </i>
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
