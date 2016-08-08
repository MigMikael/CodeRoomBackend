<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Backend</title>
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
                    <a class="mdl-navigation__link" href="">index</a>
                    <a class="mdl-navigation__link" href="">create</a>
                    <a class="mdl-navigation__link" href="">edit</a>
                    <a class="mdl-navigation__link" href="">delete</a>
                </nav>
            </div>
        </header>
        <div class="mdl-layout__drawer">
            <span class="mdl-layout-title">CodeRoomBackend</span>
            <nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="{{ url('/') }}"><strong>Home</strong></a>
                <a class="mdl-navigation__link" href="{{ url('problems') }}">Problem</a>
                <a class="mdl-navigation__link" href="{{ url('problem_analysis') }}">ProblemAnalysis</a>
                <a class="mdl-navigation__link" href="{{ url('problemfile') }}">ProblemFile</a>
                <a class="mdl-navigation__link" href="{{ url('course') }}">Course</a>
                <a class="mdl-navigation__link" href="{{ url('submissions') }}">Submission</a>
                <a class="mdl-navigation__link" href="{{ url('results') }}">Result</a>
            </nav>
        </div>
        <main class="mdl-layout__content">
            <div class="page-content">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>