@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        <div class="center">
            <h1>Edit Student</h1>
        </div>
        <br>
        {!! Form::model($student, ['method' => 'PATCH', 'url' => 'student/'.$student->id, 'files' => true]) !!}
            @include('student._form')
        {!! Form::submit('Finish',['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
        {!! Form::close() !!}
    </div>
@stop