@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col center">
        <h1>{{ $course->name }}</h1>
    </div>
    <div class="mdl-cell mdl-cell--6-col">
        <img src="{{ $course->image }}" alt="Teacher Image" class="article-image" border="0"/>
    </div>
    <div class="mdl-cell mdl-cell--6-col">
        <h2 class="mdl-card__title-text">{{ $course->name }}</h2>
        <p>ID: {{ $course->id }}</p>
    </div>
    <hr>

    <div class="mdl-cell mdl-cell--12-col center">
        <h2>Student Member</h2>
    </div>
    @foreach($course->students as $student)
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet mdl-card mdl-shadow--2dp">
            <div class="mdl-card__media" style="background-color: #FFFFFF">
                <img src="{{ url('api/image/'.$student->image) }}" alt="Student Image" class="article-image" border="0"/>
            </div>
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">{{ $student->name }}</h2>
            </div>
            <div class="mdl-card__supporting-text">
                ID: {{ $student->student_id }}
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    view
                </a>

                <a href="{{ url('api/student_course/delete/'.$student->student_id.'/'.$course->id) }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    delete
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
        <h2>Teacher Member</h2>
    </div>
    @foreach($course->teachers as $teacher)
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet mdl-card mdl-shadow--2dp">
            <div class="mdl-card__media" style="background-color: #FFFFFF">
                <img src="{{ url('api/image/'.$teacher->image) }}" alt="Student Image" class="article-image" border="0"/>
            </div>
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">{{ $teacher->name }}</h2>
            </div>
            <div class="mdl-card__supporting-text">
                ID: {{ $teacher->student_id }}
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    view
                </a>
            </div>
        </div>
    @endforeach

    <div class="mdl-cell mdl-cell--12-col right">
        <a href="{{ url('api/course/add_teacher_member') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>
@stop