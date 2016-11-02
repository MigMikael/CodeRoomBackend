@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        <div class="center">
            <h1>Add Student Member</h1>
        </div>
        <br>
        {!! Form::open(['url' => 'api/course/add_student_member', 'files' => true]) !!}
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('course_id', 'CourseID :', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('course_id', null, ['class' => 'mdl-textfield__input']) !!}
            </div>
            Student List: {!! Form::file('studentList') !!}
            <br>
            {!! Form::submit('add',['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
        {!! Form::close() !!}
    </div>
@stop