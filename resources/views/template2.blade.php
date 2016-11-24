<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Backend</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="CodeRoom System">
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
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <!-- Title -->
                <span class="mdl-layout-title">Title</span>
            </div>
            <!-- Tabs -->
            <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
                <a href="#scroll-tab-1" class="mdl-layout__tab is-active">Summary</a>
                <a href="#scroll-tab-2" class="mdl-layout__tab">Tab 2</a>
                <a href="#scroll-tab-3" class="mdl-layout__tab">Tab 3</a>
                <a href="#scroll-tab-4" class="mdl-layout__tab">Tab 4</a>
                <a href="#scroll-tab-5" class="mdl-layout__tab">Tab 5</a>
                <a href="#scroll-tab-6" class="mdl-layout__tab">Tab 6</a>
            </div>
        </header>
        <div class="mdl-layout__drawer">
            <span class="mdl-layout-title">Title</span>
        </div>
        <main class="mdl-layout__content">
            <section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
                <div class="page-content">
                    @yield('summary')
                </div>
            </section>
            <section class="mdl-layout__tab-panel" id="scroll-tab-2">
                <div class="page-content">
                    page two
                </div>
            </section>
            <section class="mdl-layout__tab-panel" id="scroll-tab-3">
                <div class="page-content"><!-- Your content goes here --></div>
            </section>
            <section class="mdl-layout__tab-panel" id="scroll-tab-4">
                <div class="page-content"><!-- Your content goes here --></div>
            </section>
            <section class="mdl-layout__tab-panel" id="scroll-tab-5">
                <div class="page-content"><!-- Your content goes here --></div>
            </section>
            <section class="mdl-layout__tab-panel" id="scroll-tab-6">
                <div class="page-content"><!-- Your content goes here --></div>
            </section>
        </main>
    </div>
</body>
</html>