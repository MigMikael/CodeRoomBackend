@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        <div class="center">
            <h1>Edit Problem</h1>
        </div>
    </div>

    <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--2dp big-card">
        {!! Form::model($problem, ['method' => 'PATCH', 'url' => 'problem/'.$problem->id]) !!}
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('name', 'Name:', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('name', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('description', 'Description:', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('description', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('evaluator', 'Evaluator:', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('evaluator', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('timelimit', 'Time Limit(Second):', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('timelimit', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('memorylimit', 'Memory Limit(MB):', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('memorylimit', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('package', 'Package:', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('package', null, ['class' => 'mdl-textfield__input']) !!}
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::label('lesson_id', 'Lesson_ID:', ['class' => 'mdl-textfield__label']) !!}
            {!! Form::text('lesson_id', null, ['class' => 'mdl-textfield__input']) !!}
        </div>
    </div>

    <div class="mdl-cell mdl-cell--8-col mdl-shadow--2dp">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            {!! Form::textarea('code', null, ['class' => 'mdl-textfield__input', 'type' => 'text', 'rows' => '6', 'cols' => '6']) !!}
            <div id="code" class="code-card"></div>
        </div>
        {!! Form::submit('Finish',['class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
        {!! Form::close() !!}
    </div>

    <script src="{{ URL::asset('CodeRoom/js/lib/ace-builds/src-noconflict/ace.js') }}" type="text/javascript" charset="utf-8"></script>
    <script>
        var editor = ace.edit("code");
        var textarea = $('textarea[name="code"]').hide();
        editor.getSession().setValue(textarea.val());
        editor.getSession().on('change', function(){
            textarea.val(editor.getSession().getValue());
        });
        editor.setTheme("ace/theme/eclipse");
        editor.getSession().setMode("ace/mode/java");
    </script>
@stop