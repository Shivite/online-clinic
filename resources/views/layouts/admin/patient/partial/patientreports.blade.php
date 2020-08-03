@php $i = 1; @endphp
@foreach($patient->reports as $report)
<a href="{{ asset('storage/patient/'.$patient->email.'/'.$report->report) }}" data-toggle="lightbox"
    data-title="{{$patient->name}} Reports" data-gallery="gallery">
    <p><b>Patient Report-{{ $i++ }}</b></p>
</a>
@endforeach