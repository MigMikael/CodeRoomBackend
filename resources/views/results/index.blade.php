@extends('template')

@section('content')
    <h1>All Result</h1>

    <hr>
    @foreach($results as $result)
        <h3><strong>ID : </strong>{{ $result->id }}</h3>
        <h3><strong>Class : </strong>{{ $result->class }}</h3>
        <h3><strong>Attribute : </strong>{{ $result->attribute }}</h3>
        <h3><strong>Method : </strong>{{ $result->method }}</h3>
        <hr>
    @endforeach

    <a href="{{ url('results/create') }}">add new demo result</a>
    
@stop