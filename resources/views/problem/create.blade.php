@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        <div class="center">
            <h1>Create Problem</h1>
        </div>
        <br>
        {!! Form::open(['url'=>'problem']) !!}
        @include('problem._form')
        {!! Form::submit('Add', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
        {!! Form::close() !!}
    </div>
@stop
