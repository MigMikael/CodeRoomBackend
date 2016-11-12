<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    {!! Form::label('name', 'Name :', ['class' => 'mdl-textfield__label']) !!}
    {!! Form::text('name', null, ['class' => 'mdl-textfield__input']) !!}
</div>

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    {!! Form::label('color', 'Color :', ['class' => 'mdl-textfield__label']) !!}
    {!! Form::text('color', null, ['class' => 'mdl-textfield__input', 'placeholder' => '240:225:200']) !!}
</div>

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    {!! Form::label('status', 'Status :', ['class' => 'mdl-textfield__label']) !!}
    {!! Form::text('status', null, ['class' => 'mdl-textfield__input']) !!}
</div>

Coures Photo: {!! Form::file('photo') !!}