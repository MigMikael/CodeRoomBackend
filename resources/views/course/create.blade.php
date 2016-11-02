@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        <div class="center">
            <h1>Create Course</h1>
        </div>

        <br>

        {!! Form::open(['url' => 'course', 'files' => true]) !!}
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('name', 'Name :', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('name', null, ['class' => 'mdl-textfield__input']) !!}
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('color', 'Color :', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('color', null, ['class' => 'mdl-textfield__input', 'placeholder' => '240:225:200']) !!}
            </div>

            Coures Photo: {!! Form::file('photo') !!}

            <br>

            {!! Form::submit('add',['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
        {!! Form::close() !!}

    </div>
@stop