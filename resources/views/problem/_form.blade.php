<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    {!! Form::label('lesson_id', 'Lesson_ID:', ['class' => 'mdl-textfield__label']) !!}
    {!! Form::text('lesson_id', null, ['class' => 'mdl-textfield__input']) !!}
</div>

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
    {!! Form::label('is_parse', 'Parse Structures(True/false):', ['class' => 'mdl-textfield__label']) !!}
    {!! Form::text('is_parse', null, ['class' => 'mdl-textfield__input']) !!}
</div>

{{--<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    {!! Form::label('package', 'Package:', ['class' => 'mdl-textfield__label']) !!}
    {!! Form::text('package', null, ['class' => 'mdl-textfield__input']) !!}
</div>--}}
