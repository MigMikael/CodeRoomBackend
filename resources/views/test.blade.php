<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Testing</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

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
    </script>
</body>
</html>