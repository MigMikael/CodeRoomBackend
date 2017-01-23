@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        <div class="center">
            <h1>Login</h1>
        </div>

        <br>

        {!! Form::open(['url' => 'login']) !!}
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('username', 'Username', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('username', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('password', 'Password', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::password('password', null, ['class' => 'mdl-textfield__input']) !!}
        </div>
        {!! Form::submit('Login',['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
        {!! Form::close() !!}
    </div>
@stop