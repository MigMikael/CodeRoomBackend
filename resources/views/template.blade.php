<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Backend</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="My portfolio website with Material Design Lite.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.teal-amber.min.css" />
    <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>

    <link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}" />
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
            <nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="{{ url('/') }}"><strong>Home</strong></a>
                <a class="mdl-navigation__link" href="{{ url('problems') }}">Problem</a>
                <a class="mdl-navigation__link" href="{{ url('problem_analysis') }}">ProblemAnalysis</a>
                <a class="mdl-navigation__link" href="{{ url('problemfile') }}">ProblemFile</a>
                <a class="mdl-navigation__link" href="{{ url('course') }}">Course</a>
                <a class="mdl-navigation__link" href="{{ url('badge') }}">Badge</a>
                <a class="mdl-navigation__link" href="{{ url('announcement') }}">Announcement</a>
                <a class="mdl-navigation__link" href="{{ url('lesson') }}">Lesson</a>
                <a class="mdl-navigation__link" href="{{ url('student') }}">Student</a>
                <a class="mdl-navigation__link" href="{{ url('student_course') }}">StudentCourse</a>
                <a class="mdl-navigation__link" href="{{ url('teacher') }}">Teacher</a>
                <a class="mdl-navigation__link" href="{{ url('teacher_course') }}">TeacherCourse</a>
                <a class="mdl-navigation__link" href="{{ url('submissions') }}">Submission</a>
                <a class="mdl-navigation__link" href="{{ url('results') }}">Result</a>
                <hr>
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
        <main class="mdl-layout__content">
            <div class="mdl-grid  page-max-width">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>