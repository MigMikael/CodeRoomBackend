@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--4-col mdl-card problem-card mdl-shadow--4dp">
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

    <div class="mdl-cell mdl-cell--8-col mdl-card code-card mdl-shadow--4dp" id="editor" >
        {{ $problem->code }}
    </div>

    <script src="{{ URL::asset('CodeRoom/js/lib/ace-builds/src-noconflict/ace.js') }}" type="text/javascript" charset="utf-8"></script>
    <script>
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/eclipse");
        editor.getSession().setMode("ace/mode/java");
    </script>
@stop