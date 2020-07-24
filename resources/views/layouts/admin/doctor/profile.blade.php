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
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if($user->hasRole('doctor'))
                                @php $profilePic = asset('storage/doctor/profile/'.$user->doctor->profile_pic); @endphp
                                @php $sign = asset('storage/doctor/profile/'.$user->doctor->sign); @endphp
                                @else
                                @php $imgPath = asset('storage/appointment/profile/'.$user->doctor->profile_pic);
                                @endphp
                                @endif
                                <img class="profile-user-img img-fluid img-circle" src="{{ $profilePic }}"
                                    alt="doctor picture">
                            </div>
                            <h3 class="profile-username text-center">{{ ucwords($user->name) }}</h3>
                            <p class="text-muted text-center">{{ ucwords($user->doctor->specialization) }}</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>appointments</b> <a class="float-right"></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Pending Appointment</b> <a class="float-right">
                                        Profile </li>
                            </ul>
                            <a href="{{ route('doctor.edit', $user->id)}}" class="btn btn-primary btn-block"><b>Edit
                                    Details</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> About Doctor</strong>

                            <p class="text-muted">
                                {{ $user->doctor->about}}
                            </p>

                            <hr>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
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
                                <div class="tab-pane" id="today">
                                    <!-- Post -->


                                    <div class="post">
                                        <table id="data-listing" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>PATIENT ID</th>
                                                    <th>NAME</th>
                                                    <th>DATE</th>
                                                    <th>TIME</th>
                                                    <th>STATUS</th>
                                                </tr>
                                            </thead>
                                            @if(!empty($appointments['today']))
                                            @php $i = 0; @endphp
                                            @foreach($appointments['today'] as $appointment)
                                            <tbody>
                                                <tr>
                                                    <td scope="row"> {{ $i++ }} </td>
                                                    <td> {{ $appointment->patient_id }} </td>
                                                    <td> {{ ucwords($appointment->name) }} </td>
                                                    <td> {{ date('d-m-Y', strtotime($appointment->date)) }} </td>

                                                    <td> {{ $appointment->start_time }}</td>
                                                    <td
                                                        class="{{ ($appointment->status == 'pending') ? 'text-danger' : 'text.success' }}">
                                                        <b>{{ ucwords($appointment->status) }}</b></td>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            @endforeach
                                            @else
                                            No Records Found
                                            @endif
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>PATIENT ID</th>
                                                    <th>NAME</th>
                                                    <th>DATE</th>
                                                    <th>TIME</th>
                                                    <th>STATUS</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <!-- /.post -->
                                </div>
                                <div class="tab-pane" id="week">
                                    <div class="post">
                                        <table id="data-listing" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>PATIENT ID</th>
                                                    <th>NAME</th>
                                                    <th>DATE</th>
                                                    <th>TIME</th>
                                                    <th>STATUS</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(!empty($appointments['currentWeek']))
                                                @php $i = 0; @endphp
                                                @foreach($appointments['currentWeek'] as $appointment)
                                                @if($appointment->reschedule_req != true)
                                                <tr>
                                                    <td scope="row"> {{ $i++ }} </td>
                                                    <td> {{ $appointment->patient_id }} </td>
                                                    <td> {{ ucwords($appointment->name) }} </td>
                                                    <td> {{ date('d-m-Y', strtotime($appointment->date)) }} </td>

                                                    <td> {{ $appointment->start_time }}</td>
                                                    <td
                                                        class="{{ ($appointment->status == 'pending') ? 'text-danger' : 'text.success' }}">
                                                        <b>{{ ucwords($appointment->status) }}</b></td>
                                                    </td>
                                                    @php $tommarow = date("Y-m-d",strtotime("tomorrow"));
                                                    $schedule = date("Y-m-d",strtotime($appointment->date));
                                                    $allowReshcedule = (strtotime($tommarow) >
                                                    strtotime($schedule)) ? "disabled" : "" ; @endphp
                                                    <td class="">
                                                        <a href="{{ route('doctor.patient.profile', $appointment->patient_id )}}"
                                                            class="btn btn-warning"><b>
                                                                <i class="far fa-address-book"></i></b></a>

                                                        <form
                                                            action="{{ route('doctor.appointment.reschedule', $appointment->id) }}"
                                                            method="POST" class=" float-left">
                                                            @csrf
                                                            {{ method_field("PUT")}}
                                                            &nbsp
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <button type="submit" class="btn btn-info"
                                                                {{$allowReshcedule}}>
                                                                <i class="far fa-calendar-alt"></i></button></a>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                                @else
                                                No Records Found
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>PATIENT ID</th>
                                                    <th>NAME</th>
                                                    <th>DATE</th>
                                                    <th>TIME</th>
                                                    <th>STATUS</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="active tab-pane" id="month">
                                    <div class="post">
                                        <table id="data-listing" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>PATIENT ID</th>
                                                    <th>NAME</th>
                                                    <th>DATE</th>
                                                    <th>TIME</th>
                                                    <th>STATUS</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(!empty($appointments['currentMonth']))
                                                @php $i = 0; @endphp
                                                @foreach($appointments['currentMonth'] as $appointment)
                                                @if($appointment->reschedule_req != true)

                                                <tr>
                                                    <td scope="row"> {{ $i++ }} </td>
                                                    <td> {{ $appointment->patient_id }} </td>
                                                    <td> {{ ucwords($appointment->name) }} </td>
                                                    <td> {{ date('d-m-Y', strtotime($appointment->date)) }} </td>

                                                    <td> {{ $appointment->start_time }}</td>
                                                    @php $tommarow = date("Y-m-d",strtotime("tomorrow"));
                                                    $schedule = date("Y-m-d",strtotime($appointment->date));
                                                    $allowReshcedule = (strtotime($tommarow) >
                                                    strtotime($schedule)) ? "disabled" : "" ; @endphp
                                                    <td
                                                        class="{{ ($appointment->status == 'pending') ? 'text-danger' : 'text.success' }}">
                                                        <b>{{ ucwords($appointment->status) }}</b></td>
                                                    </td>
                                                    <td class="">
                                                        <form
                                                            action="{{ route('doctor.appointment.reschedule', $appointment->id) }}"
                                                            method="POST" class=" float-left">
                                                            @csrf
                                                            {{ method_field("PUT")}}

                                                            &nbsp
                                                            <button type="submit" class="btn btn-info"
                                                                {{$allowReshcedule}}>
                                                                Reschedule</button></a>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                                @else
                                                No Records Found
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>PATIENT ID</th>
                                                    <th>NAME</th>
                                                    <th>DATE</th>
                                                    <th>TIME</th>
                                                    <th>STATUS</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </tfoot>
                                        </table>
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
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" defer></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}" defer></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}" defer></script>
<script src="{{ asset('js/custom.js') }}" defer></script>
@stop