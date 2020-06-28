@extends('layouts.frontend.index')
@section('pagespecificstyles')
<link href="{{ asset('/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet">

<link href="{{ asset('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">


@endsection

@section('content')
@include('layouts.frontend.menu')

<div class=" row  justify-content-center">
  <div class="col-md-10">
      <div class="card card-primary card-outline special-card" >
          <div class="card-body box-profile">
            <h3 class="text-center">Select Department</h3>
            <div class = "row">

        <div class="col-md-2">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header">
                <h5><b>ONCOLOGY</b></h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="../dist/img/user1-128x128.jpg" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">

                    <div class="card-body">
                      <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="cancer" name="cancer" checked="">
                          <label for="cancer" class="custom-control-label">CANCER</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="cyst" name="cyst" checked="">
                          <label for="cyst" class="custom-control-label">CYST</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="tumor" name="tumor" checked="">
                          <label for="cyst" class="custom-control-label">TUMOR</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="abnormalgrowth" name="abnormalgrowth" checked="">
                          <label for="cyst" class="custom-control-label">ABNORMAL GROWTH</label>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
              </div>
            </div>

                    <div class="col-md-2">
                        <!-- Widget: user widget style 1 -->
                        <div class="card card-widget widget-user">
                          <!-- Add the bg color to the header using any of the bg-* classes -->
                          <div class="widget-user-header">
                            <h5><b>ONCOLOGY</b></h5>
                          </div>
                          <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="../dist/img/user1-128x128.jpg" alt="User Avatar">
                          </div>
                          <div class="card-footer">
                            <div class="row">

                                <div class="card-body">
                                  <div class="custom-control custom-radio">
                                      <input class="custom-control-input" type="radio" id="cancer" name="cancer" checked="">
                                      <label for="cancer" class="custom-control-label">CANCER</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                      <input class="custom-control-input" type="radio" id="cyst" name="cyst" checked="">
                                      <label for="cyst" class="custom-control-label">CYST</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                      <input class="custom-control-input" type="radio" id="tumor" name="tumor" checked="">
                                      <label for="cyst" class="custom-control-label">TUMOR</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                      <input class="custom-control-input" type="radio" id="abnormalgrowth" name="abnormalgrowth" checked="">
                                      <label for="cyst" class="custom-control-label">ABNORMAL GROWTH</label>
                                    </div>
                                </div>

                            </div>
                            <!-- /.row -->
                          </div>
                        </div>
            <!-- /.widget-user -->
          </div>
            </div>


          </div>
      </div>
    </div>
</div>
</div>

@endsection

@section('pagespecificscripts')
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}" defer></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{ asset('js/forms/custom-country-selection.js') }}" defer></script>

<script>
  $(function () {
    $('#dob').datetimepicker({
        format: 'L',
        startDate: '-3d',
    });
  });

</script>

@endsection
