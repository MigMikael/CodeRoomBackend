@extends('template')

@section('content')
    <h1>Add new Result (Demo)</h1>
    <hr>
    {!! Form::open(['url'=>'results']) !!}

    <div class="form-group">
    {!! Form::label('class', 'Class:') !!}

    {!! Form::text('class', null, ['class' => 'form-control', 'placeholder' => 'Wood:true|HandleWood:false']) !!} <!-- argument name default parameter -->
    </div>

    <div class="form-group">
        {!! Form::label('attribute', 'Attribute:') !!}

        {!! Form::text('attribute', null, ['class' => 'form-control','placeholder'=>'type:true;size:false|wood[]:false;amount:true']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('method', 'Method:') !!}

        {!! Form::text('method', null, ['class' => 'form-control','placeholder'=>'getWood:true;setWood:false|addWood:false;calPrice:true']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Add Result', ['class'=>'btn btn-success form-control']) !!}
    </div>


@stop