@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        <div class="center">
            <h1>Add ProblemFile</h1>
        </div>

        <br>

        {!! Form::open(['url'=>'problemfile/add', 'files' => true]) !!}
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::text('filename', null, ['class' => 'form-control mdl-textfield__input']) !!}
                <label for="filename" class="mdl-textfield__label">Problem Name</label>
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::text('package', null, ['class' => 'form-control mdl-textfield__input']) !!}
                <label for="package" class="mdl-textfield__label">Package Name</label>
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::text('lesson_id', null, ['class' => 'form-control mdl-textfield__input']) !!}
                <label for="lesson_id" class="mdl-textfield__label">Lesson_id</label>
            </div>

            {!! Form::file('filefield') !!}

            <br>

            {!! Form::submit('Add', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
        {!! Form::close() !!}
    </div>
@stop