@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col center">
        <h1>All Problem Analysis</h1>
    </div>
    @php
        $currentProblem = 0;
    @endphp
    @foreach($problems_analysis as $analysis)
        @if($currentProblem != $analysis->problem_id)
            <div class="mdl-cell mdl-cell--12-col">
                <h1><b>{{$analysis->problem->id}}</b> > {{ $analysis->problem->name }}</h1>
            </div>
            @php
                $currentProblem = $analysis->problem_id;
            @endphp
        @endif
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet demo-card-event mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand">
                <h4>{{ str_replace(';', ' ', $analysis->class) }}</h4><br>
            </div>
            <div class="mdl-card__supporting-text">
                <p>
                    <b>Package: </b>{{ $analysis->package }}<br>
                    <b>Enclose: </b>{{ $analysis->enclose }}<br>
                </p>
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect"
                   href="{{ url('problem_analysis/'.$analysis->id.'/edit') }}">
                    edit
                </a>
                <div class="mdl-layout-spacer"></div>
                {!! Form::model($analysis, ['method' => 'DELETE', 'url'=>'problem_analysis/'.$analysis->id]) !!}
                <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit">
                    <i class="material-icons">cancel</i>
                </button>
                {!! Form::close() !!}
            </div>
        </div>
    @endforeach
    <div class="mdl-cell mdl-cell--12-col right">

    </div>
@endsection