@extends('template2')

@section('summary')
    <div class="mdl-cell mdl-cell--12-col center">
        <h1>Problem Detail</h1>
    </div>
    <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--4dp">
        <div class="mdl-card__title">
            <h3><b>{{$problem->id}}</b> > {{ $problem->name }}</h3><br>
        </div>
        <div class="mdl-card__supporting-text mdl-card--expand">
            <h5><b>Description:</b> {{ $problem->description }}</h5><br>
            <h5><b>Lesson:</b> {{ $problem->lesson->name }}</h5><br>
            <h5><b>Evaluator:</b> {{ $problem->evaluator }}</h5>
            <h5><b>TimeLimit:</b> {{ $problem->timelimit }} Sec</h5>
            <h5><b>MemoryLimit:</b> {{ $problem->memorylimit }} MB</h5>
            <h5><b>Analyze Structures:</b> {{ $problem->is_parse }}</h5>
            <h5><b>Problem Submission:</b> {{ $problem->submissions_count }}</h5>
        </div>
        <div class="mdl-card__actions mdl-card--border">
            <a href="{{ url('problem/'.$problem->id.'/edit') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                edit
            </a>
        </div>
        <div class="mdl-card__menu">
            {!! Form::model($problem, ['method' => 'DELETE', 'url'=>'problem/'.$problem->id]) !!}
            <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit">
                <i class="material-icons">cancel</i>
            </button>
            {!! Form::close() !!}
        </div>
    </div>
@stop