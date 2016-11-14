@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        <div class="center">
            <h1>Edit Problem</h1>
        </div>
        <br>
        {!! Form::model($problem, ['method' => 'PATCH', 'url' => 'problem/'.$problem->id]) !!}
        @include('problem._form')
        {!! Form::submit('Finish',['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
        {!! Form::close() !!}
    </div>
@stop