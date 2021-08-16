<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{ trans('panel.site_title') }}</title>
    <meta name="description" content="Katen - Minimal Blog & Magazine HTML Theme">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/landing/favicon.png')}}">

    <!-- STYLES -->
    <link rel="stylesheet" href="{{ asset('css/landing/bootstrap.min.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/landing/all.min.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/landing/slick.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/landing/simple-line-icons.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('css/landing/style.css')}}" type="text/css" media="all">
    @yield('styles')

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
</head>

<body>

@include('partials/preloader')

<div class="site-wrapper">
    <div class="main-overlay"></div>
    <header class="header-classic">
        <div class="container-xl">
            <div class="header-top">
                <div class="row align-items-center">

                    <div class="col-md-4 col-xs-12">
                        <a class="navbar-brand" href="{{ route('landing.home.index') }}"><img src="{{asset('images/landing/logo.svg')}}" alt="logo" /></a>
                    </div>

                    <div class="col-md-8 d-none d-md-block">
                        <ul class="social-icons list-unstyled list-inline mb-0 float-end">
                            <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        @include('partials/menuLanding')

    </header>

@yield('content')

    <!-- footer -->
    <footer>
        <div class="container-xl">
            <div class="footer-inner">
                <div class="row d-flex align-items-center gy-4">
                    <!-- copyright text -->
                    <div class="col-md-4">
                        <span class="copyright">© 2021 Katen. Template by ThemeGer.</span>
                    </div>

                    <!-- social icons -->
                    <div class="col-md-4 text-center">
                        <ul class="social-icons list-unstyled list-inline mb-0">
                            <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>

                    <!-- go to top button -->
                    <div class="col-md-4">
                        <a href="#" id="return-to-top" class="float-md-end"><i class="icon-arrow-up"></i>Back to Top</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>

<div class="search-popup">
    <!-- close button -->
    <button type="button" class="btn-close" aria-label="Close"></button>
    <!-- content -->
    <div class="search-content">
        <div class="text-center">
            <h3 class="mb-4 mt-0">Press ESC to close</h3>
        </div>
        <!-- form -->
        <form class="d-flex search-form">
            <input class="form-control me-2" type="search" placeholder="Search and press enter ..." aria-label="Search">
            <button class="btn btn-default btn-lg" type="submit"><i class="icon-magnifier"></i></button>
        </form>
    </div>
</div>

<div class="canvas-menu d-flex align-items-end flex-column">
    <button type="button" class="btn-close" aria-label="Close"></button>

    <div class="logo">
        <img src="{{asset('images/landing/logo.svg')}}" alt="Logo" />
    </div>

    <ul class="social-icons list-unstyled list-inline mb-0 mt-auto w-100">
        <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
        <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
        <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
        <li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
    </ul>
</div>

<!-- JAVA SCRIPTS -->
<script src="{{asset('js/landing/jquery.min.js')}}"></script>
<script src="{{asset('js/landing/popper.min.js')}}"></script>
<script src="{{asset('js/landing/bootstrap.min.js')}}"></script>
<script src="{{asset('js/landing/slick.min.js')}}"></script>
<script src="{{asset('js/landing/jquery.sticky-sidebar.min.js')}}"></script>
<script src="{{asset('js/landing/custom.js')}}"></script>
@yield('scripts')

</body>
</html>