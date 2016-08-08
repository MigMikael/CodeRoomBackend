@extends('template')

@section('content')
    <h1>Create Problem Analysis (Demo)</h1>
    <hr>
    {!! Form::open(['url'=>'problem_analysis']) !!}

        <div class="form-group">
            {!! Form::label('prob_id', 'ProblemID :') !!}

            {!! Form::text('prob_id', null, ['class' => 'form-control', 'placeholder' => '1']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('class', 'ClassName :') !!}

            {!! Form::text('class', null, ['class' => 'form-control', 'placeholder' => 'Your Class Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('package', 'PackageName :') !!}

            {!! Form::text('package', null, ['class' => 'form-control', 'placeholder' => 'Your Package Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('enclose', 'Enclose :') !!}

            {!! Form::text('enclose', null, ['class' => 'form-control', 'placeholder' => 'Parent Class']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('attribute', 'Attribute :') !!}

            {!! Form::text('attribute', null, ['class' => 'form-control', 'placeholder' => 'All Attribute']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('method', 'Method :') !!}

            {!! Form::text('method', null, ['class' => 'form-control', 'placeholder' => 'All Method']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('code', 'Code :') !!}

            {!! Form::textarea('code', null, ['class' => 'form-control', 'placeholder' => 'Paste Your Code Here']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Add Problem Analysis', ['class'=>'btn btn-success form-control']) !!}
        </div>

    {!! Form::close() !!}
@endsection
