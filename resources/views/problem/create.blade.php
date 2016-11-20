@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        <div class="center">
            <h1>Create Problem</h1>
        </div>
    </div>

    {{--<div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--2dp big-card">
        {!! Form::open(['url'=>'problem', 'files' => true]) !!}
        @include('problem._form')
    </div>

    <div class="mdl-cell mdl-cell--8-col mdl-shadow--2dp">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::textarea('code', null, ['class' => 'mdl-textfield__input', 'type' => 'text', 'rows' => '6', 'cols' => '6']) !!}
            <div id="code" class="code-card"></div>
        </div>
        {!! Form::submit('Finish',['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
        {!! Form::close() !!}
    </div>

    @include('problem._ace')--}}

    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        {!! Form::open(['url'=>'problem', 'files' => true]) !!}
            @include('problem._form')
            Problem File: {!! Form::file('file') !!}
        {!! Form::submit('Finish',['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
        {!! Form::close() !!}
    </div>
@stop
