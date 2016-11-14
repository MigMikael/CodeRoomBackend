<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    {!! Form::label('name', 'Name:', ['class' => 'mdl-textfield__label']) !!}
    {!! Form::text('name', null, ['class' => 'mdl-textfield__input']) !!}
</div>

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    {!! Form::label('username', 'Username:', ['class' => 'mdl-textfield__label']) !!}
    {!! Form::text('username', null, ['class' => 'mdl-textfield__input']) !!}
</div>

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    {!! Form::label('password', 'Password:', ['class' => 'mdl-textfield__label']) !!}
    {!! Form::password('password', null, ['class' => 'mdl-textfield__input']) !!}
</div>

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    {!! Form::label('confirm_password', 'Confirm Password:', ['class' => 'mdl-textfield__label']) !!}
    {!! Form::password('confirm_password', null, ['class' => 'mdl-textfield__input']) !!}
</div>