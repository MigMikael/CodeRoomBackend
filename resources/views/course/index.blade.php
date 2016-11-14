@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col center">
        <h1>All Course</h1>
        <a href="{{ url('course/create') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>
    @foreach($courses as $course)
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet mdl-card mdl-shadow--2dp
            @if($course->status == 'inactive') disable-card @endif">

            <div class="mdl-card__media" style="background-color: #FFFFFF">
                <img src="{{ $course->image }}" alt="Teacher Image" class="article-image" border="0"/>
            </div>
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">{{ $course->name }}</h2>
            </div>
            <div class="mdl-card__supporting-text">
                ID: {{ $course->id }}<br>
                Color: {{ $course->color }}<br>
                Status: {{ $course->status }}
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a href="{{ url('course/'.$course->id) }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    view
                </a>
                <a href="{{ url('course/'.$course->id.'/edit') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    edit
                </a>
                <a href="{{ url('course/'.$course->id.'/status') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    @if($course->status == 'active')
                        inactive
                    @else
                        active
                    @endif
                </a>
            </div>
        </div>
    @endforeach
    <div class="mdl-cell mdl-cell--12-col right">

    </div>
@stop