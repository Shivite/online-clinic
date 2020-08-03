<div class="post">
    <table id="{{$list}}" class="table table-bordered table-striped appointment-listing">
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
        @if(!empty($appointments))
        @php $i = $success = $pending = $total= 0; @endphp
        @foreach($appointments as $appointment)
        @if($appointment->reschedule_req != true)
        @php ($appointment->status == 'success') ? $success++ : $pending++; $total++; @endphp

        <tbody>
            <tr>
                <td scope="row"> {{ $i++ }} </td>
                <td> PR00{{ $appointment->patient_id }} </td>
                <td> {{ ucwords($appointment->name) }} </td>
                <td> {{ date('d-m-Y', strtotime($appointment->date)) }} </td>
                <td> {{ $appointment->start_time }}</td>
                <td class="{{ ($appointment->status == 'pending') ? 'text-danger' : 'text-success' }}">
                    <b>{{ ucwords($appointment->status) }}</b></td>
                </td>
                <!-- /* added from week code */ -->
                @php $tommarow = date("Y-m-d",strtotime("tomorrow"));
                $schedule = date("Y-m-d",strtotime($appointment->date));
                $allowReshcedule = (strtotime($tommarow) >
                strtotime($schedule)) ? "disabled" : "" ; @endphp
                <td class="">
                    <a href="{{ route('doctor.patient.profile', $appointment->patient_id )}}"
                        class="btn btn-warning"><b>
                            <i class="far fa-address-book"></i></b></a>

                    <form action="{{ route('doctor.appointment.reschedule', $appointment->id) }}" method="POST"
                        class=" float-left">
                        @csrf
                        {{ method_field("PUT")}}
                        &nbsp
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn-info" {{$allowReshcedule}}>
                            <i class="far fa-calendar-alt"></i></button></a>
                    </form>
                </td>
            </tr>
        </tbody>
        @endif
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
                <th>ACTION</th>

            </tr>
        </tfoot>
    </table>
    <!-- appointment count -->
    <div class="container-fluid">
        <h5 class="mb-2">Today Appointments Status</h5>
        <div class="row">
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-address-book"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total</span>
                        <span class="info-box-number">{{$total}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-address-book"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Success</span>
                        <span class="info-box-number">{{$success}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="far fa-address-book"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pending</span>
                        <span class="info-box-number">{{$pending}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

        </div>
    </div>
    <!-- appointment count end -->
</div>