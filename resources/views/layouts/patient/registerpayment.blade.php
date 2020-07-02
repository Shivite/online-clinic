<button id="rzp-button1">Pay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
  "key": "{{ $reposne->razorpayId}}", // Enter the Key ID generated from the Dashboard
  "amount": "{{ $reposne->amount }}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
  "currency": "{{ $reposne->currency }}",
  "name": "{{ $reposne->name }}",
  "description": "{{ $reposne->discription }}",
  "image": "https://example.com/your_logo",
  "order_id": "{{ $reposne->orderId }}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
  "handler": function (response){
      alert(response.razorpay_payment_id);
      alert(response.razorpay_order_id);
      alert(response.razorpay_signature)
  },
  "prefill": {
      "name": "{{ $reposne->name }}",
      "email": "{{ $reposne->email }}",
      "contact": "{{ $reposne->number }}",
  },
  "notes": {
      "address": "{{ $reposne->address }}",
  },
  "theme": {
      "color": "#F37254"
  }
};
var rzp1 = new Razorpay(options);
window.onload = function (){
  document.getElementById('rzp-button1').click();
}
document.getElementById('rzp-button1').onclick = function(e){
  rzp1.open();
  e.preventDefault();
}
</script>
