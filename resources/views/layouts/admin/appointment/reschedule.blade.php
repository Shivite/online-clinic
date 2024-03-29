@extends('app')
@section('title','Edit User')
@section('content')
@include('layouts.partials.adminmenu')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reschedule Appointment</h1>
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
                            <b>Reschedule Appointment</b>
                        </h3>
                    </div>
                    <form role="form" action="{{route('admin.reschedule.appointment')}}" method="POST">
                        @csrf
                        {{ method_field('POST') }}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Name">Patient Name</label>
                                        <input id="name" type="text" class="form-control" name="name"
                                            value="{{ $appointment->patient->name }}" readonly>
                                        <input type="hidden" name="appointment" value="{{$appointment->id}}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="doctor">Doctor Name</label>
                                        <input id="doctor" type="text" class="form-control" name="doctor"
                                            value="{{ $appointment->doctor->user->name}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">Appointemnt Date</label>
                                        <input type="text" name="date" class="form-control" id="date" placeholder="date"
                                            value=" {{ $appointment->date }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="time">Appointemnt Time</label>
                                        <input type="text" name="time" class="form-control" id="time"
                                            value="{{ $appointment->start_time}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Doctor </label>

                                        <select id="newdoctor" data-appoint="{{$appointment->id}}"
                                            class="form-control @error('newdoctor') is-invalid @enderror"
                                            name="newdoctor" required>
                                            <option value="">Select Doctor</option>
                                            @foreach($doctors as $doctor)
                                            <option {{ ($appointment->doctor_id == $doctor['id']) ? 'selected': '' }}
                                                value="{{ $doctor['id']}}">
                                                {{ $doctor['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <input class="form-control" type="text" name="department"
                                            value="{{$department->name}}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="time_slots"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-footer">

                                        <button class="btn btn-block btn-primary send_btn">
                                            UPDATE &nbsp;
                                        </button>
                                    </div>
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
<script src="{{ asset('js/required/jquery.validate.min.js') }}" defer></script>
<script src="{{ asset('/js/required/additional-methods.min.js') }}" defer></script>
<script src="{{ asset('js/forms/custom-validation.js') }}" defer></script>

<script>
$(function() {
    $('#newdoctor').on('change', function() {
        console.log($(this).attr('data-appoint'));
        console.log($(this).val());
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.get.timeslot')}}",
            dataType: 'json',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'appointment': $(this).attr('data-appoint'),
                'doctorId': $(this).val(),
            },
            success: function(data) {
                if (data.success)
                    $("#time_slots").html(data.html);
                else
                    toastr.error(data.error,
                        'error', {
                            closeButton: true,
                            progressBar: true,
                        });
            } //sucess end

        });
    });
});
</script>
@endsection