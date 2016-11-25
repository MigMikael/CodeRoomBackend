@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        <div class="center">
            <h1>Edit Problem</h1>
        </div>
    </div>

    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        {!! Form::model($problem, ['method' => 'PATCH', 'url' => 'problem/'.$problem->id, 'files' => true]) !!}
        @include('problem._form')
        {!! Form::submit('Finish',['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
        {!! Form::close() !!}
    </div>

    {{--<div class="mdl-cell mdl-cell--8-col mdl-shadow--2dp">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::textarea('code', null, ['class' => 'mdl-textfield__input', 'type' => 'text', 'rows' => '6', 'cols' => '6']) !!}
            <div id="code" class="code-card"></div>
        </div>
        {!! Form::submit('Finish',['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
        {!! Form::close() !!}
    </div>

    @include('problem._ace')--}}
@stop