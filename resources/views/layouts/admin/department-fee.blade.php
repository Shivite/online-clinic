@extends('app')
@section('title','Department Fee')
@section('content')
@include('layouts.partials.adminmenu')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-info">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">
                            <i class="fas fa-user mr-1"></i>
                            <b>Department Fee </b>
                        </h3>
                    </div>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <form role="form" id="storeUserForm" action="{{route('admin.fee.update')}}" method="POST">
                                @csrf
                                {{ method_field('POST') }}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">Department</label>
                                                <select id="role"
                                                    class="form-control @error('dept') is-invalid @enderror" name="dept"
                                                    required>
                                                    @foreach($departments as $dept)
                                                    <option value="{{ $dept->id }}">{{ ucwords($dept->name) }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fee">Fee</label>
                                                <input type="text" name="fee" class="form-control" id="fee"
                                                    placeholder="Fee" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-block btn-primary send_btn">
                                            Submit &nbsp;
                                        </button>
                                    </div>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
</div>
@endsection
@section('pagespecificscripts')
<script src="{{ asset('js/required/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/required/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/required/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/required/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<!-- <script src="{{ asset('js/toastr.min.js') }}" ></script> -->
@stop