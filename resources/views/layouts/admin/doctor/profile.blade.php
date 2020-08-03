@extends('app')
@section('title','Doctor Profile')
@section('content')
@include('layouts.partials.doctormenu')
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
                    @include('layouts.admin.doctor.partial.doctorprofile')
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#today" data-toggle="tab">Today
                                        Appointments</a></li>
                                <li class="nav-item"><a class="nav-link" href="#week" data-toggle="tab">Current Week
                                        Appointments</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#month" data-toggle="tab">Current
                                        Month Appointments</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="today">
                                    @include('layouts.admin.doctor.partial.appointmentlist',
                                    ['appointments'=>$appointments['today'], 'list'=>'todayList' ])
                                </div>
                                <div class="tab-pane" id="week">
                                    <div class="post">
                                        @include('layouts.admin.doctor.partial.appointmentlist',
                                        ['appointments'=>$appointments['currentWeek'], 'list'=>'weekList' ])
                                    </div>
                                </div>
                                <div class="tab-pane" id="month">
                                    <div class="post">
                                        @include('layouts.admin.doctor.partial.appointmentlist',
                                        ['appointments'=>$appointments['currentMonth'], 'list'=>'monthList' ])
                                    </div>
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
<script src="{{ asset('js/required/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/required/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/required/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/required/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
@stop