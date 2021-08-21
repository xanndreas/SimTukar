<nav class="navbar navbar-expand-lg">
    <div class="container-xl">
        <a class="navbar-brand" href="{{ route('landing.home.index') }}"><img src="{{asset('images/landing/simtukar.svg')}}" alt="logo"/></a>

        <div class="collapse navbar-collapse">
            <!-- menus -->
            <ul class="navbar-nav mr-auto">
                @php
                    $menu = trans('menu');
                @endphp
                @if(isset($menu))
                    @foreach($menu as $index => $value)
                        <li class="nav-item {{ isset($value['submenu']) ? ' dropdown ' : '' }} {{ Route::currentRouteName() === $value['slug'] ? ' active' : '' }}">
                            <a class="nav-link {{ isset($value['submenu']) ? ' dropdown-toggle ' : '' }}"
                               href="{{ isset($value['route']) ? (isset($value['submenu']) ? 'javascript:void(0);' : route($value['route'])) : 'javascript:void(0);' }}">{{ $index }}</a>
                            @if(isset($value['submenu']))
                                <ul class="dropdown-menu">
                                    @foreach($value['submenu'] as $inner_index => $inner_value)
                                        <li><a class="dropdown-item"
                                               href="{{ isset($inner_value['route']) ? route($inner_value['route'], $inner_value['params']) : 'javascript:void(0);' }}">{{ isset($inner_index) ? $inner_index : '' }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="header-right">
            <!-- social icons -->
            <ul class="social-icons list-unstyled list-inline mb-0">
                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
            </ul>
            <!-- header buttons -->
            <div class="header-buttons">
                <button class="search icon-button">
                    <i class="icon-magnifier"></i>
                </button>
                <button class="burger-menu icon-button">
                    <span class="burger-icon"></span>
                </button>
            </div>
        </div>
    </div>
</nav>