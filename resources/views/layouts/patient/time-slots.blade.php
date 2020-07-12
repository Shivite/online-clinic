<table class="table table-bordered text-center">
    <tbody>
        <h3 class="text-center">Select Appointment Dates</h3>

        </div>
        @foreach($availableTimeSlots as $timeslot)
        <div class="col-xs-1 float-left" style="background: aliceblue;     margin: 1px !important;">
            <button type="button" class="btn btn-block btn-flat pick_time" data-time="{{ $timeslot }}">
                {{ $timeslot }}</button>

        </div>
        @endforeach
        </div>

</table>
<script>
$(function() {
    /*get date and show timeslots start here */

    $('.pick_time').click(function(e) {
        // e.preventDefault();
        $('.submit-appointment').append(
            '<span class=" spiner spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
        );
        $.ajax({
            type: 'POST',
            url: "{{route('post.register.appointment')}}",
            dataType: 'json',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'appointmentDate': window.appointment,
                'appointmentTime': $(this).attr('data-time'),
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
                            console.log(JSON.stringify(
                                response));
                            // alert(response.razorpay_payment_id);
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
                                    "amount": data
                                        .values.amount,
                                    "description": data
                                        .values
                                        .discription,
                                    "order_id": data
                                        .values.orderId,
                                    "contactNumber": data
                                        .values
                                        .contactNumber,
                                    "email": data.values
                                        .email,
                                },
                                success: function(
                                    data) {
                                    $('.spiner')
                                        .addClass(
                                            'd-none'
                                        );
                                    console.log(
                                        "data.url"
                                    );

                                    window
                                        .location =
                                        data.url;
                                },
                                error: function(data) {
                                    console.log(
                                        data);
                                    console.log(
                                        'completio eror'
                                    );
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
/*get date and show timeslots fuction start here */