@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        <div class="center">
            <h1>Create Course</h1>
        </div>

        <br>

        {!! Form::open(['url' => 'course']) !!}
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('name', 'Name :', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('name', null, ['class' => 'mdl-textfield__input']) !!}
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('instructor', 'Instructor :', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('instructor', null, ['class' => 'mdl-textfield__input']) !!}
            </div>

            {!! Form::submit('add',['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
        {!! Form::close() !!}

    </div>
@stop