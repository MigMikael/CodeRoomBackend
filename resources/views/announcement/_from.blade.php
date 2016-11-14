<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    {!! Form::label('course_id', 'Course_id:', ['class' => 'mdl-textfield__label']) !!}
    {!! Form::text('course_id', null, ['class' => 'mdl-textfield__input']) !!}
</div>

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    {!! Form::label('title', 'Title:', ['class' => 'mdl-textfield__label']) !!}
    {!! Form::text('title', null, ['class' => 'mdl-textfield__input']) !!}
</div>

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    {!! Form::textarea('content', null, ['class' => 'form-control mdl-textfield__input', 'type' => 'text', 'rows' => '6', 'cols' => '6']) !!}
    <label for="content" class="mdl-textfield__label">Content:</label>
</div>

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    {!! Form::label('priority', 'Priority:', ['class' => 'mdl-textfield__label']) !!}
    {!! Form::text('priority', null, ['class' => 'mdl-textfield__input']) !!}
</div>