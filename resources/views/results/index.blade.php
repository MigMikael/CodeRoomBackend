@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col center">
        <h1>All Result</h1>
    </div>
    <hr>
    @foreach($results as $result)
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet demo-card-event mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand">
                <h4>{{ $result->class }}</h4><br>
            </div>
            <div class="mdl-card__supporting-text">
                {{ $result->package }}<br>
                {{ $result->enclose }}<br>
                {{ $result->attribute }}<br>
                {{ $result->attribute_score }}<br>
                {{ $result->method }}<br>
                {{ $result->method_score }}
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="">
                    View
                </a>
                <div class="mdl-layout-spacer"></div>
                <i class="material-icons">subject</i>
            </div>
        </div>
        {{--<h5><strong>Submission ID : </strong>{{ $result->submission_id }}</h5>
        <h5><strong>Class : </strong>{{ $result->class }}</h5>
        <h5><strong>Package : </strong>{{ $result->package }}</h5>
        <h5><strong>Enclose : </strong>{{ $result->enclose }}</h5>
        <h5><strong>Attribute : </strong>{{ $result->attribute }}</h5>
        <h5><strong>Attribute Score : </strong>{{ $result->attribute_score }}</h5>
        <h5><strong>Method : </strong>{{ $result->method }}</h5>
        <h5><strong>Method Score : </strong>{{ $result->method_score }}</h5>
        <hr>--}}
    @endforeach
    <div class="mdl-cell mdl-cell--12-col right">
        <a href="{{ url('results/create') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>


@stop