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
        <a href="{{ url('problem_analysis/'.$problem_analysis->prob_id.'/edit') }}" class="btn btn-success">Edit</a>
        <hr>
    @endforeach

    <h2>
        <a href="{{ url('problem_analysis/create') }}" class="btn btn-primary">add new demo result</a>
    </h2>

@endsection