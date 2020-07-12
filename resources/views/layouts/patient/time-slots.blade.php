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
        e.preventDefault();

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
                console.log(data);
            } //sucess end
        }); //ajax end
    });
});
/*get date and show timeslots fuction start here */