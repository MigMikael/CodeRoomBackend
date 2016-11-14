@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col center">
        <h1>All Problems</h1>
        <a href="{{ url('problem/create') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>
    @foreach($problems as $problem)
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet demo-card-event mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h4>{{ $problem->name }}</h4><br>
            </div>
            <div class="mdl-card__supporting-text mdl-card--expand">
                {{ $problem->description }}<br>
                Evaluator: {{ $problem->evaluator }}<br>
                TimeLimit: {{ $problem->timelimit }}<br>
                MemoryLimit: {{ $problem->memorylimit }}
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a href="{{ url('problem/'.$problem->id) }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    View
                </a>
                <div class="mdl-layout-spacer"></div>
                <a href="{{ url('problem/'.$problem->id.'/edit') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    edit
                </a>
                <div class="mdl-layout-spacer"></div>
                {!! Form::model($problem, ['method' => 'DELETE', 'url'=>'problem/'.$problem->id]) !!}
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