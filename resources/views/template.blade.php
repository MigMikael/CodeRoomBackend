<!doctype html>
<html lang="en">
<head>
    @include('_head')
</head>
<body>
    <div class="mdl-layout mdl-js-layout">
        <header class="mdl-layout__header mdl-layout__header--scroll">
            <div class="mdl-layout__header-row">
                <!-- Title -->
                <span class="mdl-layout-title">CodeRooooomBackend</span>
                <!-- Add spacer, to align navigation to the right -->
                <div class="mdl-layout-spacer"></div>
                <!-- Navigation -->
                <nav class="mdl-navigation">
                    @if (Auth::guest())
                        <a class="mdl-navigation__link" href="{{ url('/login') }}">Login</a>
                        <a class="mdl-navigation__link" href="{{ url('/register') }}">Register</a>
                    @else
                        <a class="mdl-navigation__link" href="#">{{ Auth::user()->name }}</a>
                        <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
                            <i class="material-icons">more_vert</i>
                        </button>

                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                            for="demo-menu-lower-right">
                            <a href="{{ url('/logout') }}"><li class="mdl-menu__item">Logout</li></a>
                            <li disabled class="mdl-menu__item">Disabled Action</li>
                        </ul>
                    @endif
                </nav>
            </div>
        </header>
        <div class="mdl-layout__drawer">
            <span class="mdl-layout-title">Model List</span>
            @include('_nav')
        </div>
        <main class="mdl-layout__content">
            <div class="mdl-grid page-max-width">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>