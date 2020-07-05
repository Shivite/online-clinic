
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
     '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> '
   );
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
       if(data.success)
      {
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
                       }
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
     } // parent request success end
   }); //patrent ajax end
 });
