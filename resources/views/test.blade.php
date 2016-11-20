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
    <?php
/*        echo storage_path().'\\app\\public\\';
    */?><!--
    <img src="http://localhost:8000/api/image/1" alt="" />
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '1210331272313647',
                xfbml      : true,
                version    : 'v2.5'
            });
            FB.AppEvents.logPageView();
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <div class="page-header">
        <h1>Share Dialog</h1>
    </div>
    <p>Click the button below to trigger a Share Dialog</p>
    <div id="shareBtn" class="btn btn-success clearfix">Share</div>
    <p style="margin-top: 50px">
        <hr />
        <a class="btn btn-small"  href="https://developers.facebook.com/docs/sharing/reference/share-dialog">Share Dialog Documentation</a>
    </p>

    <script>
        document.getElementById('shareBtn').onclick = function() {
            FB.ui({
                method: 'share',
                display: 'popup',
                href: 'https://developers.facebook.com/docs/',
            }, function(response){});
        }
    </script>-->

    <div class="mdl-tabs mdl-js-tabs">
        <div class="mdl-tabs__tab-bar">
            <a href="#tab1" class="mdl-tabs__tab">Tab One</a>
            <a href="#tab2" class="mdl-tabs__tab">Tab Two</a>
            <a href="#tab3" class="mdl-tabs__tab">Tab Three</a>
        </div>
        <div class="mdl-tabs__panel is-active" id="tab1">
            <p>First tab's content.</p>
        </div>
        <div class="mdl-tabs__panel" id="tab2">
            <p>Second tab's content.</p>
        </div>
        <div class="mdl-tabs__panel" id="tab3">
            <p>Third tab's content.</p>
        </div>
    </div>
</body>
</html>