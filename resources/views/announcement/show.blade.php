@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
        <div class="mdl-card__title">
            {{ $announcement->title }}
        </div>
        <div class="mdl-card__supporting-text">
            Content: {!!  $announcement->content !!}<br>
            Course: {{ $announcement->course->name }}<br>
            Priority: {{ $announcement->priority }}<br>
        </div>
        <div class="mdl-card__actions mdl-card--border">
            <a href="{{ url('announcement/'.$announcement->id.'/edit') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                edit
            </a>
        </div>
        <div class="mdl-card__menu">
            {!! Form::model($announcement, ['method' => 'DELETE', 'url'=>'announcement/'.$announcement->id]) !!}
            <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit">
                <i class="material-icons">cancel</i>
            </button>
            {!! Form::close() !!}
        </div>
    </div>
@stop