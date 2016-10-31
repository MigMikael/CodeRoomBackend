@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        <div class="center">
            <h1>Create Badge</h1>
        </div>

        <br>

        {!! Form::open(['url' => 'badge']) !!}

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('type', 'Type:', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('type', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('course_id', 'Course_ID:', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('course_id', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('name', 'Name:', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('name', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('description', 'Description:', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('description', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('criteria', 'Criteria:', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('criteria', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        {!! Form::submit('add',['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
        {!! Form::close() !!}
    </div>
@stop