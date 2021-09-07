<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')</title>

   
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-stylesheet" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-stylesheet" rel="stylesheet" type="text/css" />
    @yield('css')
</head>
<body>
    <div id="app">
        <div class="navbar-custom">
            <ul class="list-unstyled topnav-menu float-right mb-0">


             
                @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="dropdown notification-list">

                    <a id="navbarDropdown"  class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                      
                        <a class="dropdown-item notify-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fe-log-out"></i>
                                        <span>Logout</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                    </div>
                </li>
                @endguest

            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="{{ url('/dashboard') }}" class="logo logo-dark text-center">
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="16">
                    </span>
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="24">
                    </span>
                </a>
                <a href="index.html" class="logo logo-light text-center">
                    <span class="logo-lg">
                        <img src="assets/images/logo-light.png" alt="" height="16">
                    </span>
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="24">
                    </span>
                </a>
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
                <li>
                    <button class="button-menu-mobile disable-btn waves-effect">
                        <i class="fe-menu"></i>
                    </button>
                </li>

                <li>
                    <h4 class="page-title-main">Dashboard</h4>
                </li>
    
            </ul>

        </div>
    
         <!-- ========== Left Sidebar Start ========== -->
  @include('includes.sidebar')
  <!-- Left Sidebar End -->

    <div class="container-fluid">
        <div class="row">
     <div class="col-sm-10 offset-md-2" style="margin-top: 20px">
            <main class="py-4">
                @yield('content')
            </main>
         </div>
        </div>
    </div>

    </div>
   
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

     <!-- Vendor js -->
     <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

     <!-- knob plugin -->
     <script src="{{ asset('assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>

     <!--Morris Chart-->
     <script src="{{ asset('assets/libs/morris-js/morris.min.js') }}"></script>
     <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>

     <!-- Dashboard init js-->
     <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

     <!-- App js -->
     <script src="{{ asset('assets/js/app.min.js') }}"></script>
      @stack('script')
     
</body>

</html>
