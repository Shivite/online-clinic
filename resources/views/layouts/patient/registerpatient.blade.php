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
            <h3 class="text-center">New Patient Registration</h3>
            <p class="text-muted"> </p>
            <form action="/registration/create-step1" method="POST">
            @csrf
                <div class="row">
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>Title</label>
                      <select id="title" class="form-control @error('title') is-invalid @enderror" name = "title"  >
                        <option {{ (isset($patient->title) && $patient->title == 'Ms') ? 'selected': '' }} value = "mr">Mr.</option>
                        <option {{ (isset($patient->title) && $patient->title == 'Ms') ? 'selected': '' }} value = "ms">Ms.</option>
                        <option {{ (isset($patient->title) && $patient->title == 'Ms') ? 'selected': '' }} value = "mrs">Mrs.</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>Patient Name</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{(isset($patient->name)) ? $patient->name: '' }}" placeholder="Name"  >
                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                    <label>Contact Number</label>
                    <input id="number" type="number" class="form-control @error('number') is-invalid @enderror" name="number" value="{{(isset($patient->number)) ? $patient->number: '' }}" placeholder="Number"  >
                    @error('number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                    <label>Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                    <label>Email Address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{(isset($patient->email)) ? $patient->email: '' }}"  autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Alternative Number</label>
                      <input id="altnumber" type="altnumber" class="form-control @error('altnumber') is-invalid @enderror" name="altnumber" value="{{(isset($patient->altnumber)) ? $patient->altnumber: '' }}" placeholder="Number"  >
                      @error('altnumber')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                    <label>Address</label>
                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" rows="5" name="address"  placeholder="Address" >{{(isset($patient->address)) ? $patient->address: '' }} </textarea>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                    <label>Pin</label>
                    <input  type="number" id="pin" class="form-control @error('pin') is-invalid @enderror" name="pin" value="{{(isset($patient->pin)) ? $patient->pin: '' }}" placeholder="Pin code"  >
                    @error('pin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Legal Gaurdian</label>
                    <input  type="text" id="legalgaurdian" class="form-control @error('legalgaurdian') is-invalid @enderror" name="legalgaurdian" value="{{(isset($patient->legalgaurdian)) ? $patient->legalgaurdian: '' }}">
                    @error('legalgaurdian')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                      <label>Country</label>
                      <select id="country" class="form-control @error('country') is-invalid @enderror" name = "country"  >
                      </select>
                      @error('country')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Country</label>
                      <select id="state" class="form-control @error('state') is-invalid @enderror" name = "state"  >
                      </select>
                      @error('state')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                </div>

                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Date:</label>
                        <div class="input-group date" id="dob" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#dob" name = "dob" value = "{{(isset($patient->dob)) ? $patient->dob: '' }}" />
                            <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>If Referred By Doctor</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="nav-icon fas fa-user-md "></i></span>
                        </div>
                        <input id="docname" name="docname"type="text" class="form-control  @error('docname') is-invalid @enderror"  placeholder="Doctor Name" {{(isset($patient->docname)) ? $patient->docname: '' }}">
                        @error('docname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-sm-2">
                  <div class="form-group">
                    <label>Gender</label>
                    <select id="gender" class="form-control @error('gender') is-invalid @enderror" name = "gender"  >
                      <option {{ (isset($patient->gender) && $patient->gener == 'male') ? 'selected': '' }} value = "mr">Male</option>
                      <option {{ (isset($patient->gender) && $patient->title == 'female') ? 'selected': '' }} value = "mr">Female</option>
                    </select>
                    @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                  </div>
                </div>


                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>Age</label>
                      <select id="age" class="form-control @error('age') is-invalid @enderror" name = "age"  >
                        @for($cnt = 1; $cnt < 80; $cnt++ )
                        <option {{ (isset($patient->age) && $patient->age == $cnt) ? 'selected': '' }} value="{{ $cnt }}">{{$cnt}}</option>
                        @endfor
                      </select>
                      @error('age')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror

                    </div>
                  </div>

                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>Language</label>
                      <select class="form-control" name = "language">
                        <option {{ (isset($patient->language) && $patient->language == 'english') ? 'selected': '' }} value = "english">English</option>
                        <option {{ (isset($patient->language) && $patient->language == 'hindi') ? 'selected': '' }} value = "english">Hindi</option>
                        <option {{ (isset($patient->language) && $patient->language == 'punjabi') ? 'selected': '' }} value = "panjabi">Pnjabi</option>
                        <option {{ (isset($patient->language) && $patient->language == 'bungali') ? 'selected': '' }} value = "bangali">Bangali</option>
                      </select>
                      @error('language')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>Religion</label>
                      <select class="form-control" name = "religion">
                        <option {{ (isset($patient->religion) && $patient->religion == 'hindu') ? 'selected': '' }} value = "hindu">Hindu</option>
                        <option {{ (isset($patient->religion) && $patient->religion == 'muslim') ? 'selected': '' }} value = "hindu">Muslim</option>
                        <option {{ (isset($patient->religion) && $patient->religion == 'punjabi') ? 'selected': '' }} value = "hindu">Punjabi</option>
                      </select>
                      @error('religion')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>Occupation</label>
                      <select class="form-control  @error('occupaton') is-invalid @enderror" name = "occupaton">
                        <option {{ (isset($patient->occupation) && $patient->occupation == 'business') ? 'selected': '' }} value = "business">Business</option>
                        <option {{ (isset($patient->occupation) && $patient->occupation == 'job') ? 'selected': '' }} value = "job">Job</option>
                        <option {{ (isset($patient->occupation) && $patient->occupation == 'retired') ? 'selected': '' }} value = "retired">Retired</option>
                      </select>
                      @error('docname')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>Merital Status</label>
                      <select class="form-control  @error('marital') is-invalid @enderror" name = "marital">
                        <option {{ (isset($patient->marital) && $patient->marital == 'single') ? 'selected': '' }} value = "single">single</option>
                        <option {{ (isset($patient->marital) && $patient->marital == 'married') ? 'selected': '' }} value = "married">Married</option>
                        <option {{ (isset($patient->marital) && $patient->marital == 'divorcee') ? 'selected': '' }} value = "single">Divorcee</option>

                      </select>
                      @error('docname')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Recent Photograph</label>
                      <div class="custom-file" name = "photo">
                        <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" id="customFile" name = "photo">
                        <label class="custom-file-label" for="customFile">Upload Photo</label>
                        @error('docname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-3">
                  <div class="form-group">
                    <label for="customFile">Country Proof</label>
                    <div class="custom-file">
                      <input id="countryproof" type="file" class="custom-file-input  @error('proof') is-invalid @enderror" id="customFile" name = "proof">
                      <label class="custom-file-label" for="customFile">Choose file</label>
                      @error('countryproof')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>&nbsp;&nbsp;</label>
                        <button class="btn btn-block btn-primary">
                        <i class="fas fa-arrow-right "></i> NEXT
                      </button>
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
