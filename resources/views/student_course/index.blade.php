@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col center">
        <h1>All Student Course</h1>
    </div>
    <hr>
    @foreach($studentCourses as $studentCourse)
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet demo-card-event mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand">
                <h4>{{ $studentCourse->student_id }}</h4><br>
            </div>
            <div class="mdl-card__supporting-text">
                <b>Course ID :</b>{{ $studentCourse->course_id }}<br>
                <b>Progress :</b>{{ $studentCourse->progress }}<br>
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="">
                    View
                </a>
                <div class="mdl-layout-spacer"></div>
                <i class="material-icons">subject</i>
            </div>
        </div>
    @endforeach
    <div class="mdl-cell mdl-cell--12-col right">
        <a href="{{ url('student_course/create') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>


@stop