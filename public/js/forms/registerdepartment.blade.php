@extends('layouts.frontend.index')
@section('pagespecificstyles')
<link href="{{ asset('/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet">

<link href="{{ asset('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">


@endsection

@section('content')
@include('layouts.frontend.menu')
<div class="container">

<div class=" row  justify-content-center">
  <div class="col-md-12">
      <div class="card card-primary card-outline special-card" >
          <div class="card-body box-profile">
            <h3 class="text-center">Select Department</h3>
            <div class = "row">
              @foreach($departments as $department)
              <div class="col-md-3">
                  <!-- Widget: user widget style 1 -->
                  <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header">
                      <h5><b> {{ strtoupper($department->name)}}</b></h5>
                    </div>
                    <div class="widget-user-image">
                      @php $imgPath = asset('images/department/'.$department->image); @endphp
                      <img class="img-circle elevation-2" src="{{$imgPath}}" alt="User Avatar">
                    </div>
                    <div class="card-footer same_height">
                      <h3 class="card-title">Select Disease</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        </button>
                      </div>
                      <ul class="nav nav-pills flex-column">
                        @foreach($department->diseases as $disease)
                        <li class="nav-item active">
                          <div class="nav-link dept_select" data-id="{{ $disease->id}}" data-dept="{{ $department->id}}">
                            {{ strtoupper($disease->name)}}
                          </div>
                        </li>
                        @endforeach
                </ul>
                    </div>

                  </div>
                </div>
                @endforeach

            </div>


          </div>
      </div>
    </div>
</div>
</div>
</div>

@endsection

@section('pagespecificscripts')

<script>
  $(function () {
      $('.dept_select').click(function(e){
        e.preventDefault();
        $.ajax({
           type:'POST',
           url:'/registration/patient/department',
           dataType:'json',
           data:{
               '_token' : '<?php echo csrf_token() ?>',
               'diseaseId' : $(this).attr("data-id"),
               'departmentId' : $(this).attr("data-dept"),
           },
          success: function(data)
          {
           if(data.success)
            {
                window.location = data.url
            }
          }
        });
      });
  });

</script>

@endsection
