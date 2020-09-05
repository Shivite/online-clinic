@extends('app')
@section('title','Doctor Profile')
@section('content')
@include('layouts.partials.doctormenu')
<link rel="stylesheet" href="{{asset('css/required/ekko-lightbox.css') }}">

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>PATIENT PROFILE</h1>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="info-box">
                    <div class="card card-widget widget-user-2" style="width:100%">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-info">
                            <div class="widget-user-image">
                                @php $profilePic = asset('storage/patient/profile/'. $patient->photo);
                                @endphp
                                <img class="img-circle elevation-2" src="{{ $profilePic }}" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">{{ ucwords($patient->name) }}</h3>
                            <h5 class="widget-user-desc">Patient Id : PR00{{ucwords($patient->id)}}</h5>
                        </div>
                        <div class="card-footer p-0">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        PATIENT ADDRESS <span
                                            class="float-right badge bg-success">{{ ucwords($patient->address) }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        PATIENT DOB <span
                                            class="float-right badge bg-success">{{ ucwords($patient->dob)}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        PATIENT AGE <span
                                            class="float-right badge bg-success">{{ ucwords($patient->age )}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        GENDER <span
                                            class="float-right badge bg-success">{{ ucwords($patient->gender )}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        RELIGION <span
                                            class="float-right badge bg-success">{{ ucwords($patient->religion )}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        LANGUAGE <span
                                            class="float-right badge bg-success">{{ ucwords($patient->language )}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        MARITAL STATUS <span
                                            class="float-right badge bg-success">{{ ucwords($patient->marital )}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- card end -->
                </div>
            </div>



        </div>
        <!--end patient details 12-->
        @if(Auth::user()->id == $patient->assinged_doc)
        <div class=" row">
            <!-- patient video call portion -->
            <div class="col-md-6">
                @include('layouts.admin.doctor.partial.doctopatientmeeting')
            </div>
            <!-- patient video call portion end-->
            <!-- analysis details-->
            <div class="col-md-6">
                @include('layouts.admin.doctor.partial.patientanalysis')
            </div>
            <!-- analysis details end-->
        </div>

        <div class=" row">
            <!-- depatment portions -->
            @if(!empty($departments))
            <div class="col-md-6">
                <div class="card card-info collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">Department</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="display: none;">
                        <form role="form" id="changeDepartment" action="{{route('doctor.change.department', $patient)}}"
                            method="POST">
                            @csrf
                            @foreach($departments as $department)
                            <div class="radio">
                                @php
                                if(!empty($patient->user->departments[0]))
                                $depId = $patient->user->departments[0]->id ;
                                else
                                $depId = 'none';
                                @endphp
                                <label><input type="radio" name="department " value={{ $department->id }}
                                        {{ ($department->id == $depId ? 'checked' : '' ) }}>
                                    {{ ucwords($department->name)}} </label>
                            </div>
                            @endforeach
                            <button type="submit" class="btn btn-block btn-info btn-flat">Save</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            @endif
            <!-- depatment portions end-->
        </div>

        <div class="row">
            <!-- old prescription porttaion start -->
            <div class="col-md-6">
                @include('layouts.admin.doctor.partial.oldprescription')
            </div>
            <!-- old prescription porttaion start end-->

            <div class="col-md-6">
                <div class="card card-info collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">Reports</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /*pass patient elequent to file*/ -->
                    <div class="card-body" style="display: none;">

                        @include('layouts.admin.patient.partial.patientreports')
                    </div>
                    <!-- /*pass patient end -->
                </div>
            </div>
        </div>

        <div class="row">
            <!-- New Prescription porttaion start -->
            <div class="col-md-12">
                @include('layouts.admin.doctor.partial.newprescription')
            </div>
            <!-- New Prescription porttaion end -->

        </div>
        @endif
    </div>
</div>
</div>
</div>
@endsection
@section('pagespecificscripts')
<script src="{{ asset('js/required/ekko-lightbox.min.js') }}"></script>

<script>
$(function() {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            alwaysShowClose: true
        });
    });

    // $('.filter-container').filterizr({
    //     gutterPixels: 3
    // });
    // $('.btn[data-filter]').on('click', function() {
    //     $('.btn[data-filter]').removeClass('active');
    //     $(this).addClass('active');
    // });
})
</script>

@endsection