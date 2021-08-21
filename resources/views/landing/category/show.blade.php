@extends('layouts.landing')
@section('content')
    <section class="page-header">
        <div class="container-xl">
            <div class="text-center">
                <h1 class="mt-0 mb-2">{{ $title }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        @foreach($breadcrumb as $index => $value)
                            <li class="breadcrumb-item"><a href="{{ $value }}">{{ $index }}</a></li>
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- section main content -->
    <section class="main-content">
        <div class="container-xl">
            <div class="row gy-4">
                <div class="col-lg-8">
                    <div class="row gy-4">
                        @foreach($news as $item)
                        @if($item->category->slug == $slug)
                        <div class="col-sm-6">
                            <!-- post -->
                            <div class="post post-grid rounded bordered">
                                <div class="thumb top-rounded">
                                    <a href="{{ route('landing.category.show', $item->category->slug) }}" class="category-badge position-absolute">{{ $item->category->name }}</a>
                                    <span class="post-format">
                                        <i class="icon-picture"></i>
                                    </span>
                                    <a href="{{ route('landing.news.show', $item->slug) }}">
                                        <div class="inner">
                                            <img src="{{ isset($item->photos[0]) ? $item->photos[0]->getUrl() : asset('images/landing/posts/post-md-1.jpg') }}" alt="post-title" />
                                        </div>
                                    </a>
                                </div>
                                <div class="details">
                                    <ul class="meta list-inline mb-0">
                                        <li class="list-inline-item"><a href="javascript:void(0);"><img src="{{asset('images/landing/other/author-sm.png')}}" class="author" alt="author"/>{{ $item->user->name }}</a></li>
                                        <li class="list-inline-item">{{ date('d M Y', strtotime($item->created_at)) }}</li>
                                    </ul>
                                    <h5 class="post-title mb-3 mt-3"><a href="{{ route('landing.news.show', $item->slug) }}">{{substr($item->title, 0, 40) . '...'}}</a></h5>
                                    <p class="excerpt mb-0">{!! substr($item->content, 0, 80) . '...'!!}</p>
                                </div>
                                <div class="post-bottom clearfix d-flex align-items-center">
                                    <div class="social-share me-auto">
                                        <button class="toggle-button icon-share"></button>
                                        <ul class="icons list-unstyled list-inline mb-0">
                                            <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="more-button float-end">
                                        <a href="{{ route('landing.news.show', $item->slug) }}"><span class="icon-options"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endif
                        @endforeach
                    </div>
                    <nav>
                        <ul class="pagination justify-content-center">
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">1</span>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                        </ul>
                    </nav>
                </div>
                @include('partials/sideLanding')
            </div>
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