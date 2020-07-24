@extends('app')
@section('title','Edit User')
@section('content')
@include('layouts.partials.adminmenu')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>EDIT PATIENT</h1>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#details"
                                    data-toggle="tab">Details</a></li>
                            <li class="nav-item"><a class="nav-link" href="#analysis1" data-toggle="tab">Analysis 1</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#analysis2" data-toggle="tab">Analysis 2</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#analysis3" data-toggle="tab">Analysis 3</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#analysis4" data-toggle="tab">Analysis 4</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#analysis5" data-toggle="tab">Analysis 5</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#analysis6" data-toggle="tab">Analysis 6</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#analysis7" data-toggle="tab">Analysis 7</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#analysis8" data-toggle="tab">Analysis 8</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="details">
                                <div class="post">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <i class="fas fa-user"></i>
                                                <b>Edit Patient</b>
                                            </h3>
                                        </div>
                                        <form role="form" enctype="multipart/form-data" id="storeUserForm"
                                            action="{{route('admin.patient.update', $patient)}}" method="POST">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <div class="card-body">
                                                @include('layouts.admin.patient.partial.form')
                                                <div class="card-footer">
                                                    <button class="btn btn-block btn-primary send_btn">
                                                        UPDATE &nbsp;
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="post clearfix"></div>
                            </div>

                            <div class="tab-pane" id="analysis1">
                                <div class="post">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <i class="fas fa-user"></i>
                                                <b>Patient Analysis Step First</b>
                                            </h3>
                                        </div>
                                        <form role="form" enctype="multipart/form-data" id="analysisForm1"
                                            action="{{route('admin.patient.analysis.first', $patient)}}" method="POST">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <div class="card-body">
                                                @include('layouts.admin.patient.partial.analysis-form-1')
                                                <div class="card-footer">
                                                    <button class="btn btn-block btn-primary send_btn">
                                                        UPDATE &nbsp;
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="post clearfix"></div>
                            </div>

                            <div class="tab-pane" id="analysis2">
                                <div class="post">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <i class="fas fa-user"></i>
                                                <b>Patient Analysis Step Second</b>
                                            </h3>
                                        </div>
                                        <form role="form" id="analysisForm2"
                                            action="{{route('admin.patient.analysis.second', $patient)}}" method="POST">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <div class="card-body">
                                                @include('layouts.admin.patient.partial.analysis-form-2')
                                                <div class="card-footer">
                                                    <button class="btn btn-block btn-primary send_btn">
                                                        UPDATE &nbsp;
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="post clearfix"></div>
                            </div>

                            <div class="tab-pane" id="analysis3">
                                <div class="post">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <i class="fas fa-user"></i>
                                                <b>Patient Analysis Step Third</b>
                                            </h3>
                                        </div>
                                        <form role="form" id="analysisForm3"
                                            action="{{route('admin.patient.analysis.third', $patient)}}" method="POST">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <div class="card-body">
                                                @include('layouts.admin.patient.partial.analysis-form-3')
                                                <div class="card-footer">
                                                    <button class="btn btn-block btn-primary send_btn">
                                                        UPDATE &nbsp;
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="post clearfix"></div>
                            </div>


                            <div class="tab-pane" id="analysis4">
                                <div class="post">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <i class="fas fa-user"></i>
                                                <b>Patient Analysis Step Fourth</b>
                                            </h3>
                                        </div>
                                        <form role="form" id="analysisForm4"
                                            action="{{route('admin.patient.analysis.fourth', $patient)}}" method="POST">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <div class="card-body">
                                                @include('layouts.admin.patient.partial.analysis-form-4')
                                                <div class="card-footer">
                                                    <button class="btn btn-block btn-primary send_btn">
                                                        UPDATE &nbsp;
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="post clearfix"></div>
                            </div>



                            <div class="tab-pane" id="analysis5">
                                <div class="post">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <i class="fas fa-user"></i>
                                                <b>Patient Analysis Step Fifth</b>
                                            </h3>
                                        </div>
                                        <form role="form" id="analysisForm5"
                                            action="{{route('admin.patient.analysis.fifth', $patient)}}" method="POST">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <div class="card-body">
                                                @include('layouts.admin.patient.partial.analysis-form-5')
                                                <div class="card-footer">
                                                    <button class="btn btn-block btn-primary send_btn">
                                                        UPDATE &nbsp;
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="post clearfix"></div>
                            </div>




                            <div class="tab-pane" id="analysis6">
                                <div class="post">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <i class="fas fa-user"></i>
                                                <b>Patient Analysis Step Sixth</b>
                                            </h3>
                                        </div>
                                        <form role="form" id="analysisForm6"
                                            action="{{route('admin.patient.analysis.sixth', $patient)}}" method="POST">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <div class="card-body">
                                                @include('layouts.admin.patient.partial.analysis-form-6')
                                                <div class="card-footer">
                                                    <button class="btn btn-block btn-primary send_btn">
                                                        UPDATE &nbsp;
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="post clearfix"></div>
                            </div>



                            <div class="tab-pane" id="analysis7">
                                <div class="post">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <i class="fas fa-user"></i>
                                                <b>Patient Analysis Step Seventh</b>
                                            </h3>
                                        </div>
                                        <form role="form" id="analysisForm7"
                                            action="{{route('admin.patient.analysis.seventh', $patient)}}"
                                            method="POST">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <div class="card-body">
                                                @include('layouts.admin.patient.partial.analysis-form-7')
                                                <div class="card-footer">
                                                    <button class="btn btn-block btn-primary send_btn">
                                                        UPDATE &nbsp;
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="post clearfix"></div>
                            </div>



                            <div class="tab-pane" id="analysis8">
                                <div class="post">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <i class="fas fa-user"></i>
                                                <b>Patient Analysis Step Eight</b>
                                            </h3>
                                        </div>
                                        <form role="form" id="analysisForm8"
                                            action="{{route('admin.patient.analysis.eight', $patient)}}" method="POST">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <div class="card-body">
                                                @include('layouts.admin.patient.partial.analysis-form-8')
                                                <div class="card-footer">
                                                    <button class="btn btn-block btn-primary send_btn">
                                                        UPDATE &nbsp;
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="post clearfix"></div>
                            </div>


                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
</div>
@endsection
@section('pagespecificscripts')
<script src="{{ asset('js/required/moment.min.js') }}"></script>
<script src="{{ asset('js/required/daterangepicker.js') }}"></script>
<script src="{{ asset('js/required/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{ asset('js/forms/custom-country-selection.js') }}"></script>
<script src="{{ asset('js/required/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/forms/patient-form-validation.js') }}"></script>
<script src="{{ asset('js/required/bs-custom-file-input.min.js') }}" defer></script>
<script src="{{ asset('js/forms/custom-validation.js') }}"></script>
<script>
$(function() {
    bsCustomFileInput.init();
    $('#dob').datetimepicker({
        format: 'DD-MM-YYYY',
        defaultDate: moment('<?php echo $patient->dob; ?>'),
    });
});
</script>
<!-- <script src="{{ asset('js/required/jquery.validate.min.js') }}" defer></script>
   <script src="{{ asset('/js/required/additional-methods.min.js') }}" defer></script> -->
@endsection