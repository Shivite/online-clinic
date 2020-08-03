@extends('app')
@section('title','Doctor Profile')
@section('content')
@include('layouts.partials.doctormenu')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Patients List</h1>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- /.col -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#searchId"
                                        data-toggle="tab">Search with ID</a></li>

                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="searchId">
                                    <form role="form" id="storeUserForm" action="{{route('doctor.patientsearchid')}}"
                                        method="POST">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">PR00</span>
                                            </div>
                                            <input type="number" class="form-control" placeholder="patient Id"
                                                name="patientId">
                                        </div>
                                        <div class="form-group">
                                            <label>&nbsp;&nbsp;</label>
                                            </span>
                                            <button type="submit" class="btn btn-block btn-info reqsub">
                                                </i> SEARCH
                                            </button>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="searchDate">
                                    <div class="post">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <div class="col-md-12">
                    @if(!empty($patients))
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Patient Id</th>
                                <th>Patient Name</th>
                                <th>View Profile</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($patients as $patient)
                            <tr>
                                <td>PR00{{$patient->id}}</td>
                                <td>{{ $patient->name }}</td>
                                <td class="">
                                    <a href="{{ route('doctor.patient.profile', $patient->id )}}"
                                        class="btn btn-warning"><b>
                                            <i class="far fa-address-book"></i></b></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</div><!-- /.container-fluid -->
</section>
</div>

</div>

@endsection
@section('pagespecificscripts')
<script src="{{ asset('js/required/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/required/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/required/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/required/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script>
$(function() {

    $('#example').DataTable({
        lengthChange: false,

    });

});
</script>
@stop