@extends('template')

@section('content')
    <h1>Add new Problem (Demo)</h1>
    <hr>
    {!! Form::open(['url'=>'/api/problems_analysis']) !!}
        <div class="form-group">
            {!! Form::label('code', 'Code :') !!}

            {!! Form::textarea('code', null, ['class' => 'form-control', 'placeholder' => 'Paste Your Code Here']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Add Problem Analysis', ['class'=>'btn btn-success form-control']) !!}
        </div>
    {!! Form::close() !!}

@stop
