@extends('layouts.frontend.index')
@section('pagespecificstyles')
<link href="{{ asset('/css/required/daterangepicker.css') }}" rel="stylesheet">
<link href="{{ asset('/css/required/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
@include('layouts.frontend.menu')
<div class=" row  justify-content-center">
  <div class="col-md-10">
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
             window.location = data.url
         }
       }
     });
   });
});

</script>

@endsection
