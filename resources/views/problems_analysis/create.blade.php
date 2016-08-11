@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        <div class="center">
            <h1>Create Problem Analysis</h1>
        </div>

        <br>

        {!! Form::open(['url'=>'problem_analysis']) !!}
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('prob_id', 'ProblemID :', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('prob_id', null, ['class' => 'mdl-textfield__input']) !!}
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('class', 'ClassName :', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('class', null, ['class' => 'mdl-textfield__input']) !!}
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('package', 'PackageName :', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('package', null, ['class' => 'mdl-textfield__input']) !!}
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('enclose', 'Enclose :', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('enclose', null, ['class' => 'mdl-textfield__input']) !!}
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('attribute', 'Attribute :', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('attribute', null, ['class' => 'mdl-textfield__input']) !!}
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('method', 'Method :', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('method', null, ['class' => 'mdl-textfield__input']) !!}
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('code', 'Code :', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::textarea('code', null, ['class' => 'mdl-textfield__input']) !!}
            </div>
            {!! Form::submit('Add Problem Analysis', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
        {!! Form::close() !!}
    </div>

@endsection
