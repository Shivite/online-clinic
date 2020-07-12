@extends('layouts.frontend.index')
@section('pagespecificstyles')
<link href="{{ asset('/css/required/daterangepicker.css') }}" rel="stylesheet">
<link href="{{ asset('/css/required/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
@include('layouts.frontend.menu')
<div class=" row  justify-content-center">
    <div class="col-md-10 newHtml">
        <div class="card card-primary card-outline special-card">
            <div class="card-body box-profile">
                <h3 class="text-center">Select Appointment Date</h3>
                <br /><br />
                <div id="appointment_date"></div>
                <div id="time_slots"></div>

            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>&nbsp;&nbsp;</label>
                        <a href="{{route('patient.reports')}}" class="btn btn-block btn-info">
                            <i class="fas fa-arrow-left "></i>&nbsp; PREVIOUS
                        </a>
                        </button>
                    </div>
                </div>

                <div class="col-sm-3">
                </div>
                <div class="col-sm-3">
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>&nbsp;&nbsp;</label>
                        <button class="btn btn-block btn-info submit-appointment">
                            NEXT &nbsp; <i class="fas fa-arrow-right "></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>

@endsection

@section('pagespecificscripts')
<script src="{{ asset('js/required/moment.min.js') }}"></script>
<script src="{{ asset('js/required/daterangepicker.js') }}"></script>
<script src="{{ asset('js/required/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<!-- <script src="{{ asset('js/required/payment.js')}}"></script> -->

<script>
$(function() {

    var appointment = null;
    var date = new Date();
    date.setDate(date.getDate());
    console.log(date);
    // $('#appointment_date').val('0000-00-00');
    $('#appointment_date').datetimepicker({
        inline: true,
        useCurrent: false,
        minDate: new Date().setDate(date.getDate() + 1),
    });


    /*get date and show timeslots start here */
    $('#appointment_date').on("change.datetimepicker", function(e) {
        window.appointment = moment(e.date).format('YYYY-MM-DD');
        $.ajax({
            type: 'POST',
            url: "{{ route('register.appointment.timeslots')}}",
            dataType: 'json',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'appointment': window.appointment,
            },
            success: function(data) {
                console.log(data);
                $("#time_slots").html(data.html);
            } //sucess end
        }); //ajax end
    });
    /*get date and show timeslots fuction end here */












    $('.submit-appointment').click(function(e) {
        e.preventDefault();
        $(this).append(
            '<span class=" spiner spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
        );
        $.ajax({
            type: 'POST',
            url: '/registration/patient/appointment/test',
            dataType: 'json',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'appointment': window.appointment,
            },

            success: function(data) {
                if (data.success) {
                    console.log(data.values);
                    var options = {
                        "key": data.values
                            .razorpayId, // Enter the Key ID generated from the Dashboard
                        "amount": data.values
                            .amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        "currency": data.values.currency,
                        "name": data.values.name,
                        "description": data.values.discription,
                        "image": "{{asset('images/logo.png')}}",
                        "order_id": data.values
                            .orderId, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                        "handler": function(response) {
                            console.log(response);
                            console.log(JSON.stringify(response));
                            alert(response.razorpay_payment_id);
                            $.ajax({
                                type: 'POST',
                                url: '/registration/payment/Complete',
                                dataType: 'json',
                                data: {
                                    '_token': '<?php echo csrf_token() ?>',
                                    'rzp_paymentid': response
                                        .razorpay_payment_id,
                                    'rzp_orderid': response
                                        .razorpay_order_id,
                                    'rzp_signature': response
                                        .razorpay_signature,
                                    "amount": data.values.amount,
                                    "description": data.values.discription,
                                    "order_id": data.values.orderId,
                                    "contactNumber": data.values
                                        .contactNumber,
                                    "email": data.values.email,
                                },
                                success: function(data) {
                                    $('.spiner').addClass('d-none');
                                    console.log("data.url");

                                    window.location = data.url;
                                },
                                error: function(data) {
                                    console.log(data);
                                    console.log('completio eror');
                                },
                            }); //child hander request
                        }, //handler
                        "prefill": {
                            "name": data.values.name,
                            "email": data.values.email,
                            "contact": data.values.contactNumber,
                        },
                        "notes": {
                            "address": "address",
                        },
                        "theme": {
                            "color": "#60C5FB"
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                    e.preventDefault();
                }
            }, // parent request success end
            error: function(data) {
                console.log(data);
                $('.spiner').addClass('d-none');
            },
        }); //patrent ajax end
    });
});
</script>

@endsection