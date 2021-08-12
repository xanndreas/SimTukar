<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Katen - Minimal Blog & Magazine HTML Theme</title>
    <meta name="description" content="Katen - Minimal Blog & Magazine HTML Theme">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

    <!-- STYLES -->
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('user/css/all.min.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('user/css/slick.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('user/css/simple-line-icons.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ asset('user/css/style.css')}}" type="text/css" media="all">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')}}"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>
    <![endif]-->

</head>

<body>

<!-- preloader -->
<div id="preloader">
    <div class="book">
        <div class="inner">
            <div class="left"></div>
            <div class="middle"></div>
            <div class="right"></div>
        </div>
        <ul>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</div>

<!-- site wrapper -->
<div class="site-wrapper">

    <div class="main-overlay"></div>

    <!-- header -->
    <header class="header-default">
        <nav class="navbar navbar-expand-lg">
            <div class="container-xl">
                <!-- site logo -->
                <a class="navbar-brand" href="index.html"><img src="images/logo.svg" alt="logo" /></a>

                <div class="collapse navbar-collapse">
                    <!-- menus -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{url('users/home')}}">Beranda</a>
                        </li>
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle" href="">Profil</a>
                            <ul class="dropdown-menu">
                                @foreach($profileType as $key=>$profile)
                                <li><a class="dropdown-item" href="{{url('users/profile',$profile->id)}}">{{$profile->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="category.html">Layanan Publik</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#">Informasi Publik</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{url('users/umkm')}}">UMKM</a></li>
                                <li class="nav-item dropdown dropdown-item">
                                    <a class="nav-link dropdown-toggle" href="#">Informasi Publik</a>
                                    <ul class="dropdown-menu">
                                        @foreach($organization as $key=>$org)
                                        <li><a class="dropdown-item" href="{{url('users/organization',$org->id)}}">{{$org->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Contact</a>
                        </li>
                    </ul>
                </div>

                <!-- header right section -->
                <div class="header-right">
                    <!-- social icons -->
                    <ul class="social-icons list-unstyled list-inline mb-0">
                        <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                    <!-- header buttons -->
{{--                    <div class="header-buttons">--}}
{{--                        <button class="search icon-button">--}}
{{--                            <i class="icon-magnifier"></i>--}}
{{--                        </button>--}}
{{--                        <button class="burger-menu icon-button">--}}
{{--                            <span class="burger-icon"></span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
                </div>
            </div>
        </nav>
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

</div><!-- end site wrapper -->

<!-- search popup area -->
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

<!-- canvas menu -->
<div class="canvas-menu d-flex align-items-end flex-column">
    <!-- close button -->
    <button type="button" class="btn-close" aria-label="Close"></button>

    <!-- logo -->
    <div class="logo">
        <img src="images/logo.svg" alt="Katen" />
    </div>

    <!-- menu -->
    <nav>
        <ul class="vertical-menu">
            <li class="active"><a href="category.html">Beranda</a></li>
            <li>
                <a href="index.html">Profil</a>
                <ul class="submenu">
                    <li><a href="index.html">Sejarah Kelurahan</a></li>
                    <li><a href="personal.html">Visi Misi</a></li>
                    <li><a href="personal-alt.html">Struktur Organisasi</a></li>
                    <li><a href="minimal.html">Monografi</a></li>
                    <li><a href="classic.html">Prestasi</a></li>
                    <li><a href="classic.html">Sarana Pendidikan</a></li>
                </ul>
            </li>
            <li><a href="category.html">Layanan Publik</a></li>
            <li>
                <a href="#">Informasi Publik</a>
                <ul class="submenu">
                    <li><a href="category.html">UMKM</a></li>
                    <li><a href="blog-single.html">Organisasi</a></li>
                </ul>
            </li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
    </nav>

    <!-- social icons -->
    <ul class="social-icons list-unstyled list-inline mb-0 mt-auto w-100">
        <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
        <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
        <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
        <li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
    </ul>
</div>

<!-- JAVA SCRIPTS -->
<script src="{{asset('user/js/jquery.min.js')}}"></script>
<script src="{{asset('user/js/popper.min.js')}}"></script>
<script src="{{asset('user/js/bootstrap.min.js')}}"></script>
<script src="{{asset('user/js/slick.min.js')}}"></script>
<script src="{{asset('user/js/jquery.sticky-sidebar.min.js')}}"></script>
<script src="{{asset('user/js/custom.js')}}"></script>

</body>
</html>