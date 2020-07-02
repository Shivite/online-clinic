@extends('layouts.frontend.index')
@section('pagespecificstyles')
<link href="{{ asset('/css/required/daterangepicker.css') }}" rel="stylesheet">
<link href="{{ asset('/css/required/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
@include('layouts.frontend.menu')
<div class=" row  justify-content-center">
  <div class="col-md-10 newHtml">
      <div class="card card-primary card-outline special-card" >
          <div class="card-body box-profile">
            <h3 class="text-center">Appointment Date & Time</h3>
            <br/><br/>
            <div clas = "row">
              <div class="col-md-8 offset-2">
              <div id="appointment_date"></div>
            </div>
            </div>
                <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>&nbsp;&nbsp;</label>
                      <a class="btn btn-block btn-primary">
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
                                  <button class="btn btn-block btn-primary submit-appointment">
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
<script src="{{ asset('js/required/daterangepicker.js') }}" ></script>
<script src="{{ asset('js/required/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<!-- <script src="{{ asset('js/required/payment.js')}}"></script> -->

<script>
  $(function () {
    var appointment = null;
    var date = new Date();
date.setDate(date.getDate());
console.log(date);
    $('#appointment_date').datetimepicker({
               inline: true,
               sideBySide: true,
               daysOfWeekDisabled: [0, 6],
               minDate: new Date().setDate(date.getDate()+1),
           });
     $('#appointment_date').on("change.datetimepicker", function (e) {
       window.appointment = moment(e.date).format('YYYY-MM-DD HH:mm:ss');
   });

   $('.submit-appointment').click(function(e){
     e.preventDefault();
     $(this).append(
       '<span class=" spiner spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> '
     );
     // $('.spiner').addClass('d-none')
     $.ajax({
        type:'POST',
        url:'/registration/patient/appointment',
        dataType:'json',
        data:{
            '_token' : '<?php echo csrf_token() ?>',
            'appointment' : window.appointment,
        },

       success: function(data)
       {
         console.log(data);
         if(data.success)
         {
            $('.spiner').addClass('d-none');
                 console.log(data.values);
                  var options = {
                   "key": data.values.razorpayId, // Enter the Key ID generated from the Dashboard
                   "amount": data.values.amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                   "currency": data.values.currency,
                   "name": data.values.name,
                   "description": data.values.discription,
                   "image": "{{asset('images/logo.png')}}",
                   "order_id": data.values.orderId, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                   "handler": function (response){
                     alert(response.razorpay_payment_id);
                       $.ajax({
                          type:'POST',
                          url:'/registration/payment/Complete',
                          dataType:'json',
                          data:{
                              '_token' : '<?php echo csrf_token() ?>',
                              'rzp_paymentid': response.razorpay_payment_id,
                              'rzp_orderid': response.razorpay_order_id,
                              'rzp_signature': response.razorpay_signature,
                          },
                         success: function(data)
                         {
                            window.location = data.url;
                         },
                         error: function(data)
                         {
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
       error: function(data)
       {
         console.log(data);
          $('.spiner').addClass('d-none');
       },
     }); //patrent ajax end
   });
});

</script>

@endsection
