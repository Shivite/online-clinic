@extends('app')
@section('title','Edit User')
@section('pagespecificstyles')
<link href="{{ asset('/css/required/daterangepicker.css') }}" rel="stylesheet">
<link href="{{ asset('/css/required/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
@include('layouts.partials.adminmenu')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Alopathy Appointment</h1>
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
                            <b>Alopathy Appointment</b>
                        </h3>
                    </div>
                    <form role="form" action="{{route('admin.reschedule.appointment')}}" method="POST">
                        @csrf
                        {{ method_field('POST') }}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="Name">Patient Name</label>
                                        <input type="hidden" name="islopathy" value="1" />
                                        <input id="name" type="text" class="form-control" name="name"
                                            value="{{ $patient->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Appoiment Date</label>
                                        <div class="input-group date" id="appointment_date" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input"
                                                data-target="#appointment_date" name="appointment_date" required />
                                            <div class="input-group-append" data-target="#appointment_date"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Doctor </label>

                                        <select id="newdoctor" data-appoint=""
                                            class="form-control @error('newdoctor') is-invalid @enderror"
                                            name="newdoctor" required>
                                            <option value="">Select Doctor</option>
                                            @foreach($doctors as $doctor)
                                            <option value="{{ $doctor['id']}}">
                                                {{ $doctor['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="time_slots"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
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
<script src="{{ asset('js/required/moment.min.js') }}"></script>
<script src="{{ asset('js/required/daterangepicker.js') }}"></script>
<script src="{{ asset('js/required/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{ asset('js/required/jquery.validate.min.js') }}" defer></script>
<script src="{{ asset('/js/required/additional-methods.min.js') }}" defer></script>
<script src="{{ asset('js/forms/custom-validation.js') }}" defer></script>

<script>
$(function() {
    $('#newdoctor').on('change', function() {
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.get.timeslot')}}",
            dataType: 'json',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'appointmentDate': $("#appointment_date").find("input").val(),
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
    //appointment date selection
    var date = new Date();
    $('#appointment_date').datetimepicker({
        format: 'L',
        minDate: new Date().setDate(date.getDate() + 1),
    });


    /*get date and show timeslots start here */

    /*get date and show timeslots fuction end here */


});
</script>

@endsection