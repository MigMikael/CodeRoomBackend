@extends('template')

@section('content')
    <h1>Add new Submission (Demo)</h1>
    <hr>
    {!! Form::open(['url'=>'submissions']) !!}

        <div class="form-group">
            {!! Form::label('user_id', 'UserID : ') !!}

            {!! Form::text('user_id', null,['class' => 'form-control', 'placeholder' => '07560550']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('prob_id', 'ProblemID : ') !!}

            {!! Form::text('prob_id', null,['class' => 'form-control', 'placeholder' => '1']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('sub_num', 'Submit Number : ') !!}

            {!! Form::text('sub_num', null,['class' => 'form-control', 'placeholder' => '1']) !!}
        </div>

        <!-- time -->
        <div class="form-group">
            {!! Form::label('time', 'Time : ') !!}

            {!! Form::input('date','time', date('Y-m-d'),['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('code', 'Code : ') !!}

            {!! Form::textarea('code', null,['class' => 'form-control', 'placeholder' => 'paste your demo code here']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Add Submission', ['class'=>'btn btn-success form-control']) !!}
        </div>

    {!! Form::close() !!}
@stop
