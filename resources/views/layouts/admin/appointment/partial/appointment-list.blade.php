<div class="post">
    <table id="data-listing" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>PATIENT ID</th>
                <th>PATIENT NAME</th>
                <th>DOCTOR NAME</th>
                <th>DATE-TIME</th>
                <th>STATUS</th>
            </tr>
        </thead>
        @if(!empty($appointments))
        @php $i = 0; @endphp
        @foreach($appointments as $appointment)
        <tbody>
            <tr>
                <td scope="row"> {{ $i++ }} </td>
                <td> {{ $appointment->patient_id }} </td>
                <td> {{ ucwords($appointment->patient->name) }} </td>
                <td> {{ ucwords($appointment->doctor->user->name) }} </td>
                <td> {{ date('d-m-Y', strtotime($appointment->date)) }} - {{ $appointment->start_time }} </td>
                @if($appointment->reschedule_req)
                <td class="{{ ($appointment->status == 'pending') ? 'text-danger' : 'text.success' }}">
                    <a href="{{ route('admin.reappointment', $appointment)}}" class="text-info">Reschedule</a></td>
                </td>
                @else
                <td class="{{ ($appointment->status == 'pending') ? 'text-danger' : 'text.success' }}">
                    <b>{{ ucwords($appointment->status) }}</b></td>
                </td>
                @endif
            </tr>
        </tbody>
        @endforeach
        @else
        No Records Found
        @endif
        <tfoot>
            <tr>
                <th>#</th>
                <th>PATIENT ID</th>
                <th>NAME</th>
                <th>DATE</th>
                <th>TIME</th>
                <th>STATUS</th>
            </tr>
        </tfoot>
    </table>
</div>