@extends('template')

@section('content')
    <h1>All Result</h1>

    <hr>
    @foreach($results as $result)
        <h5><strong>Submission ID : </strong>{{ $result->submission_id }}</h5>
        <h5><strong>Class : </strong>{{ $result->class }}</h5>
        <h5><strong>Package : </strong>{{ $result->package }}</h5>
        <h5><strong>Enclose : </strong>{{ $result->enclose }}</h5>
        <h5><strong>Attribute : </strong>{{ $result->attribute }}</h5>
        <h5><strong>Attribute Score : </strong>{{ $result->attribute_score }}</h5>
        <h5><strong>Method : </strong>{{ $result->method }}</h5>
        <h5><strong>Method Score : </strong>{{ $result->method_score }}</h5>
        <hr>
    @endforeach

    <h2>
        <a href="{{ url('results/create') }}">add new demo result</a>
        <a href="{{ url('results/create') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
            add new
        </a>
    </h2>


@stop