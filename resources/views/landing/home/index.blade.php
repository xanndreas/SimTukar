@extends('layouts.landing')
@section('content')
    <!-- hero section -->
    <section id="hero">
        <div class="container-xl">
            <div class="row gy-4">
                @if($top1news)
                    <div class="col-lg-8">
                        <!-- featured post large -->
                        <div class="post featured-post-lg">
                            <div class="details clearfix">
                                <a href="{{ route('landing.category.show', $top1news->category->slug) }}"
                                   class="category-badge">{{ $top1news->category->name }}</a>
                                <h2 class="post-title">
                                    <a href="{{ route('landing.news.show', $top1news->slug) }}">{{substr($top1news->title, 0, 40) . '...'}}</a>
                                </h2>
                                <ul class="meta list-inline mb-0">
                                    <li class="list-inline-item"><a
                                                href="javascript:void(0);">{{ $top1news->user->name }}</a></li>
                                    <li class="list-inline-item">{{ date('d M Y', strtotime($top1news->created_at)) }}</li>
                                </ul>
                            </div>
                            <a href="{{ route('landing.news.show', $top1news->slug) }}">
                                <div class="thumb rounded">
                                    <div class="inner data-bg-image"
                                         data-bg-image="{{ isset($top1news->photos[0]) ? $top1news->photos[0]->getUrl() : asset('images/landing/posts/featured-lg.jpg') }}"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
                <div class="col-lg-4">
                    <!-- post tabs -->
                    <div class="post-tabs rounded bordered">
                        <!-- tab navs -->
                        <ul class="nav nav-tabs nav-pills nav-fill" id="postsTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button aria-controls="popular" aria-selected="true" class="nav-link active"
                                        data-bs-target="#popular" data-bs-toggle="tab" id="popular-tab" role="tab"
                                        type="button">Populer
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button aria-controls="recent" aria-selected="false" class="nav-link"
                                        data-bs-target="#recent" data-bs-toggle="tab" id="recent-tab" role="tab"
                                        type="button">Terbaru
                                </button>
                            </li>
                        </ul>
                        <!-- tab contents -->
                        <div class="tab-content" id="postsTabContent">
                            <div class="lds-dual-ring"></div>
                            <div aria-labelledby="popular-tab" class="tab-pane fade show active" id="popular"
                                 role="tabpanel">
                                @if($popular->first())
                                    @foreach($popular as $item)
                                        <div class="post post-list-sm circle">
                                            <div class="thumb circle">
                                                <a href="{{ route('landing.news.show', $item->slug) }}">
                                                    <div class="inner">
                                                        <img src="{{ isset($item->photos[0]) ? $item->photos[0]->getUrl() : asset('images/landing/posts/tabs-1.jpg') }}"
                                                             alt="post-title"/>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="details clearfix">
                                                <h6 class="post-title my-0">
                                                    <a href="{{ route('landing.news.show', $item->slug) }}">
                                                        {{substr($item->title, 0, 40) . '...'}}
                                                    </a>
                                                </h6>
                                                <ul class="meta list-inline mt-1 mb-0">
                                                    <li class="list-inline-item">{{ date('d M Y', strtotime($item->created_at)) }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <!-- recent posts -->
                            <div aria-labelledby="recent-tab" class="tab-pane fade" id="recent" role="tabpanel">
                                <!-- post -->
                                @if($recent->first())
                                    @foreach($recent as $item)
                                        <div class="post post-list-sm circle">
                                            <div class="thumb circle">
                                                <a href="{{ route('landing.news.show', $item->slug) }}">
                                                    <div class="inner">
                                                        <img src="{{ isset($item->photos[0]) ? $item->photos[0]->getUrl() : asset('images/landing/posts/tabs-2.jpg') }}"
                                                             alt="post-title"/>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="details clearfix">
                                                <h6 class="post-title my-0">
                                                    <a href="{{ route('landing.news.show', $item->slug) }}">
                                                        {{substr($item->title, 0, 40) . '...'}}
                                                    </a>
                                                </h6>
                                                <ul class="meta list-inline mt-1 mb-0">
                                                    <li class="list-inline-item">{{ date('d M Y', strtotime($item->created_at)) }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- section main content -->
    <section class="main-content">
        <div class="container-xl">
            <div class="row gy-4">
                <div class="col-lg-8">
                    <!-- section header -->
                    <div class="section-header">
                        <h3 class="section-title">Minggu Ini</h3>
                        <img src="{{asset('images/landing/wave.svg')}}" class="wave" alt="wave"/>
                    </div>
                    <div class="padding-30 rounded bordered">
                        <div class="row gy-5">
                            @if($weeks->first())
                                <div class="col-sm-6">
                                    <!-- post -->
                                    <div class="post">
                                        <div class="thumb rounded">
                                            <a href="{{ route('landing.category.show', $weeks[0]->category->slug) }}"
                                               class="category-badge position-absolute">{{ $weeks[0]->category->name }}
                                            </a>

                                            <span class="post-format">
											    <i class="icon-picture"></i>
                                            </span>

                                            <a href="{{ route('landing.news.show', $weeks[0]->slug) }}">
                                                <div class="inner">
                                                    <img src="{{isset($weeks[0]->photos[0]) ? $weeks[0]->photos[0]->getUrl() : asset('images/landing/posts/editor-lg.jpg')}}"
                                                         alt="post-title"/>
                                                </div>
                                            </a>
                                        </div>
                                        <ul class="meta list-inline mt-4 mb-0">
                                            <li class="list-inline-item"><a href="#">
                                                    <img src="{{asset('images/landing/other/author-sm.png')}}"
                                                         class="author" alt="author"/>{{ $weeks[0]->user->name }}</a>
                                            </li>
                                            <li class="list-inline-item">{{ date('d M Y', strtotime($weeks[0]->created_at)) }}</li>
                                        </ul>
                                        <h5 class="post-title mb-3 mt-3">
                                            <a href="{{ route('landing.news.show', $weeks[0]->slug) }}">
                                                {{substr($weeks[0]->title, 0, 40) . '...'}}
                                            </a></h5>
                                        <p class="excerpt mb-0">
                                            {!! $weeks[0]->content !!}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <!-- post -->
                                    @foreach($weeks as $index => $item)
                                        @if($index > 0)
                                            <div class="post post-list-sm square">
                                                <div class="thumb rounded">
                                                    <a href="{{ route('landing.news.show', $item->slug) }}">
                                                        <div class="inner">
                                                            <img src="{{isset($item->photos[0]) ? $item->photos[0]->getUrl() : asset('images/landing/posts/editor-lg.jpg')}}"
                                                                 alt="post-title"/>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="details clearfix">
                                                    <h6 class="post-title my-0">
                                                        <a href="{{ route('landing.news.show', $item->slug) }}">
                                                            {{substr($item->title, 0, 40) . '...'}}
                                                        </a></h6>
                                                    <ul class="meta list-inline mt-1 mb-0">
                                                        <li class="list-inline-item">{{ date('d M Y', strtotime($item->created_at)) }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                    @endif
                                @endforeach
                                <!-- post -->

                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="spacer" data-height="50"></div>

                    <div class="ads-horizontal text-md-center">
                        <span class="ads-title">- Sponsored Ad -</span>
                        <a href="#">
                            <img src="{{ asset('images/landing/ads/ad-750.png')}}" alt="Advertisement"/>
                        </a>
                    </div>

                    <div class="spacer" data-height="50"></div>

                    <!-- section header -->
                    <div class="section-header">
                        <h3 class="section-title">Trending</h3>
                        <img src="{{asset('images/landing/wave.svg')}}" class="wave" alt="wave"/>
                        <div class="slick-arrows-top">
                            <button type="button" data-role="none" class="carousel-topNav-prev slick-custom-buttons"
                                    aria-label="Previous"><i class="icon-arrow-left"></i></button>
                            <button type="button" data-role="none" class="carousel-topNav-next slick-custom-buttons"
                                    aria-label="Next"><i class="icon-arrow-right"></i></button>
                        </div>
                    </div>

                    <div class="row post-carousel-twoCol post-carousel">
                        <!-- post -->
                        @if($topnews->first())
                            @foreach($topnews as $item)
                                <div class="post post-over-content col-md-6">
                                    <div class="details clearfix">
                                        <a href="{{ route('landing.category.show', $item->category->slug) }}" class="category-badge">{{ $item->category->name }}</a>
                                        <h4 class="post-title">
                                            <a href="{{ route('landing.news.show', $item->slug) }}">
                                                {{substr($item->title, 0, 40) . '...'}}
                                            </a></h4>
                                        <ul class="meta list-inline mb-0">
                                            <li class="list-inline-item"><a href="javascript:void(0);">{{ $item->user->name }}</a></li>
                                            <li class="list-inline-item">{{ date('d M Y', strtotime($item->created_at)) }}</li>
                                        </ul>
                                    </div>
                                    <a href="{{ route('landing.news.show', $item->slug) }}">
                                        <div class="thumb rounded">
                                            <div class="inner">
                                                <img src="{{isset($item->photos[0]) ? $item->photos[0]->getUrl() : asset('images/landing/posts/inspiration-1.jpg')}}" alt="thumb"/>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="spacer" data-height="50"></div>

                    <!-- section header -->
                    <div class="section-header">
                        <h3 class="section-title">Latest Posts</h3>
                        <img src="{{asset('images/landing/wave.svg')}}" class="wave" alt="wave"/>
                    </div>

                    <div class="padding-30 rounded bordered">
                        <div class="row">
                            @if($recent->first())
                                @foreach($recent as $item)
                                    <div class="col-md-12 col-sm-6">
                                        <div class="post post-list clearfix">
                                            <div class="thumb rounded">
                                                <span class="post-format-sm">
                                                    <i class="icon-picture"></i>
                                                </span>
                                                <a href="{{ route('landing.news.show', $item->slug) }}">
                                                    <div class="inner">
                                                        <img src="{{isset($item->photos[0]) ? $item->photos[0]->getUrl() : asset('images/landing/posts/latest-sm-1.jpg')}}" alt="post-title"/>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="details">
                                                <ul class="meta list-inline mb-3">
                                                    <li class="list-inline-item"><a href="javascript:void(0);"><img
                                                                    src="{{asset('images/landing/other/author-sm.png')}}" class="author"
                                                                    alt="author"/>{{ $item->user->name }}</a></li>
                                                    <li class="list-inline-item"><a href="{{ route('landing.category.show', $item->category->slug) }}">{{ $item->category->name }}</a></li>
                                                    <li class="list-inline-item">{{ date('d M Y', strtotime($item->created_at)) }}</li>
                                                </ul>
                                                <h5 class="post-title"><a href="{{ route('landing.news.show', $item->slug) }}">{{substr($item->title, 0, 40) . '...'}}</a></h5>
                                                <p class="excerpt mb-0">{!! substr($item->content, 0, 80) . '...'!!}</p>
                                                <div class="post-bottom clearfix d-flex align-items-center">
                                                    <div class="social-share me-auto">
                                                        <button class="toggle-button icon-share"></button>
                                                        <ul class="icons list-unstyled list-inline mb-0">
                                                            <li class="list-inline-item"><a href="#"><i
                                                                            class="fab fa-facebook-f"></i></a></li>
                                                            <li class="list-inline-item"><a href="#"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="more-button float-end">
                                                        <a href="{{ date('d M Y', strtotime($item->created_at)) }}"><span class="icon-options"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <!-- load more button -->
                        <div class="text-center">
                            <button class="btn btn-simple">Load More</button>
                        </div>
                    </div>
                </div>
                @include('partials/sideLanding')
            </div>
        </div>
    </section>
@endsection