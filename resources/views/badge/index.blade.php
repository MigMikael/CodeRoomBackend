@extends('template')

@section('content')
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '1210331272313647',
                xfbml      : true,
                version    : 'v2.6'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <div class="mdl-cell mdl-cell--12-col center">
        <h1>All Badges</h1>
        <a href="{{ url('badge/create') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>
    @php
        $currentCourse = 0;
    @endphp
    @foreach($badges as $badge)
        @if($currentCourse != $badge->course_id)
            <div class="mdl-cell mdl-cell--12-col">
                <h1>{{$badge->course->id}} {{ $badge->course->name }}</h1>
            </div>
            @php
                $currentCourse = $badge->course_id;
            @endphp
        @endif
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet mdl-card mdl-shadow--2dp">
            <div class="mdl-card__media">
                <img src="{{ url('api/image/'.$badge->image) }}" alt="Badge Image" class="article-image" border="0"/>
            </div>
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">{{ $badge->name }}</h2>
            </div>
            <div class="mdl-card__supporting-text">
                {{ $badge->description }}
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <div id="{{ $badge->id }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    share
                </div>
                <div class="mdl-layout-spacer"></div>
                <a href="{{ url('badge/'.$badge->id.'/edit') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    edit
                </a>
                <div class="mdl-layout-spacer"></div>
                {!! Form::model($badge, ['method' => 'DELETE', 'url'=>'badge/'.$badge->id]) !!}
                <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit">
                    <i class="material-icons">cancel</i>
                </button>
                {!! Form::close() !!}
            </div>
        </div>
        <script>
            document.getElementById('{{ $badge->id }}').onclick = function() {
                FB.ui({
                    method: 'share',
                    display: 'popup',
                    href: 'https://localhost:8000/course',
                    // Todo change above link
                }, function(response){});
            }
        </script>
    @endforeach
    <div class="mdl-cell mdl-cell--12-col right">

    </div>
@endsection