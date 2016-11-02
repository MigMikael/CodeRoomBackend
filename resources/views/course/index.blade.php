@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col center">
        <h1>All Course</h1>
    </div>
    @foreach($courses as $course)
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet mdl-card mdl-shadow--2dp">
            <div class="mdl-card__media" style="background-color: #FFFFFF">
                <img src="{{ $course->image }}" alt="Teacher Image" class="article-image" border="0"/>
            </div>
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">{{ $course->name }}</h2>
            </div>
            <div class="mdl-card__supporting-text">
                ID: {{ $course->id }}
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a href="{{ url('course/'.$course->id) }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    view
                </a>
            </div>
        </div>
    @endforeach
    <div class="mdl-cell mdl-cell--12-col right">
        <a href="{{ url('course/create') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>
@stop