<nav class="navbar navbar-expand-lg">
    <div class="header-bottom  w-100">
        <div class="container-xl">
            <div class="d-flex align-items-center">
                <div class="collapse navbar-collapse flex-grow-1">
                    <!-- menus -->
                    <ul class="navbar-nav">
                        @php
                            $menu = trans('menu');
                        @endphp
                        @if(isset($menu))
                            @foreach($menu as $index => $value)
                                <li class="nav-item {{ isset($value['submenu']) ? ' dropdown ' : '' }} {{ Route::currentRouteName() === $value['slug'] ? ' active' : '' }}">
                                    <a class="nav-link {{ isset($value['submenu']) ? ' dropdown-toggle ' : '' }}" href="{{ isset($value['route']) ? (isset($value['submenu']) ? 'javascript:void(0);' : route($value['route'])) : 'javascript:void(0);' }}">{{ $index }}</a>
                                    @if(isset($value['submenu']))
                                    <ul class="dropdown-menu">
                                        @foreach($value['submenu'] as $inner_index => $inner_value)
                                            <li><a class="dropdown-item" href="{{ isset($inner_value['route']) ? route($inner_value['route'], $inner_value['params']) : 'javascript:void(0);' }}">{{ isset($inner_index) ? $inner_index : '' }}</a></li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <div class="header-buttons">
                    <button class="search icon-button">
                        <i class="icon-magnifier"></i>
                    </button>
                    <button class="burger-menu icon-button ms-2 float-end float-lg-none">
                        <span class="burger-icon"></span>
                    </button>
                </div>
            </div>
        </div>

    </div>
</nav>