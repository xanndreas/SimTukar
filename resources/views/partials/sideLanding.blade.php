<div class="col-lg-4">
    <!-- sidebar -->
    <div class="sidebar">
        <div class="widget rounded">
            <div class="widget-about data-bg-image text-center"
                 data-bg-image="{{asset('images/landing/map-bg.png')}}">
                <img src="{{asset('images/landing/simtukar.svg')}}" alt="logo" class="mb-4"/>
                <p class="mb-4">Sistem Informasi Tunjungsekar memberikan segala informasi mengenai Kelurahan Tunjungsekar,
                UMKM, Organisasi, dan </p>
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
                <h3 class="widget-title">Berita Populer</h3>
                <img src="{{asset('images/landing/wave.svg')}}" class="wave" alt="wave"/>
            </div>
            <div class="widget-content">
                <!-- post -->
                @foreach($popular as $item)
                    <div class="post post-list-sm circle">
                        <div class="thumb circle">
                            <span class="number">{{$item->views}}</span>
                            <a href="{{ route('landing.news.show', $item->slug) }}">
                                <div class="inner">
                                    <img src="{{ isset($item->photos[0]) ? $item->photos[0]->getUrl() : asset('images/landing/posts/tabs-1.jpg') }}"
                                         alt="post-title"/>
                                </div>
                            </a>
                        </div>
                        <div class="details clearfix">
                            <h6 class="post-title my-0"><a
                                        href="{{ route('landing.news.show', $item->slug) }}">{{substr($item->title, 0, 40) . '...'}}</a>
                            </h6>
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
                <h3 class="widget-title">Kategori</h3>
                <img src="{{asset('images/landing/wave.svg')}}" class="wave" alt="wave"/>
            </div>
            <div class="widget-content">
                <ul class="list">
                    @foreach($category as $value)
                        <li>
                            <a href="{{ route('landing.category.show', $value['slug']) }}">{{ $value['name'] }}</a><span>({{ $value['count'] }})</span>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
        <!-- widget tags -->
        <div class="widget rounded">
            <div class="widget-header text-center">
                <h3 class="widget-title">Tags</h3>
                <img src="{{asset('images/landing/wave.svg')}}" class="wave" alt="wave"/>
            </div>
            <div class="widget-content">
                @foreach($tags as $key => $tag)
                    <a href="{{ route('landing.tags.show', $tag['slug']) }}"
                       class="tag">#{{$tag->name}}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>