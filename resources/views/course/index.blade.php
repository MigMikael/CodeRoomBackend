@extends('template')

@section('content')
    <div class="mdl-grid">
        <h1>All Course</h1>
        <a href="{{ url('course/create') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>
    <div class="mdl-grid">
        @foreach($courses as $course)
            <div class="demo-card-event mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title mdl-card--expand">
                    <h4>{{ $course->name }}</h4><br>
                </div>
                <div class="mdl-card__supporting-text">
                    {{ $course->instructor }}
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="">
                        View
                    </a>
                    <div class="mdl-layout-spacer"></div>
                    <i class="material-icons">subject</i>
                </div>
            </div>
            <h4></h4>
        @endforeach
    </div>
@stop