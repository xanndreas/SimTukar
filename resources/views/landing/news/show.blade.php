@extends('layouts.landing')
@section('content')
    <!-- section main content -->
    <section class="main-content mt-3">
        <div class="container-xl">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @foreach($breadcrumb as $index => $value)
                        <li class="breadcrumb-item"><a href="{{ $value }}">{{ $index }}</a></li>
                    @endforeach
                </ol>
            </nav>
            <div class="row gy-4">
                <div class="col-lg-8">
                    <!-- post single -->
                    <div class="post post-single">
                        <!-- post header -->
                        <div class="post-header">
                            <h1 class="title mt-0 mb-3">{{ $news->title }}</h1>
                            <ul class="meta list-inline mb-0">
                                <li class="list-inline-item"><a href="javascript:void(0);"><img src="{{ asset('images/landing/other/author-sm.png') }}" class="author" alt="author"/> {{ $news->user->name }}</a></li>
                                <li class="list-inline-item"><a href="{{ route('landing.category.show', $news->category->slug) }}">{{ $news->category->name }}</a></li>
                                <li class="list-inline-item">{{ date('d M Y', strtotime($news->created_at) ) }}</li>
                            </ul>
                        </div>
                        <!-- featured image -->
                        <div class="featured-image">
                            <img src="{{ !$news->photos ? '' : $news->photos[0]->getUrl() }}" alt="post-title" />
                        </div>
                        <!-- post content -->
                        <div class="post-content clearfix">
                            {!! $news->content !!}
                        </div>
                        <!-- post bottom section -->
                        <div class="post-bottom">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-6 col-12 text-center text-md-start">
                                    @foreach($news->tags as $value)
                                        <a href="{{ route('landing.tags.show', $value->slug) }}" class="tag">#{{ $value->name }}</a>
                                    @endforeach
                                </div>
                                <div class="col-md-6 col-12">
                                    <!-- social icons -->
                                    <ul class="social-icons list-unstyled list-inline mb-0 float-md-end">
                                        <li class="list-inline-item"><a href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a></li>
                                        <li class="list-inline-item"><a href="javascript:void(0)"><i class="fab fa-twitter"></i></a></li>
                                        <li class="list-inline-item"><a href="javascript:void(0)"><i class="fab fa-telegram-plane"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="spacer" data-height="50"></div>

                    <!-- section header -->
                    <div class="section-header">
                        <h3 class="section-title">Comments ({{$comments->count()}})</h3>
                        <img src="{{ asset('images/landing/wave.svg') }}" class="wave" alt="wave" />
                    </div>
                    <div class="comments bordered padding-30 rounded">
                        <ul class="comments">
                            @foreach($comments as $value)
                            <li class="comment rounded">
                                <div class="thumb">
                                    <img src="{{ asset('images/landing/other/comment-1.png') }}" alt="John Doe" />
                                </div>
                                <div class="details">
                                    <h4 class="name"><a href="javascript:void(0)">{{ $value->name }}</a></h4>
                                    <span class="date">{{ date('d M Y h:m', strtotime($value->created_at)) }}</span>
                                    <p>{{ $value->content }}</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="spacer" data-height="50"></div>

                    <!-- section header -->
                    <div class="section-header">
                        <h3 class="section-title">Leave Comment</h3>
                        <img src="{{ asset('images/landing/wave.svg') }}" class="wave" alt="wave" />
                    </div>
                    <div class="comment-form rounded bordered padding-30">
                        <form id="comment-form" class="comment-form" method="post">
                            <div class="messages"></div>
                            <div class="row">
                                <div class="column col-md-12">
                                    <!-- Comment textarea -->
                                    <div class="form-group">
                                        <textarea name="InputComment" id="InputComment" class="form-control" rows="4" placeholder="Your comment here..." required="required"></textarea>
                                    </div>
                                </div>

                                <div class="column col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="InputEmail" name="InputEmail" placeholder="Email address" required="required">
                                    </div>
                                </div>

                                <div class="column col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="InputName" name="InputName" placeholder="Your name" required="required">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submit" id="submit" value="Submit" class="btn btn-default">Submit</button><!-- Submit Button -->
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- sidebar -->
                    <div class="sidebar">
                        <div class="widget rounded">
                            <div class="widget-about data-bg-image text-center" data-bg-image="{{asset('images/landing/map-bg.png')}}">
                                <img src="{{asset('images/landing/logo.svg')}}" alt="logo" class="mb-4" />
                                <p class="mb-4">Hello, We’re content writer who is fascinated by content fashion, celebrity and lifestyle. We helps clients bring the right content to the right people.</p>
                                <ul class="social-icons list-unstyled list-inline mb-0">
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- widget popular posts -->
                        <div class="widget rounded">
                            <div class="widget-header text-center">
                                <h3 class="widget-title">Popular Posts</h3>
                                <img src="{{asset('images/landing/wave.svg')}}" class="wave" alt="wave" />
                            </div>
                            <div class="widget-content">
                                <!-- post -->
                                @foreach($popular as $item)
                                    <div class="post post-list-sm circle">
                                        <div class="thumb circle">
                                            <span class="number">{{$item->views}}</span>
                                            <a href="{{ route('landing.news.show', $item->slug) }}">
                                                <div class="inner">
                                                    <img src="{{asset('images/landing/posts/tabs-1.jpg')}}" alt="post-title" />
                                                </div>
                                            </a>
                                        </div>
                                        <div class="details clearfix">
                                            <h6 class="post-title my-0"><a href="{{ route('landing.news.show', $item->slug) }}">{{substr($item->title, 0, 40) . '...'}}</a></h6>
                                            <ul class="meta list-inline mt-1 mb-0">
                                                <li class="list-inline-item">{{date('d M Y',strtotime($item->updated_at))}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- widget categories -->
                        <div class="widget rounded">
                            <div class="widget-header text-center">
                                <h3 class="widget-title">Category</h3>
                                <img src="{{asset('images/landing/wave.svg')}}" class="wave" alt="wave" />
                            </div>
                            <div class="widget-content">
                                <ul class="list">
                                    @foreach($category as $value)
                                        <li><a href="{{ route('landing.category.show', $value['slug']) }}">{{ $value['name'] }}</a><span>({{ $value['count'] }})</span></li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                        <!-- widget tags -->
                        <div class="widget rounded">
                            <div class="widget-header text-center">
                                <h3 class="widget-title">Tags</h3>
                                <img src="{{asset('images/landing/wave.svg')}}" class="wave" alt="wave" />
                            </div>
                            <div class="widget-content">
                                @foreach($tags as $key => $tag)
                                    <a href="{{ route('landing.tags.show', $tag['slug']) }}" class="tag">#{{$tag->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection