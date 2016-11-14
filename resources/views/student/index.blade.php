@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col center">
        <h1>All Student</h1>
    </div>
    <hr>
    @foreach($students as $student)
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet mdl-card mdl-shadow--2dp">
            <div class="mdl-card__media" style="background-color: #FFFFFF">
                <img src="{{ url('api/image/'. $student->image) }}" alt="Teacher Image" class="article-image" border="0"/>
            </div>
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">{{ $student->name }}</h2>
            </div>
            <div class="mdl-card__supporting-text">
                ID: {{ $student->student_id }}
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a href="{{ url('student/'.$student->id) }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    view
                </a>

                <a href="{{ url('student/'.$student->id.'/edit') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    edit
                </a>
            </div>
            <div class="mdl-card__menu">
                {!! Form::model($student, ['method' => 'DELETE', 'url'=>'student/'.$student->id]) !!}
                <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit">
                    <i class="material-icons">cancel</i>
                </button>
                {!! Form::close() !!}
            </div>
        </div>
    @endforeach
    <div class="mdl-cell mdl-cell--12-col right">
        <a href="{{ url('student/create') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>


@stop