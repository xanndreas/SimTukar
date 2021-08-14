@extends('layouts.user')
@section('content')
    <section class="main-content mt-3">
        <div class="container-xl">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Informasi Publik</a></li>
                    <li class="breadcrumb-item active" aria-current="page">UMKM</li>
                </ol>
            </nav>

            <div class="row gy-4">

                <div class="col-lg-12">
                    @foreach($umkm as $item)
                        <div class="post post-classic rounded bordered">
                            <div class="thumb top-rounded">
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
                                <h5 class="post-title mb-3 mt-3"><a href="blog-single.html">{{$item->name}}</a></h5>
                                <?php
                                $string = strip_tags($item->description);
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
                                    <a href="{{url('/users/umkm-detail')}}" class="more-link">Show<i class="icon-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="spacer" data-height="50"></div>
                </div>
            </div>
        </div>
    </section>
@endsection