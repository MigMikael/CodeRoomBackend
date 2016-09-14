@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp big-card">
        <div class="center">
            <h1>Create Submission</h1>
        </div>

        <br>

        {!! Form::open(['url'=>'submissions']) !!}

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('user_id', 'UserID : ', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('user_id', null,['class' => 'mdl-textfield__input', 'placeholder' => '07560550']) !!}
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('prob_id', 'ProblemID : ', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('prob_id', null,['class' => 'mdl-textfield__input', 'placeholder' => '1']) !!}
            </div>

            {{--Todo remove this input--}}
            {{--<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('sub_num', 'Submit Number : ', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::text('sub_num', null,['class' => 'mdl-textfield__input', 'placeholder' => '1']) !!}
            </div>--}}

            <!-- time -->
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {{--{!! Form::label('time', 'Time : ', ['class' => 'mdl-textfield__label']) !!}--}}
                {!! Form::date('time', \Carbon\Carbon::now()) !!}
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                {!! Form::label('code', 'Code : ', ['class' => 'mdl-textfield__label']) !!}
                {!! Form::textarea('code', null,['class' => 'mdl-textfield__input', 'placeholder' => 'paste your demo code here']) !!}
            </div>

            {!! Form::submit('Add Submission', ['class'=>'btn btn-success form-control']) !!}

        {!! Form::close() !!}
    </div>
@stop
