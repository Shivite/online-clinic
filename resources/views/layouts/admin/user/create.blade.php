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
      </div><!-- /.container-fluid -->
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
                  <div class = "row">
                      <div class = "col-md-6">
                        <div class="form-group">
                          <label for="Name">Name</label>
                          <input id="name" type="text" class="form-control" name="name">
                        </div>
                      </div>
                      <div class = "col-md-6">
                        <div class="form-group">
                          <label for="email">email</label>
                          <input id="email" type="email" class="form-control" name="email" value="" placeholder="Enter email" >
                        </div>
                    </div>
                  </div>

                  <div class = "row">
                    <div class = "col-md-6">
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                      </div>
                    </div>
                    <div class = "col-md-6">
                      <div class="form-group">
                        <label for="password_confirmation">Retype Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Retype Password">
                      </div>
                    </div>
                  </div>
                  <div class = "row">
                    <div class = "col-md-6">
                      <div class="form-group">
                      <label>Role</label>
                      <select id="role" class="form-control @error('name') is-invalid @enderror" name = "role" required >
                        @foreach($roles as $role)
                          <option value="{{ $role->id }}">{{ ucwords($role->name) }}</option>
                        @endforeach
                      </select>
                    </div>
                    </div>

                    <div class = "col-md-6">
                      <div class="form-group">
                      <label>Department</label>
                      <select id="department" class="form-control" name = "department" required >
                        @foreach($departments as $department)
                          <option value="{{ $department->id }}">{{ ucwords($department->name) }}</option>
                        @endforeach
                      </select>
                      </div>
                    </div>
                  </div>
                    <div class = "row">
                    <div class = "col-md-6">
                    </div>
                    <div class = "col-md-6">
                      <div class="form-group">
                      <label>&nbsp;&nbsp;</label>
                        <button class="btn btn-block btn-primary send_btn">
                         CREATE &nbsp; </i>
                      </button>
                    </div>
                    </div>
                  </div>
                <div class="card-footer">

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
