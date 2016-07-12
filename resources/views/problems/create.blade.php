@extends('template')

@section('content')
    <h1>Add new Problem (Demo)</h1>
    <hr>
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--2-col"></div>
        <div class="mdl-cell mdl-cell--8-col">

            {!! Form::open(['url'=>'problems']) !!}

            <div class="form-group mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell--5-col">
                {!! Form::text('prob_id', null, ['class' => 'form-control mdl-textfield__input']) !!}

                <label for="prob_id" class="mdl-textfield__label">Problem ID</label>
            </div>

            <div class="form-group mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell--5-col">
                {!! Form::text('filename', null, ['class' => 'form-control mdl-textfield__input']) !!}

                <label for="filename" class="mdl-textfield__label">Problem Name</label>
            </div>

            <div class="form-group mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell--5-col">
                {!! Form::text('package', null, ['class' => 'form-control mdl-textfield__input']) !!}

                <label for="package" class="mdl-textfield__label">Package Name</label>
            </div>

            <div class="form-group mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell--12-col">
                {!! Form::textarea('code', null, ['class' => 'form-control mdl-textfield__input', 'type' => 'text', 'rows' => '6', 'cols' => '6']) !!}

                <label for="code" class="mdl-textfield__label">Code</label>
            </div>
            <div class="form-group mdl-cell mdl-cell--12-col">
                {!! Form::submit('Add Problem', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
            </div>
            {!! Form::close() !!}

        </div>
        <div class="mdl-cell mdl-cell--2-col"></div>
    </div>

@stop
