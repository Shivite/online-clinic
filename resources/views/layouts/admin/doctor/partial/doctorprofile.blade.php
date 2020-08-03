<div class="card card-primary card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
            @if($user->hasRole('doctor'))
            @php $profilePic = asset('storage/doctor/profile/'.$user->doctor->profile_pic); @endphp
            @php $sign = asset('storage/doctor/profile/'.$user->doctor->sign); @endphp
            @else
            @php $imgPath = asset('storage/appointment/profile/'.$user->doctor->profile_pic);
            @endphp
            @endif
            <img class="profile-user-img img-fluid img-circle" src="{{ $profilePic }}" alt="doctor picture">
        </div>
        <h3 class="profile-username text-center">{{ ucwords($user->name) }}</h3>
        <p class="text-muted text-center">{{ ucwords($user->doctor->specialization) }}</p>
        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <b>appointments</b> <a class="float-right"></a>
            </li>
            <li class="list-group-item">
                <b>Pending Appointment</b> <a class="float-right">
                    Profile </li>
        </ul>
        <a href="{{ route('doctor.edit', $user->id)}}" class="btn btn-primary btn-block"><b>Edit
                Details</b></a>
    </div>
    <!-- /.card-body -->
</div>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">About Me</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <strong><i class="fas fa-book mr-1"></i> About Doctor</strong>

        <p class="text-muted">
            {{ $user->doctor->about}}
        </p>

        <hr>


    </div>
    <!-- /.card-body -->
</div>