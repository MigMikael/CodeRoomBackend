@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        <div class="center">
            <h1>Create Submission</h1>
        </div>
        <br>
        {!! Form::open(['url'=>'submission']) !!}

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('student_id', 'Student_ID : ', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('student_id', null,['class' => 'mdl-textfield__input']) !!}
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('problem_id', 'Problem_ID : ', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('problem_id', null,['class' => 'mdl-textfield__input']) !!}
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('code', 'Code : ', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::textarea('code', null,['class' => 'mdl-textfield__input']) !!}
            </div>

        {!! Form::submit('Add', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
        {!! Form::close() !!}
    </div>
@stop
