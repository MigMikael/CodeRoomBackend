@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col center">
        <h1>All Announcement</h1>
        <a href="{{ url('announcement/create') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>
    @php
        $currentCourse = 0;
    @endphp

    @foreach($announcements as $announcement)
        @if($currentCourse != $announcement->course_id)
            <div class="mdl-cell mdl-cell--12-col">
                <h1>{{$announcement->course->id}} {{ $announcement->course->name }}</h1>
            </div>
            @php
                $currentCourse = $announcement->course_id;
            @endphp
        @endif

        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet demo-card-event mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand">
                <h4>{{ $announcement->title }}</h4><br>
            </div>
            <div class="mdl-card__supporting-text">
                Course_id: {{ $announcement->course_id }}<br>
                Priority: {{ $announcement->priority }}<br>
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a href="{{ url('announcement/'.$announcement->id) }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    View
                </a>
                <div class="mdl-layout-spacer"></div>
                <a href="{{ url('announcement/'.$announcement->id.'/edit') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    edit
                </a>
                <div class="mdl-layout-spacer"></div>
                {!! Form::model($announcement, ['method' => 'DELETE', 'url'=>'announcement/'.$announcement->id]) !!}
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