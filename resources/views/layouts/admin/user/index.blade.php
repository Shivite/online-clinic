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
                     <b>Users</b>
                  </h3>
                  <div class="card-tools">
                     <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                           <a href="{{route('admin.users.create')}}" class="btn-border  btn-sm" href="">Add User</a>
                        </li>
                     </ul>
                  </div>
               </div>
               @include('layouts.admin.user.partial.list')
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
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}" ></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" ></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}" ></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}" ></script>
<script src="{{ asset('js/custom.js') }}" ></script>
<!-- <script src="{{ asset('js/toastr.min.js') }}" ></script> -->
@stop
