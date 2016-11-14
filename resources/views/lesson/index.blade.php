@extends('template')


@section('content')
    <div class="mdl-cell mdl-cell--12-col center">
        <h1>All Lesson</h1>
        <a href="{{ url('lesson/create') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>
    @php
        $currentCourse = 0;
    @endphp
    @foreach($lessons as $lesson)
        @if($currentCourse != $lesson->course_id)
            <div class="mdl-cell mdl-cell--12-col">
                <h1>{{$lesson->course->id}} {{ $lesson->course->name }}</h1>
            </div>
            @php
                $currentCourse = $lesson->course_id;
            @endphp
        @endif
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet mdl-card mdl-shadow--2dp
            @if($lesson->status == 'true')
                demo-card-event
            @else
                demo-card-event2
        @endif">
            <div class="mdl-card__title mdl-card--expand">
                <h4>{{ $lesson->name }}</h4><br>
            </div>
            <div class="mdl-card__supporting-text">
                ID: {{ $lesson->id }}<br>
                Course ID: {{ $lesson->course_id }}<br>
                Status: {{ $lesson->status }}<br>
                Order: {{ $lesson->order }}<br>
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a href="{{ url('lesson/'.$lesson->id) }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    View
                </a>
                <div class="mdl-layout-spacer"></div>
                <a href="{{ url('lesson/'.$lesson->id.'/edit') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    edit
                </a>
                <div class="mdl-layout-spacer"></div>
                {!! Form::model($lesson, ['method' => 'DELETE', 'url'=>'lesson/'.$lesson->id]) !!}
                <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit">
                    <i class="material-icons">cancel</i>
                </button>
                {!! Form::close() !!}
            </div>
        </div>
    @endforeach
    <div class="mdl-cell mdl-cell--12-col right">
    </div>
@stop