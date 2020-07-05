@extends('app')
@section('title','Patient Details')
@section('content')
    @include('layouts.partials.patientmenu')
    <div class="content-wrapper">
      <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                    @php $imgPath = asset('storage/patient/profile/'.$patient->photo); @endphp
                  <img class="profile-user-img img-fluid img-circle" src="{{ $imgPath}}" alt="doctor picture">
                </div>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right"> <br> {{Auth::user()->email}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Department</b> <a class="float-right">{{ ucwords(Auth::user()->departments[0]->name) }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Doctor</b> <a class="float-right"><br> {{ $patient->number }}</a>
                  </li>
                </ul>
                <a href="" class="btn btn-primary btn-block" disabled><b>Appointment</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            </div>
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Today Appointments</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Pending Appointments</a></li>

                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">

                    </div>
                    <!-- /.post -->

                    <!-- Post -->
                    <div class="post clearfix">
                    </div>
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">

                  </div>

                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    </div>

</div>

@endsection
@section('pagespecificscripts')
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}" defer></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" defer></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}" defer></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}" defer></script>
  <script src="{{ asset('js/custom.js') }}" defer></script>
@stop
