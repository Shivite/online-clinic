@extends('layouts.frontend.index')
@section('pagespecificstyles')

@endsection
@section('content')
@include('layouts.frontend.menu')
<div class=" row  justify-content-center">
  <div class="col-md-10">
      <div class="card card-primary card-outline special-card" >
        <section class="content-header text-  center">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-10">
                <h1>Registration Successfull</h1>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="invoice p-3 mb-3">
                  <h4>
                      <i class="fa fa-user-md"></i> PR Medication Online Clinic
                  </h4>
                  <div class="callout callout-info">
                      <h5><i class="fas fa-info"></i> Welcome:</h5>
                        Welcome to PR Meditaion Online Clinic. Please check your email fo the details.
                        <br><br>
                        Thanking You
                  </div>
                </div>
              </div>
            </div>
          </div><!-- /.col -->
        </section>
     </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

@endsection

@section('pagespecificscripts')

@endsection
