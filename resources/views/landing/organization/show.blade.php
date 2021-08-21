@extends('layouts.landing')

@section('content')
    <section class="single-cover data-bg-image" data-bg-image="{{isset($organization->photos[0]) ? $organization->photos[0]->getUrl() : asset('images/landing/posts/single-cover.jpg')}}">
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
                    <h1 class="title mt-0 mb-3">{{ $organization->name }}</h1>
                    <ul class="meta list-inline mb-0">
                        <li class="list-inline-item"><a href="javascript:void(0)"><img src="{{asset('images/landing/other/author-sm.png')}}" class="author" alt="author"/>Organisasi</a></li>
                        <li class="list-inline-item">{{ date('d M Y', strtotime($organization->created_at)) }}</li>
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
                            {!! $organization->description !!}

                            <div class="spacer" data-height="50"></div>

                        </div>
                    </div>
                </div>
                @include('partials/sideLanding')
            </div>
        </div>
    </section>
@endsection