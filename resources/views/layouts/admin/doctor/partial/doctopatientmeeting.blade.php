<div class="col-md-12">
    <div class="card card-info" style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
        <div class="card-header">
            <h3 class="card-title">Meeting Available On Time</h3>
            <div class="card-tools">


                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                </button>

            </div>
            <!-- /.card-tools -->
        </div>

        @if(!$appointments->isEmpty())
        @foreach($appointments as $appointment)
        @php
        $start = \Carbon\Carbon::createFromTimeString($appointment->start_time);
        $end = \Carbon\Carbon::createFromTimeString($appointment->start_time)->addMinutes('30');
        $now = \Carbon\Carbon::now();
        $room = 'DOCTOR_'.$appointment->doctor_id.'_PATIENT_'.$appointment->patient_id;
        @endphp
        @if($now->between($start, $end))
        <div class="card-body" style="min-height:305px">
            <div id="otEmbedContainer" style="width:100%; height:260px;"></div>
            <script
                src="https://tokbox.com/embed/embed/ot-embed.js?embedId=2ac73469-77f1-42c0-b68d-a496a6cfd988&room={{$room}}">
            </script>
            <form action="{{ route('doctor.appointment.complete', $appointment->id) }}" method="POST">
                @csrf
                {{ method_field("PUT")}}
                &nbsp
                <button type="submit" class="btn btn-info btn-block">Complete Appointment</button>
            </form>
        </div>
        @else
        <div class="card-body" style="background-image:url('{{asset('images/wait.jpg')}}');
                            background-repeat:no-repeat;background-size: contain; align=center; min-height:373px">
        </div>
        <br>
        @endif
        @endforeach
        @else

        <div class="card-body" style="background-image:url('{{asset('images/wait.jpg')}}');
                              background-repeat:no-repeat;background-size: contain; align=center; min-height:373px">
            @if(isset($allAppointments) && !$allAppointments->isEmpty())

            <div class="color-palette-set col-md-3 col-sm-4 text-center">
                @foreach($allAppointments as $appointment)

                <div class="bg-lightblue color-palette"><span class="bg-black disabled color-palette"> Date:
                    </span><span>{{ $appointment->date}}</span>
                </div>
                @endforeach
            </div>

            @endif
        </div>
        <br>
        @endif


        <!-- /.card-body -->
    </div>
</div>