@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        <div class="center">
            <h1>Create Announcement</h1>
        </div>

        <br>

        {!! Form::open(['url' => 'announcement']) !!}

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('course_id', 'Course_id:', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('course_id', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('title', 'Title:', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('title', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('content', 'Content:', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('content', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('priority', 'Priority:', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('priority', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        {!! Form::submit('add',['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
        {!! Form::close() !!}
    </div>
@stop