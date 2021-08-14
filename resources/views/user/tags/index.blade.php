@extends('layouts.user')
@section('content')
    <!-- section main content -->
    <section class="main-content">
        <div class="container-xl">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">News</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tags</li>
                </ol>
            </nav>
            <div class="row gy-4">
                <div class="col-lg-8">
                    @foreach($news as $item)
                        <div class="post post-classic rounded bordered">
                            <div class="thumb top-rounded">
                                @foreach($item->tags as $key => $tag)
                                    <a href="category.html" class="category-badge lg position-absolute">{{$tag->name}}</a>
                                @endforeach
                                <a href="blog-single.html">
                                    <div class="inner">
                                        <img src="images/posts/post-lg-2.jpg" alt="post-title" />
                                    </div>
                                </a>
                            </div>
                            <div class="details">
                                <ul class="meta list-inline mb-0">
                                    <li class="list-inline-item"><a href="#"><img src="images/other/author-sm.png" class="author" alt="author"/>Katen Doe</a></li>
                                    <li class="list-inline-item">{{date('Y-m-d',strtotime($item->updated_at))}}</li>
                                    <li class="list-inline-item"><i class="icon-bubble"></i> (0)</li>
                                </ul>
                                <h5 class="post-title mb-3 mt-3"><a href="{{url('/users/show',$item->id)}}">{{$item->title}}</a></h5>
                                <?php
                                $string = strip_tags($item->content);
                                if (strlen($string) > 200) {

                                    // truncate string
                                    $stringCut = substr($string, 0, 200);
                                    $endPoint = strrpos($stringCut, ' ');

                                    //if the string doesn't contain any space then it will cut without word basis.
                                    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                }
                                ?>
                                {!!$string!!}...
                            </div>
                            <div class="post-bottom clearfix d-flex align-items-center">

                                <div class="float-end d-none d-md-block">
                                    <a href="{{url('/users/show',$item->id)}}" class="more-link">Continue reading<i class="icon-arrow-right"></i></a>
                                </div>
                                <div class="more-button d-block d-md-none float-end">
                                    <a href="#"><span class="icon-options"></span></a>
                                </div>
                            </div>
                        </div>
                    @endforeach

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
                <div class="col-lg-4">
                    <!-- sidebar -->
                    <div class="sidebar">
                        <!-- widget popular posts -->
                        <div class="widget rounded">
                            <div class="widget-header text-center">
                                <h3 class="widget-title">Popular Posts</h3>
                                <img src="images/wave.svg" class="wave" alt="wave" />
                            </div>
                            <div class="widget-content">
                                <!-- post -->
                                @foreach($popular as $item)
                                    <div class="post post-list-sm circle">
                                        <div class="thumb circle">
                                            <span class="number">{{$item->views}}</span>
                                            <a href="{{url('/users/show',$item->id)}}">
                                                <div class="inner">
                                                    <img src="images/posts/tabs-1.jpg" alt="post-title" />
                                                </div>
                                            </a>
                                        </div>
                                        <div class="details clearfix">
                                            <h6 class="post-title my-0"><a href="{{url('/users/show',$item->id)}}">{{$item->title}}</a></h6>
                                            <ul class="meta list-inline mt-1 mb-0">
                                                <li class="list-inline-item">{{date('Y-m-d',strtotime($item->updated_at))}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- widget tags -->
                        <div class="widget rounded">
                            <div class="widget-header text-center">
                                <h3 class="widget-title">Tags</h3>
                                <img src="images/wave.svg" class="wave" alt="wave" />
                            </div>
                            <div class="widget-content">
                                @foreach($tags as $key => $tag)
                                    <a href="#" class="tag">#{{$tag->name}}</a>
                                @endforeach
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>
@endsection