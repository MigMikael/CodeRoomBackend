@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--2dp">
        <div class="mdl-card__media" style="background-color: #FFFFFF">
            <img src="{{ url('api/image/'.$submission->student->image) }}" alt="Student Image" class="article-image" border="0"/>
        </div>
        <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">{{ $submission->student->name }}</h2>
        </div>
        <div class="mdl-card__supporting-text">
            <h6>
            <b>Problem ID:</b> {{ $submission->problem_id }}<br>
            <b>Problem Name:</b> {{ $submission->problem->name }}<br>
            <b>Sub Num:</b> {{ $submission->sub_num }}<br>
            <b>Sub Time:</b> {{ $submission->created_at }}
            </h6>
        </div>
        <div class="mdl-card__actions mdl-card--border">
            <a href="{{ url('student/'.$submission->student->id) }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                Student Profile
            </a>
        </div>
        <div class="mdl-card__menu">
            {!! Form::model($submission, ['method' => 'DELETE', 'url'=>'submission/'.$submission->id]) !!}
            <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit">
                <i class="material-icons">cancel</i>
            </button>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="mdl-cell mdl-cell--8-col mdl-card code-card mdl-shadow--4dp" id="editor" >
        {{ $submission->code }}
    </div>

    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
        <h1>Score</h1>
    </div>

    <script src="{{ URL::asset('CodeRoom/js/lib/ace-builds/src-noconflict/ace.js') }}" type="text/javascript" charset="utf-8"></script>
    <script>
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/eclipse");
        editor.getSession().setMode("ace/mode/java");
    </script>
@stop