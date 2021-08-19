@extends('layouts.landing')
@section('content')
    <section class="single-cover data-bg-image" data-bg-image="{{isset($umkm->photos[0]) ? $umkm->photos[0]->getUrl() : 'images/landing/posts/single-cover.jpg'}}">
        <div class="container-xl">
            <div class="cover-content post">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @foreach($breadcrumb as $index => $value)
                            <li class="breadcrumb-item"><a href="{{ $value }}">{{ $index }}</a></li>
                        @endforeach
                    </ol>
                </nav>
                <!-- post header -->
                <div class="post-header">
                    <h1 class="title mt-0 mb-3">{{ $umkm->name }}</h1>
                    <ul class="meta list-inline mb-0">
                        <li class="list-inline-item"><a href="javascript:void(0)"><img src="{{asset('images/landing/other/author-sm.png')}}" class="author" alt="author"/>Wirausaha</a></li>
                        <li class="list-inline-item">{{ date('d M Y', strtotime($umkm->created_at)) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="main-content">
        <div class="container-xl">

            <div class="row gy-4">

                <div class="col-lg-8">
                    <!-- post single -->
                    <div class="post post-single">
                        <!-- post content -->
                        <div class="post-content clearfix">
                            {!! $umkm->description !!}
                        </div>
                        <!-- post bottom section -->
                        <div class="post-bottom">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-6 col-12">
                                    <!-- social icons -->
                                    <ul class="social-icons list-unstyled list-inline mb-0 float-md-end">
                                        <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                @include('partials/sideLanding')
            </div>
        </div>
    </section>
@endsection