@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        <div class="center">
            <h1>Create Result</h1>
        </div>
        {!! Form::open(['url'=>'results']) !!}

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('submissionID', 'SubmissionID :', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('submission_id', null, ['class' => 'mdl-textfield__input', 'placeholder' => '1']) !!}
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('class', 'Class :', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('class', null, ['class' => 'mdl-textfield__input', 'placeholder' => 'Wood;true']) !!} <!-- argument name default parameter -->
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('package', 'Package :', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('package', null, ['class' => 'mdl-textfield__input', 'placeholder' => 'package name']) !!}
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('enclose', 'Enclose :', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('enclose', null, ['class' => 'mdl-textfield__input', 'placeholder' => 'parent class']) !!}
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('attribute', 'Attribute :', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('attribute', null, ['class' => 'mdl-textfield__input', 'placeholder'=>'1;true|2;false']) !!}
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('attributeScore', 'Attribute Score :', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('attribute_score', null, ['class' => 'mdl-textfield__input', 'placeholder'=>'1;10|2;0']) !!}
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('method', 'Method:', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('method', null, ['class' => 'mdl-textfield__input', 'placeholder'=>'1;true|2;false']) !!}
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('methodScore', 'Method Score :', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('method_score', null, ['class' => 'mdl-textfield__input', 'placeholder'=>'1;10|2;0']) !!}
            </div>

            {!! Form::submit('Add Result', ['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}

        {!! Form::close() !!}

    </div>

    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@stop