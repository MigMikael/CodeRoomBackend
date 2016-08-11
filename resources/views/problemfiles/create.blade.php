@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--8-col">
        {!! Form::open(['url'=>'problemfile/add', 'files' => true]) !!}
            <div class="form-group mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell--5-col">
                {!! Form::text('filename', null, ['class' => 'form-control mdl-textfield__input']) !!}

                <label for="filename" class="mdl-textfield__label">Problem Name</label>
            </div>

            <div class="form-group mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell--5-col">
                {!! Form::text('package', null, ['class' => 'form-control mdl-textfield__input']) !!}

                <label for="package" class="mdl-textfield__label">Package Name</label>
            </div>

            {!! Form::file('filefield') !!}
    
            <div class="form-group mdl-cell mdl-cell--12-col">
                {!! Form::submit('Add Problem', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@stop