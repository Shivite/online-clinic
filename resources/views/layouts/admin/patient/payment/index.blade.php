@if (Auth::user()->hasRole(['admin']))
@extends('app')
@section('title','Users List')
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
                            <b>Payments </b>
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                            </ul>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="data-listing" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Payment</th>
                                    <Th>Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach( $payments as $payment)
                                <tr>
                                    <th scope="row"> {{ $payment->users()->first()->id }} </th>
                                    <td> {{ ucwords($payment->users()->first()->name) }} </td>
                                    <td> {{ $payment->users()->first()->email }} </td>
                                    <td> {{ ucwords(implode(', ', $payment->users()->first()->departments()->get()->pluck('name')->toArray())) }}
                                    </td>
                                    <td> {{$payment->amount/100}} /- Rs.</td>
                                    <td> {{date('d-m-Y', strtotime($payment->created_at))}} </td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Payment</th>
                                    <Th>Date</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->

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
<!-- <script src="{{ asset('js/custom.js') }}"></script> -->
<!-- <script src="{{ asset('js/toastr.min.js') }}" ></script> -->
@stop
@endif