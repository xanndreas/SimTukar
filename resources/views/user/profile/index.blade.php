@extends('layouts.user')
@section('content')
    <section class="main-content mt-3">
        <div class="container-xl">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Profile</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$type[0]->name}}</li>
                </ol>
            </nav>

            <div class="row gy-4">

                <div class="col-lg-12">
                    @foreach($profile as $item)
                        <div class="post post-single">
                            <div class="post-header">
                                <h1 class="title mt-0 mb-3"> {{$type[0]->name}}</h1>
                                <h1 class="title mt-0 mb-3"> {{$item->name}}</h1>
                                <ul class="meta list-inline mb-0">
                                    @foreach($item->photos as $key => $media)
                                        <li class="list-inline-item"><a href="#"><img src="{{ $media->getUrl('thumb') }}" class="author" alt="author"/>{{$item->title}}</a></li>
                                    @endforeach
                                    <li class="list-inline-item">{{$item->created_at}}</li>
                                </ul>
                            </div>
                            <!-- post content -->
                            <div class="post-content clearfix">
                                {!!$item->description!!}
                            </div>
                            <!-- post bottom section -->
                        </div>
                        <div class="spacer" data-height="50"></div>
                @endforeach
                    <div class="spacer" data-height="50"></div>
                </div>
            </div>
        </div>
    </section>
@endsection