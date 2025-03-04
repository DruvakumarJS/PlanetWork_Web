<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <!-- <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&display=swap" rel="stylesheet">
   
    <script src="{{ env('APP_URL') }}/js/app.js" defer></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    
    <script src="{{ env('APP_URL') }}/js/common.js" defer></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="noreferrer"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        /* Reset Body and HTML */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
        }

        /* Overall Layout */
        body {
            display: flex;
        }

        /* Sidebar */
        .side-nav {
            width: 170px;
            height: 100vh;
            background-color: #ECF2FF;
            border-right: 1px solid #dee2e6;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
        }

        .side-nav a {
            padding: 3px 15px;
            display: block;
            color: #495057;
            text-decoration: none;
        }

        .side-nav a:hover {
            background-color: #e9ecef;
            color: #212529;
        }

        /* Content Wrapper */
        .content-wrapper {
            margin-left: 170px;
            width: calc(100% - 170px);
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }

        /* Top Navbar */
        .top-navbar {
            height: 70px;
            background-color: #ffffff;
            display: flex;
            align-items: center;
            padding: 0 15px;
            position: relative;
           /* border-bottom: solid 1px;*/
        }

        /* Main Content */
        .main-content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: #ffffff;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="side-nav">
        <div class="mt-2 p-3">
            <label class="font2"><strong>PW</strong>Software</label>
        </div>
        <a href="{{route('home')}}"><img src="/images/dash.svg"> <label class="ms-2 font1">Dashboard</label> </a>
       
        <a class="pt-3" href=""><label class="font-small">CRM</label></a>

        <a href="{{route('customers')}}"><img src="/images/Customer.svg"> <label class="ms-2 font1">Customer</label> </a>

        <a href="{{ route('products')}}"><img src="/images/product.svg"> <label class="ms-2 font1">Products</label> </a>

        <a class="pt-3" href=""><label class="font-small">SALES</label></a>

        <a href="{{route('enquiry')}}"><img src="/images/product.svg"> <label class="ms-2 font1">Enquiry</label> </a>

        <a href="{{route('view_quote')}}"><img src="/images/product.svg"> <label class="ms-2 font1">Quote</label> </a>

        <a href="{{route('performa_invoice')}}"><img src="/images/product.svg"> <label class="ms-2 font1">Proforma  Invoice</label> </a>

        <a href="{{route('invoice')}}"><img src="/images/product.svg"> <label class="ms-2 font1">Invoice</label> </a>

        <a class="pt-3" href=""><label class="font-small">HUMAN RESORCE</label></a>

        <a href=""><img src="/images/customer.svg"> <label class="ms-2 font1">Employee</label> </a>

        <a href=""><img src="/images/product.svg"> <label class="ms-2 font1">Performance</label> </a>

        <a href=""><img src="/images/product.svg"> <label class="ms-2 font1">LMS</label> </a>

        <a href=""><img src="/images/attendence.svg"> <label class="ms-2 font1">Attendance</label> </a>

        <a class="pt-3" href=""><label class="font-small">ACCOUNTS</label></a>

        <a href=""><img src="/images/pettyc.svg"> <label class="ms-2 font1">Petty Cash</label> </a>

        <a href=""><img src="/images/product.svg"> <label class="ms-2 font1">Salary</label> </a>

        <a href=""><img src="/images/increment.svg"> <label class="ms-2 font1">Increament</label> </a>
        
        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    <!-- Content -->
    <div class="content-wrapper">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-md top-navbar border-none">
               @if(Route::is('home'))
                  <label class="font-heading">Dashboard</label>
               @endif
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto mt-3">
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

                            <a class="dropdown-item mt-2" data-bs-toggle="modal" data-bs-target="#moddl"><img class="circle" src="{{asset('images/search.svg')}}" style="width: 20px;height: 20px;margin-left: 10px;margin-right: 20px">
                            </a>
                        
                            <a class="dropdown-item mt-2" data-bs-toggle="modal" data-bs-target="#moddl"><img class="circle" src="{{asset('images/inf.svg')}}" style="width: 20px;height: 20px;margin-left: 10px;margin-right: 20px">
                            </a>

                             <a class="dropdown-item mt-2" data-bs-toggle="modal" data-bs-target="#moddl"><img class="circle" src="{{asset('images/notifi.svg')}}" style="width: 20px;height: 20px;margin-left: 10px;margin-right: 50px">
                            </a>

                           
                            <div class="userLogin">
                                <span class="font2-bold" style="width: 100px"> {{ Auth::user()->name }}</span>
                                <span class="font1" style="width: 100px">Administrator</span>
                            </div>

                            <li class="nav-item dropdown ms-2">
                                
                                <a id="navbarDropdown" class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre href=""> <img class="circle" src="{{asset('images/profile.svg')}}" style="width: 35px;height: 35px;margin-left: 2px;"> </a>


                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>

        <!-- Main Content -->
        <main class="main-content">
            @yield('content')
        </main>
    </div>
</body>
</html>
