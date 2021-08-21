@extends('layouts.landing')

@section('styles')
    <style>
        .map-responsive{
            overflow:hidden;
            padding-bottom:56.25%;
            position:relative;
            height:0;
        }
        .map-responsive iframe{
            left:0;
            top:0;
            height:100%;
            width:100%;
            position:absolute;
        }
    </style>
@endsection

@section('content')
    <section class="page-header">
        <div class="container-xl">
            <div class="text-center">
                <h1 class="mt-0 mb-2">Kontak</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Kontak</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- section main content -->
    <section class="main-content">
        <div class="container-xl">

            <div class="row">
                <div class="col-md-4">
                    <!-- contact info item -->
                    <div class="contact-item bordered rounded d-flex align-items-center">
                        <span class="icon icon-phone"></span>
                        <div class="details">
                            <h3 class="mb-0 mt-0">Phone</h3>
                            <p class="mb-0">497111</p>
                        </div>
                    </div>
                    <div class="spacer d-md-none d-lg-none" data-height="30"></div>
                </div>
                <div class="col-md-4">
                    <!-- contact info item -->
                    <div class="contact-item bordered rounded d-flex align-items-center">
                        <span class="icon icon-envelope-open"></span>
                        <div class="details">
                            <h3 class="mb-0 mt-0">E-Mail</h3>
                            <p class="mb-0">hello@example.com</p>
                        </div>
                    </div>
                    <div class="spacer d-md-none d-lg-none" data-height="30"></div>
                </div>
                <div class="col-md-4">
                    <!-- contact info item -->
                    <div class="contact-item bordered rounded d-flex align-items-center">
                        <span class="icon icon-map"></span>
                        <div class="details">
                            <h3 class="mb-0 mt-0">Location</h3>
                            <p class="mb-0">Jalan Piranha Atas No. 206 </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="spacer" data-height="50"></div>

            <div class="map-responsive">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.6485904630604!2d112.6359873149161!3d-7.931721481182608!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd629ede76f6f71%3A0xe2abdb263bb16bd1!2sKantor%20Kelurahan%20Tunjungsekar!5e0!3m2!1sen!2sid!4v1629431883857!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>

            <div class="spacer" data-height="50"></div>

            <!-- section header -->
            <div class="section-header">
                <h3 class="section-title">Jadwal Layanan</h3>
                <img src="{{asset('images/landing/wave.svg')}}" class="wave" alt="wave" />
            </div>

            <img src="{{ asset('images/landing/layanan/layanan.png')}}" class="author" alt="author"/>


            <!-- Contact Form end -->
        </div>
    </section>

    <!-- instagram feed -->
    <div class="instagram">
        <div class="container-xl">
            <!-- button -->
            <a href="#" class="btn btn-default btn-instagram">@Katen on Instagram</a>
            <!-- images -->
            <div class="instagram-feed d-flex flex-wrap">
                <div class="insta-item col-sm-2 col-6 col-md-2">
                    <a href="#">
                        <img src="{{asset('images/landing/insta/insta-1.jpg')}}" alt="insta-title" />
                    </a>
                </div>
                <div class="insta-item col-sm-2 col-6 col-md-2">
                    <a href="#">
                        <img src="{{asset('images/landing/insta/insta-2.jpg')}}" alt="insta-title" />
                    </a>
                </div>
                <div class="insta-item col-sm-2 col-6 col-md-2">
                    <a href="#">
                        <img src="{{asset('images/landing/insta/insta-3.jpg')}}" alt="insta-title" />
                    </a>
                </div>
                <div class="insta-item col-sm-2 col-6 col-md-2">
                    <a href="#">
                        <img src="{{asset('images/landing/insta/insta-4.jpg')}}" alt="insta-title" />
                    </a>
                </div>
                <div class="insta-item col-sm-2 col-6 col-md-2">
                    <a href="#">
                        <img src="{{asset('images/landing/insta/insta-5.jpg')}}" alt="insta-title" />
                    </a>
                </div>
                <div class="insta-item col-sm-2 col-6 col-md-2">
                    <a href="#">
                        <img src="{{asset('images/landing/insta/insta-6.jpg')}}" alt="insta-title" />
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection