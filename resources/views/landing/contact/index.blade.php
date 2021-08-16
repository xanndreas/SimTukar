@extends('layouts.user')
@section('content')
    <section class="main-content mt-3">
        <div class="container-xl">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Informasi Publik</a></li>
                    <li class="breadcrumb-item"><a href="#">UMKM</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>

            <div class="row gy-4">

                <div class="col-lg-12">
                    <div class="post post-single">
                        <div class="post-header" style="text-align: center">
                            <h1 class="title mt-0 mb-3"> Layanan Publik</h1>
                            <img src="{{ asset('user/images/layanan/layanan.png')}}" class="author" alt="author"/>
                        </div>
                        <!-- post content -->
                        <div class="post-content clearfix">

                        </div>
                        <div class="details">
                            <h4 class="name"><a href="#">Contact</a></h4>
                            <p>099888999888</p>
                        </div>
                        <!-- post bottom section -->
                    </div>
                    <div class="spacer" data-height="50"></div>
                    <div class="mapouter">
                        <div class="gmap_canvas">
                            <iframe width="1080" height="500" id="gmap_canvas"
                                    src="https://maps.google.com/maps?q=Jalan%20Piranha%20Atas%20No.%20206%20kota%20malang&t=&z=17&ie=UTF8&iwloc=&output=embed"
                                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                            <a href="https://getasearch.com">getasearch.com</a><br>
                            <style>.mapouter {
                                    position: relative;
                                    text-align: right;
                                    height: 500px;
                                    width: 1080px;
                                }</style>
                            <a href="https://www.embedgooglemap.net">google maps on web site</a>
                            <style>.gmap_canvas {
                                    overflow: hidden;
                                    background: none !important;
                                    height: 500px;
                                    width: 1080px;
                                }</style>
                        </div>
                    </div>
                    <div class="spacer" data-height="50"></div>
                </div>
            </div>
        </div>
    </section>
@endsection