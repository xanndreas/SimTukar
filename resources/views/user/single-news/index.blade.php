@extends('layouts.user')
@section('content')
<section class="main-content mt-3">
    <div class="container-xl">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">News</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$newsPage[0]['title']}}</li>
            </ol>
        </nav>

        <div class="row gy-4">

            <div class="col-lg-8">
                @foreach($newsPage as $item)
                <div class="post post-single">
                    <div class="post-header">
                        <h1 class="title mt-0 mb-3"> {{$item->title}}</h1>
                        <ul class="meta list-inline mb-0">
                            @foreach($item->photos as $key => $media)
                                <li class="list-inline-item"><a href="#"><img src="{{ $media->getUrl('thumb') }}" class="author" alt="author"/>{{$item->title}}</a></li>
                            @endforeach
                            <li class="list-inline-item"><a href="#">Trending</a></li>
                            <li class="list-inline-item">{{$item->created_at}}</li>
                        </ul>
                    </div>
                    <!-- featured image -->
                    <div class="featured-image">
                        @foreach($item->photos as $key => $media)
                            <img src="{{ $media->getUrl('thumb') }}" alt="post-title" />
                        @endforeach
                    </div>
                    <!-- post content -->
                    <div class="post-content clearfix">
                        {!!$item->content!!}
                    </div>
                    <!-- post bottom section -->
                    <div class="post-bottom">
                        <div class="row d-flex align-items-center">
                            <div class="col-md-6 col-12 text-center text-md-start">
                                @foreach($item->tags as $key => $tag)
                                <a href="#" class="tag">{{$tag->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="spacer" data-height="50"></div>
            @endforeach
                <!-- section header -->
                <div class="section-header">
                    <h3 class="section-title">Comments</h3>
                    <img src="images/wave.svg" class="wave" alt="wave" />
                </div>
                <!-- post comments -->
                <div class="comments bordered padding-30 rounded">
                    <ul class="comments">
                        @foreach($comments as $comment)
                        <li class="comment rounded">
                            <div class="details">
                                <h4 class="name"><a href="#">{{$comment->user->name}}</a></h4>
                                <span class="date">{{$comment->created_at}}</span>
                                <p>{{$comment->content}}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="spacer" data-height="50"></div>

                <!-- section header -->
                <div class="section-header">
                    <h3 class="section-title">Leave Comment</h3>
                    <img src="images/wave.svg" class="wave" alt="wave" />
                </div>
                <!-- comment form -->
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
                                <!-- Email input -->
                                <div class="form-group">
                                    <input type="email" class="form-control" id="InputEmail" name="InputEmail" placeholder="Email address" required="required">
                                </div>
                            </div>

                            <div class="column col-md-6">
                                <!-- Name input -->
                                <div class="form-group">
                                    <input type="text" class="form-control" name="InputWeb" id="InputWeb" placeholder="Website" required="required">
                                </div>
                            </div>

                            <div class="column col-md-12">
                                <!-- Email input -->
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
                    <!-- widget tags -->
                    <div class="widget rounded">
                        <div class="widget-header text-center">
                            <h3 class="widget-title">Explore Tags</h3>
                            <img src="images/wave.svg" class="wave" alt="wave" />
                        </div>
                        <div class="widget-content">
                            <ul class="list">
                                @foreach($tags as $key => $tag)
                                <li><a href="#">{{$tag->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</section>
@endsection