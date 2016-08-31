@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        <div class="center">
            <h1>Create Student</h1>
        </div>

        <br>

        {!! Form::open(['url' => 'student']) !!}

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('student_id', 'Student ID:', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('student_id', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('name', 'Name:', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('name', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        {!! Form::submit('add',['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
        {!! Form::close() !!}
    </div>
@stop