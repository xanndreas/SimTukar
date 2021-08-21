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
                                <li class="list-inline-item"><a href="javascript:void(0);"><img
                                                src="{{ asset('images/landing/other/author-sm.png') }}" class="author"
                                                alt="author"/> {{ $news->user->name }}</a></li>
                                <li class="list-inline-item"><a
                                            href="{{ route('landing.category.show', $news->category->slug) }}">{{ $news->category->name }}</a>
                                </li>
                                <li class="list-inline-item">{{ date('d M Y', strtotime($news->created_at) ) }}</li>
                            </ul>
                        </div>
                        <!-- featured image -->
                        <div class="featured-image">
                            <img src="{{ isset($news->photos[0]) ? $news->photos[0]->getUrl() : asset('images/landing/posts/featured-md-3.jpg') }}" alt="post-title"/>
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
                                        <a href="{{ route('landing.tags.show', $value->slug) }}"
                                           class="tag">#{{ $value->name }}</a>
                                    @endforeach
                                </div>
                                <div class="col-md-6 col-12">
                                    <!-- social icons -->
                                    <ul class="social-icons list-unstyled list-inline mb-0 float-md-end">
                                        <li class="list-inline-item"><a href="javascript:void(0)"><i
                                                        class="fab fa-facebook-f"></i></a></li>
                                        <li class="list-inline-item"><a href="javascript:void(0)"><i
                                                        class="fab fa-twitter"></i></a></li>
                                        <li class="list-inline-item"><a href="javascript:void(0)"><i
                                                        class="fab fa-telegram-plane"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="spacer" data-height="50"></div>

                    <!-- section header -->
                    <div class="section-header">
                        <h3 class="section-title">Comments ({{$comments->count()}})</h3>
                        <img src="{{ asset('images/landing/wave.svg') }}" class="wave" alt="wave"/>
                    </div>
                    @csrf
                    <div class="messages"></div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('failed'))
                        <div class="alert alert-danger">
                            {{ session('failed') }}
                        </div>
                    @endif
                    <div class="comments bordered padding-30 rounded">
                        <ul class="comments">
                            @foreach($comments as $value)
                                <li class="comment rounded">
                                    <div class="thumb">
                                        <img src="{{ asset('images/landing/other/comment-1.png') }}" alt="John Doe"/>
                                    </div>
                                    <div class="details">
                                        <h4 class="name"><a href="javascript:void(0)">{{ $value->name }}</a></h4>
                                        <span class="date">{{ date('d M Y h:m', strtotime($value->created_at)) }}</span>
                                        <p>{{ $value->content }}</p>
                                        <a data-toggle="modal" id="modal-report" data-target="#reportModal"
                                           data-id="{{$value->id}}" class="btn btn-simple">Report</a>
                                    </div>

                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog"
                         aria-labelledby="reportModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Report Comment</h5>
                                </div>
                                <form class="report-form" action="{{ route("landing.news.update", [$value->id]) }}"
                                      method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="modal-body">
                                        <input type="text" name="id" id="id">
                                        <input type="hidden" name="report_count" id="report_count">
                                        {!! htmlFormSnippet() !!}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-default btn-sm">Report</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="spacer" data-height="50"></div>

                    <!-- section header -->
                    <div class="section-header">
                        <h3 class="section-title">Leave Comment</h3>
                        <img src="{{ asset('images/landing/wave.svg') }}" class="wave" alt="wave"/>
                    </div>
                    <div class="comment-form rounded bordered padding-30">
                        @csrf
                        <div class="messages"></div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('failed'))
                            <div class="alert alert-danger">
                                {{ session('failed') }}
                            </div>
                        @endif
                        <form id="comment-form" action="{{ route("landing.news.store") }}" class="comment-form"
                              method="post">
                            <div class="row">
                                <div class="column col-md-12">
                                    <!-- Comment textarea -->
                                    <div class="form-group">
                                        <textarea name="content" id="content" class="form-control" rows="4"
                                                  placeholder="Your comment here..." required="required"></textarea>
                                    </div>
                                </div>

                                <div class="column col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email"
                                               placeholder="Email address" required="required">
                                    </div>
                                </div>

                                <div class="column col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Your name" required="required">
                                    </div>
                                </div>

                                <div class="column col-md-12">
                                    <div class="form-group">
                                        {!! htmlFormSnippet() !!}
                                        <input type="text" class="form-control" id="berita_id" name="berita_id"
                                               value="{{$news->id}}" hidden>
                                        <input type="text" class="form-control" id="slug" name="slug" value="{{$slug}}"
                                               hidden>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submit" id="submit" value="Submit" class="btn btn-default">
                                Submit
                            </button><!-- Submit Button -->
                        </form>
                    </div>
                </div>

                @include('partials/sideLanding')
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#modal-report').on("click", function () {
                var id = $(this).attr('data-id');
                console.log(id)
                {{--$.ajax({--}}
                {{--    url: "{{ route("landing.news.edit") }}?id="+id,--}}
                {{--    type: "GET",--}}
                {{--    dataType: "JSON",--}}
                {{--    success: function (data) {--}}
                {{--        $('.id').val(data.id);--}}
                {{--        $('.content').val(data.content);--}}
                {{--        $('.report_count').val(data.report_count + 1)--}}
                {{--    }--}}
                {{--});--}}
            });

        });
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@endsection
