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
            <h3 class="text-center">Upload Reports</h3>
            <p class="text-muted"> </p>
            <form action="{{route('register.reports')}}" role="form" enctype="multipart/form-data" method="POST">
              @csrf
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="customFile">Upload Report-1</label>
                    <div class="custom-file">
                      <input id="uploadreport1" type="file" class="custom-file-input  @error('uploadreport1') is-invalid @enderror" id="customFile1" name = "uploadreport1">
                      <label class="custom-file-label" for="customFile1">Choose file</label>
                      @error('uploadreport1')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group">
                  <label for="customFile">Upload Report-2</label>
                  <div class="custom-file">
                    <input id="uploadreport2" type="file" class="custom-file-input  @error('uploadreport2') is-invalid @enderror" id="customFile2" name = "uploadreport2">
                    <label class="custom-file-label" for="customFile2">Choose file</label>
                    @error('uploadreport2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="customFile">Upload Report-3</label>
                    <div class="custom-file">
                      <input id="uploadreport3" type="file" class="custom-file-input  @error('uploadreport3') is-invalid @enderror" id="customFile3" name = "uploadreport3">
                      <label class="custom-file-label" for="customFile3">Choose file</label>
                      @error('uploadreport3')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group">
                  <label for="customFile">Upload Report-4</label>
                  <div class="custom-file">
                    <input id="uploadreport4" type="file" class="custom-file-input  @error('uploadreport4') is-invalid @enderror" id="customFile4" name = "uploadreport4">
                    <label class="custom-file-label" for="customFile4">Choose file</label>
                    @error('uploadreport4')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="customFile">Upload Report-5</label>
                    <div class="custom-file">
                      <input id="uploadreport5" type="file" class="custom-file-input  @error('uploadreport5') is-invalid @enderror" id="customFile5" name = "uploadreport5">
                      <label class="custom-file-label" for="customFile5">Choose file</label>
                      @error('uploadreport5')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group">
                  <label for="customFile">Upload Report-6</label>
                  <div class="custom-file">
                    <input id="uploadreport6" type="file" class="custom-file-input  @error('uploadreport6') is-invalid @enderror" id="customFile6" name = "uploadreport6">
                    <label class="custom-file-label" for="customFile6">Choose file</label>
                    @error('uploadreport6')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="customFile">Upload Report-7</label>
                    <div class="custom-file">
                      <input id="uploadreport7" type="file" class="custom-file-input  @error('uploadreport7') is-invalid @enderror" id="customFile7" name = "uploadreport7">
                      <label class="custom-file-label" for="customFile7">Choose file</label>
                      @error('uploadreport7')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group">
                  <label for="customFile">Upload Report-8</label>
                  <div class="custom-file">
                    <input id="uploadreport8" type="file" class="custom-file-input  @error('uploadreport8') is-invalid @enderror" id="customFile8" name = "uploadreport8">
                    <label class="custom-file-label" for="customFile8">Choose file</label>
                    @error('uploadreport8')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="customFile">Upload Report-9</label>
                    <div class="custom-file">
                      <input id="uploadreport9" type="file" class="custom-file-input  @error('uploadreport9') is-invalid @enderror" id="customFile9" name = "uploadreport9">
                      <label class="custom-file-label" for="customFile9">Choose file</label>
                      @error('uploadreport9')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group">
                  <label for="customFile">Upload Report-10</label>
                  <div class="custom-file">
                    <input id="uploadreport10" type="file" class="custom-file-input  @error('uploadreport10') is-invalid @enderror" id="customFile10" name = "uploadreport10">
                    <label class="custom-file-label" for="customFile10">Choose file</label>
                    @error('uploadreport10')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                </div>
              </div>

                <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>&nbsp;&nbsp;</label>
                      <a class="btn btn-block btn-primary">
                      <i class="fas fa-arrow-left "></i>&nbsp; PREVIOUS
                    </a>
                    </button>
                  </div>
                </div>

                <div class="col-sm-3">
</div>
                  <div class="col-sm-3">
</div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>&nbsp;&nbsp;</label>
                      <button class="btn btn-block btn-primary">
                       NEXT &nbsp; <i class="fas fa-arrow-right "></i>
                    </button>
                  </div>
                </div>
              </form>
            <hr>

          </div>
      </div>
    </div>
</div>
</div>

@endsection

@section('pagespecificscripts')
<script src="{{ asset('js/required/bs-custom-file-input.min.js') }}" defer></script>

<script>
  $(function () {
    bsCustomFileInput.init();
  });

</script>


@endsection
