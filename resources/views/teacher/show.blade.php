@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col center">
        <h1>{{ $teacher->name }}</h1>
    </div>
    <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--2dp">
        <img src="{{ url('api/image/'. $teacher->image) }}" alt="Teacher Image" class="article-image" border="0"/>
    </div>

    <div class="mdl-cell mdl-cell--8-col mdl-card mdl-shadow--2dp">
        <div class="mdl-card__supporting-text mdl-card--expand">
            <p><b>Username:</b> {{ $teacher->username }}</p><br>
        </div>
        <div class="mdl-card__actions mdl-card--border">
            <a href="{{ url('teacher/'.$teacher->id.'/edit') }}"
               class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                edit
            </a>
        </div>
        <div class="mdl-card__menu">
            {!! Form::model($teacher, ['method' => 'DELETE', 'url'=>'teacher/'.$teacher->id]) !!}
            <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit">
                <i class="material-icons">cancel</i>
            </button>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="mdl-cell mdl-cell--12-col mdl-card little-card" style="background: #3E4EB8">
        <div class="mdl-card__title">
            Courses
        </div>
        <div class="mdl-card__supporting-text">
            <h1>{{ $teacher->courses_count }}</h1>
        </div>
    </div>

    <hr>

    <div class="mdl-cell mdl-cell--12-col center">
        <h2>Course Member</h2>
    </div>
    @foreach($teacher->courses as $course)
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet mdl-card mdl-shadow--2dp
            @if($course->pivot->status == 'inactive') disable-card @endif">

            <div class="mdl-card__media" style="background-color: #FFFFFF">
                <img src="{{ $course->image }}" alt="Teacher Image" class="article-image" border="0"/>
            </div>
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">{{ $course->name }}</h2>
            </div>
            <div class="mdl-card__supporting-text">

            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a href="{{ url('course/'.$course->id) }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    view
                </a>

                <a href="{{ url('teacher_course/'.$teacher->id.'/'.$course->id.'/status') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    @if($course->pivot->status == 'active')
                        inactive
                    @else
                        active
                    @endif
                </a>
            </div>
        </div>
    @endforeach
    <div class="mdl-cell mdl-cell--12-col right">
        <a href="{{ url('') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>
@stop