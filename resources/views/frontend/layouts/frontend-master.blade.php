<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{mix('frontend/css/app.css')}}">
    <title>Welcome To My Blog Site</title>
</head>

<body>
    {{-- Header Section --}}
    <header>
        {{-- Logo section --}}
        <section class="container-fluid py-2 bg-light">
            <div class="row justify-content-between">
                <div class="logo">
                    <a href="{{route('welcome')}}"><img src="{{asset('frontend/assets/trickbd-new-logo1.png')}}"
                            alt=""></a>
                </div>
                <div class="mt-3 mx-2">
                    @auth
                    <a href="{{ route('dashboard') }}" class="btn-sm border">Dashboard</a>
                    <a href="{{ route('logout') }}" class="btn-sm border">Logout</a>
                    @endauth
                    @guest
                    <a href="{{ route('sign-up') }}" class="btn-sm border">Sign Up</a>
                    <a href="{{ route('login') }}" class="btn-sm border">Login</a>
                    @endguest
                </div>
            </div>
        </section>
        {{-- End Logo section --}}

        {{-- Navbar Section --}}
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark my-navbar p-0">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="row container-fluid justify-content-between my-nav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-light font-size-14 border-right" href="#">Home </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light font-size-14 border-right" href="#">Notifications</a>
                        </li>
                    </ul>
                    <div class="border-rounded">
                        <a href="#" class="text-lg rounded-pill bg-white px-2">৳</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="border-bottom"></div>
    </header>
    {{-- End Header Section --}}

    {{-- End Navbar Section --}}
    <main class="main-part">
        @yield('main-content')
    </main>

    {{-- Footer Section --}}
    <footer class="bg-dark p-3 text-white">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <ul class="font-size-12">
                        <li> <a class="text-light" href="#"> About </a></li>
                        <li> <a class="text-light" href="#"> Contact </a></li>
                        <li> <a class="text-light" href="#"> Team </a></li>
                        <li> <a class="text-light" href="#"> Tearms & Conditions </a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-6">
                    <ul class="font-size-12">
                        <li> <a class="text-light" href="#"> User Rights </a></li>
                        <li> <a class="text-light" href="#"> Privacy Policy </a></li>
                        <li> <a class="text-light" href="#"> FAQ </a></li>
                        <li> <a class="text-light" href="#"> Copyright Issue </a></li>
                    </ul>
                </div>
            </div>
            <div class="footer">
                <div class="text-center">
                    <p class="pt-2">Copyright &copy; 2021 | All Rights Reserved By <a href="#">Developer-Rezwan</a></p>
                </div>
            </div>
        </div>
    </footer>
    {{-- End Footer Section --}}

    <script src="{{mix('frontend/js/app.js')}}"></script>
</body>

</html>
