@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col center">
        <h1>{{ $student->name }}</h1>
    </div>
    <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--2dp">
        <img src="{{ url('api/image/'. $student->image) }}" alt="Teacher Image" class="article-image" border="0"/>
    </div>

    <div class="mdl-cell mdl-cell--8-col mdl-card mdl-shadow--2dp">
        <div class="mdl-card__supporting-text mdl-card--expand">
            <p><b>ID:</b> {{ $student->student_id }}</p><br>
            <p><b>Username:</b> {{ $student->username }}</p><br>
        </div>
        <div class="mdl-card__actions mdl-card--border">
            <a href="{{ url('student/'.$student->id.'/edit') }}"
               class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
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

    <div class="mdl-cell mdl-cell--6-col mdl-card little-card" style="background: #3E4EB8">
        <div class="mdl-card__title">
            Courses
        </div>
        <div class="mdl-card__supporting-text">
            <h1>{{ $student->courses_count }}</h1>
        </div>
    </div>

    <div class="mdl-cell mdl-cell--6-col mdl-card little-card" style="background: #3E4EB8">
        <div class="mdl-card__title">
            Badge
        </div>
        <div class="mdl-card__supporting-text">
            <h1>{{ $student->badges_count }}</h1>
        </div>
    </div>

    <hr>

    <div class="mdl-cell mdl-cell--12-col center">
        <h2>Course Member</h2>
    </div>
    @foreach($student->courses as $course)
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet mdl-card mdl-shadow--2dp
            @if($course->pivot->status == 'inactive') disable-card @endif">

            <div class="mdl-card__media" style="background-color: #FFFFFF">
                <img src="{{ $course->image }}" alt="Teacher Image" class="article-image" border="0"/>
            </div>
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">{{ $course->name }}</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <h6>Progress:</h6>
                <h1>{{ $course->pivot->progress }}%</h1>
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a href="{{ url('course/'.$course->id) }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    view
                </a>

                <a href="{{ url('student_course/'.$student->id.'/'.$course->id.'/status') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
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
        <a href="{{ url('api/course/add_student_member') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>

    <hr>

    <div class="mdl-cell mdl-cell--12-col center">
        <h1>Badges</h1>
    </div>
    @foreach($student->badges as $badge)
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet mdl-card mdl-shadow--2dp">
            <div class="mdl-card__media">
                <img src="{{ url('api/image/'.$badge->image) }}" alt="Badge Image" class="article-image" border="0"/>
            </div>
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">{{ $badge->name }}</h2>
            </div>
            <div class="mdl-card__supporting-text">
                {{ $badge->description }}
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <div id="{{ $badge->id }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    share
                </div>
            </div>
            <div class="mdl-card__menu">
                <a href="{{ url('student_badge/'.$student->id.'/'.$badge->id.'/delete') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    <i class="material-icons">cancel</i>
                </a>
            </div>
        </div>
    @endforeach
    <div class="mdl-cell mdl-cell--12-col right">
        <a href="{{ url('badge_student/create') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>
@stop