@extends('template')

@section('content')
    <h1>Add new Result (Demo)</h1>
    <hr>
    {!! Form::open(['url'=>'results']) !!}

        <div class="form-group">
        {!! Form::label('submissionID', 'SubmissionID :') !!}

        {!! Form::text('submission_id', null, ['class' => 'form-control', 'placeholder' => '1']) !!}
        </div>

        <div class="form-group">
        {!! Form::label('class', 'Class :') !!}

        {!! Form::text('class', null, ['class' => 'form-control', 'placeholder' => 'Wood;true']) !!} <!-- argument name default parameter -->
        </div>

        <div class="form-group">
        {!! Form::label('package', 'Package :') !!}

        {!! Form::text('package', null, ['class' => 'form-control', 'placeholder' => 'package name']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('enclose', 'Enclose :') !!}

            {!! Form::text('enclose', null, ['class' => 'form-control', 'placeholder' => 'parent class']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('attribute', 'Attribute :') !!}

            {!! Form::text('attribute', null, ['class' => 'form-control','placeholder'=>'1;true|2;false']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('attributeScore', 'Attribute Score :') !!}

            {!! Form::text('attribute_score', null, ['class' => 'form-control','placeholder'=>'1;10|2;0']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('method', 'Method:') !!}

            {!! Form::text('method', null, ['class' => 'form-control','placeholder'=>'1;true|2;false']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('methodScore', 'Method Score :') !!}

            {!! Form::text('method_score', null, ['class' => 'form-control','placeholder'=>'1;10|2;0']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Add Result', ['class'=>'btn btn-success form-control']) !!}
        </div>

    {!! Form::close() !!}

    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@stop