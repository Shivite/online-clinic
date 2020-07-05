@extends('app')
@section('title','Users List')
@section('content')
@include('layouts.partials.patientmenu')
<div class="content-wrapper">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12">
            <div class="card card-info">
               <div class="card-header ui-sortable-handle" style="cursor: move;">
                  <h3 class="card-title">
                     <i class="fas fa-user mr-1"></i>
                     <b>Patient Details</b>
                  </h3>
                  <div class="card-tools">
                     <form>
                       
                     </form>
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
@stop
