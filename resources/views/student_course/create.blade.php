@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        <div class="center">
            <h1>Create Student Course</h1>
        </div>

        <br>

        {!! Form::open(['url' => 'student_course']) !!}

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('student_id', 'Student ID:', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('student_id', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('course_id', 'Course ID:', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('course_id', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('progress', 'Progress:', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('progress', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        {!! Form::submit('add',['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
        {!! Form::close() !!}
    </div>
@stop