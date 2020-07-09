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
                     <b>Patient </b>
                  </h3>
                  <div class="card-tools">
                     <ul class="nav nav-pills ml-auto">
                     </ul>
                  </div>
               </div>
               @include('layouts.admin.patient.partial.list')
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
<script src="{{ asset('js/required/jquery.dataTables.min.js') }}" ></script>
<script src="{{ asset('js/required/dataTables.bootstrap4.min.js') }}" ></script>
<script src="{{ asset('js/required/dataTables.responsive.min.js') }}" ></script>
<script src="{{ asset('js/required/responsive.bootstrap4.min.js') }}" ></script>
<script src="{{ asset('js/custom.js') }}" ></script>
<!-- <script src="{{ asset('js/toastr.min.js') }}" ></script> -->
@stop
