<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    <li class="nav-item">
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item d-none d-sm-inline-block">
      <a class="dropdown-item" href="{{ route('logout') }}"
         onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </li>
  </ul>
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="#" class="brand-link">
    <img src="{{asset('images/logo.png')}}" alt="PR MEdication" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">PR Medication</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
          @php $imgPath = asset('storage/patient/profile/'.$patient->photo); @endphp
          <img src="{{ asset( $imgPath ) }}" class="img-circle elevation-2" alt="">
      </div>
      <div class="info">
          <a href="#" class="d-block"><b>{{ucwords($patient->name) }}</b> </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('patient.profile')}}" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Patient Details
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </li>
      </ul>
    </nav>
  </div>
</aside>
