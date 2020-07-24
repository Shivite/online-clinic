<nav class="navbar navbar-expand-md shadow-sm special-card"" >
            <div class=" container">
    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{asset('images/logo.png')}}" width="60%;" alt="PR MEdication" class="brand-imageelevation-3"
            style="opacity: .8">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item ">
                <a class="nav-link btn-lg" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            <!-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('registerpatient') }}">{{ __('New Patient') }}</a>
                                </li>
                            @endif -->
            @else
            <li class="nav-item">

                @if(Auth::user()->hasAnyRole(['admin','staff']) )

                @php $path = 'admin/users'; @endphp

                @elseif(Auth::user()->hasRole('doctor'))

                @php $path = 'doctor/profile' ; @endphp

                @else

                @php $path = 'patient/profile' ; @endphp

                @endif

                <a class="nav-link" href="{{ $path }}">{{ Auth::user()->name}}</a>
            </li>
            <li class="nav-item">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            @endguest
        </ul>
    </div>
    </div>
</nav>
<br><br>