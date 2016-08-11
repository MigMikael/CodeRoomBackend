@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col center">
        <h1>All Problem Analysis</h1>
    </div>
    @foreach($problems_analysis as $problem_analysis)
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet demo-card-event mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand">
                <h4>{{ $problem_analysis->class }}</h4><br>
            </div>
            <div class="mdl-card__supporting-text">
                {{ $problem_analysis->package }}<br>
                {{ $problem_analysis->enclose }}<br>
                {{ $problem_analysis->attribute }}<br>
                {{ $problem_analysis->attribute_score }}<br>
                {{ $problem_analysis->method }}<br>
                {{ $problem_analysis->method_score }}
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect"
                   href="{{ url('problem_analysis/'.$problem_analysis->prob_id.'/edit') }}">
                    View
                </a>
                <div class="mdl-layout-spacer"></div>
                <i class="material-icons">subject</i>
            </div>
        </div>
        {{--<h5><strong>ProblemID : </strong>{{ $problem_analysis->prob_id }}</h5>
        <h5><strong>Class : </strong>{{ $problem_analysis->class }}</h5>
        <h5><strong>Package : </strong>{{ $problem_analysis->package }}</h5>
        <h5><strong>Enclose : </strong>{{ $problem_analysis->enclose }}</h5>
        <h5><strong>Attribute : </strong>{{ $problem_analysis->attribute }}</h5>
        <h5><strong>Attribute Score :</strong>{{ $problem_analysis->attribute_score }}</h5>
        <h5><strong>Method : </strong>{{ $problem_analysis->method }}</h5>
        <h5><strong>Method Score : </strong>{{ $problem_analysis->method_score }}</h5>
        <h5><strong>Code : </strong>{{ $problem_analysis->code }}</h5>
        <a href="{{ url('problem_analysis/'.$problem_analysis->prob_id.'/edit') }}" class="btn btn-success">Edit</a>
        <hr>--}}
    @endforeach
    <div class="mdl-cell mdl-cell--12-col right">
        <a href="{{ url('problem_analysis/create') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>
@endsection