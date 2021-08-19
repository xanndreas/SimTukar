 @extends('layouts.landing')
@section('content')

    <!-- page header -->
    <section class="page-header">
        <div class="container-xl">
            <div class="text-center">
                <h1 class="mt-0 mb-2">Tentang</h1>
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
                    <div class="page-content bordered rounded padding-30">
                        <img src="{{ isset($about->photos[0]) ? $about->photos[0]->getUrl() : asset('images/landing/other/about.jpg') }}" alt="John Doe" class="rounded mb-4" />

                        {!! isset($about->description) ? $about->description : '' !!}

                        <hr class="my-4" />
                        <ul class="social-icons list-unstyled list-inline mb-0">
                            <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
                @include('partials/sideLanding')
            </div>
        </div>
    </section>
@endsection