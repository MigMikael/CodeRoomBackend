@extends('template')

@section('content')
    <h1>All Problem Analysis</h1>
    <hr>

    @foreach($problems_analysis as $problem_analysis)
        <h5><strong>ProblemID : </strong>{{ $problem_analysis->prob_id }}</h5>
        <h5><strong>Class : </strong>{{ $problem_analysis->class }}</h5>
        <h5><strong>Package : </strong>{{ $problem_analysis->package }}</h5>
        <h5><strong>Enclose : </strong>{{ $problem_analysis->enclose }}</h5>
        <h5><strong>Attribute : </strong>{{ $problem_analysis->attribute }}</h5>
        <h5><strong>Attribute Score :</strong>{{ $problem_analysis->attribute_score }}</h5>
        <h5><strong>Method : </strong>{{ $problem_analysis->method }}</h5>
        <h5><strong>Method Score : </strong>{{ $problem_analysis->method_score }}</h5>
        <h5><strong>Code : </strong>{{ $problem_analysis->code }}</h5>
        <hr>
    @endforeach

    <h2>
        <a href="{{ url('problems_analysis/create') }}">add new demo result</a>
    </h2>

@stop