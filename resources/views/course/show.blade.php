@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col center">
        <h1>Course Detail</h1>
    </div>
    <div class="mdl-cell mdl-cell--4-col">
        <img src="{{ $course->image }}" alt="Teacher Image" class="article-image" border="0"/>
    </div>

    <div class="mdl-cell mdl-cell--8-col mdl-card mdl-shadow--2dp
        @if($course->status == 'inactive') disable-card @endif">

        <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">{{ $course->name }}</h2>
        </div>
        <div class="mdl-card__supporting-text mdl-card--expand">
            <p>
                <b>ID:</b> {{ $course->id }}<br>
                <b>Color:</b> {{ $course->color }}<br>
                <b>Status:</b> {{ $course->status }}
            </p>
        </div>
        <div class="mdl-card__actions mdl-card--border">
            <a href="{{ url('course/'.$course->id.'/edit') }}"
               class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                edit
            </a>
            <a href="{{ url('course/'.$course->id.'/status') }}"
               class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                @if($course->status == 'active')
                    inactive
                @else
                    active
                @endif
            </a>
        </div>
        <div class="mdl-card__menu">
            {!! Form::model($course, ['method' => 'DELETE', 'url'=>'course/'.$course->id]) !!}
            <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit">
                <i class="material-icons">cancel</i>
            </button>
            {!! Form::close() !!}
        </div>
    </div>
    @php
        $rgb = explode(':', $course->color)
    @endphp
    <div class="mdl-cell mdl-cell--2-col mdl-card mdl-shadow--2dp little-card" style="background: rgb({{ $rgb[0] }},{{ $rgb[1] }},{{ $rgb[2] }})">
        <div class="mdl-card__title">
            Students
        </div>
        <div class="mdl-card__supporting-text">
            <h1>{{ $course->students_count }}</h1>
        </div>
    </div>

    <div class="mdl-cell mdl-cell--2-col mdl-card mdl-shadow--2dp little-card" style="background: rgb({{ $rgb[0] }},{{ $rgb[1] }},{{ $rgb[2] }})">
        <div class="mdl-card__title">
            Teachers
        </div>
        <div class="mdl-card__supporting-text">
            <h1>{{ $course->teachers_count }}</h1>
        </div>
    </div>

    <div class="mdl-cell mdl-cell--2-col mdl-card mdl-shadow--2dp little-card" style="background: rgb({{ $rgb[0] }},{{ $rgb[1] }},{{ $rgb[2] }})">
        <div class="mdl-card__title">
            Lessons
        </div>
        <div class="mdl-card__supporting-text">
            <h1>{{ $course->lessons_count }}</h1>
        </div>
    </div>

    <div class="mdl-cell mdl-cell--2-col mdl-card mdl-shadow--2dp little-card" style="background: rgb({{ $rgb[0] }},{{ $rgb[1] }},{{ $rgb[2] }})">
        <div class="mdl-card__title">
            Badges
        </div>
        <div class="mdl-card__supporting-text">
            <h1>{{ $course->badges_count }}</h1>
        </div>
    </div>

    <div class="mdl-cell mdl-cell--2-col mdl-card mdl-shadow--2dp little-card" style="background: rgb({{ $rgb[0] }},{{ $rgb[1] }},{{ $rgb[2] }})">
        <div class="mdl-card__title">
            Announcements
        </div>
        <div class="mdl-card__supporting-text">
            <h1>{{ $course->announcements_count }}</h1>
        </div>
    </div>

    <hr>

    <div class="mdl-cell mdl-cell--12-col center">
        <h2>Student Members</h2>
    </div>
    @foreach($course->students as $student)
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet mdl-card mdl-shadow--2dp
            @if($student->pivot->status == 'disable') disable-card @endif">

            <div class="mdl-card__media" style="background-color: #FFFFFF">
                <img src="{{ url('api/image/'.$student->image) }}" alt="Student Image" class="article-image" border="0"/>
            </div>
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">{{ $student->name }}</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <p>
                    <b>ID:</b> {{ $student->student_id }}<br>
                    <b>Progress:</b> <h3><b>{{ $student->pivot->progress }}%</b></h3>
                </p>
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a href="{{ url('student/'.$student->id) }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    view
                </a>

                <a href="{{ url('student_course/'.$student->id.'/'.$course->id.'/status') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    @if($student->pivot->status == 'enable')
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
        <h2>Teacher Members</h2>
    </div>
    @foreach($course->teachers as $teacher)
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet mdl-card mdl-shadow--2dp
            @if($teacher->pivot->status == 'disable') disable-card @endif">

            <div class="mdl-card__media" style="background-color: #FFFFFF">
                <img src="{{ url('api/image/'.$teacher->image) }}" alt="Student Image" class="article-image" border="0"/>
            </div>
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">{{ $teacher->name }}</h2>
            </div>
            <div class="mdl-card__supporting-text">
                ID: {{ $teacher->id }}
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    view
                </a>
                <a href="{{ url('teacher_course/'.$teacher->id.'/'.$course->id.'/status') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    @if($teacher->pivot->status == 'enable')
                        inactive
                    @else
                        active
                    @endif
                </a>
            </div>
        </div>
    @endforeach
    <div class="mdl-cell mdl-cell--12-col right">
        <a href="{{ url('api/course/add_teacher_member') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>

    <hr>

    <div class="mdl-cell mdl-cell--12-col center">
        <h1>Course Lessons</h1>
    </div>
    @foreach($course->lessons as $lesson)
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet mdl-card mdl-shadow--2dp
                @if($lesson->status == 'true')
                demo-card-event
            @else
                demo-card-event2
        @endif">
            <div class="mdl-card__title mdl-card--expand">
                <h4>{{ $lesson->name }}</h4><br>
            </div>
            <div class="mdl-card__supporting-text">
                ID: {{ $lesson->id }}<br>
                Course ID: {{ $lesson->course_id }}<br>
                Status: {{ $lesson->status }}<br>
                Order: {{ $lesson->order }}<br>
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a href="{{ url('lesson/'.$lesson->id) }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    View
                </a>
                <div class="mdl-layout-spacer"></div>
                <a href="{{ url('lesson/'.$lesson->id.'/edit') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    edit
                </a>
                <div class="mdl-layout-spacer"></div>
                {!! Form::model($lesson, ['method' => 'DELETE', 'url'=>'lesson/'.$lesson->id]) !!}
                <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit">
                    <i class="material-icons">cancel</i>
                </button>
                {!! Form::close() !!}
            </div>
        </div>
    @endforeach
    <div class="mdl-cell mdl-cell--12-col right">
        <a href="{{ url('lesson/create') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>

    <hr>

    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '1210331272313647',
                xfbml      : true,
                version    : 'v2.6'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <div class="mdl-cell mdl-cell--12-col center">
        <h1>Course Badges</h1>
    </div>
    @foreach($course->badges as $badge)
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
                <a href="{{ url('badge/'.$badge->id.'/edit') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    edit
                </a>
            </div>
            <div class="mdl-card__menu">
                {!! Form::model($badge, ['method' => 'DELETE', 'url'=>'badge/'.$badge->id]) !!}
                <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit">
                    <i class="material-icons">cancel</i>
                </button>
                {!! Form::close() !!}
            </div>
        </div>
        <script>
            document.getElementById('{{ $badge->id }}').onclick = function() {
                FB.ui({
                    method: 'share',
                    display: 'popup',
                    href: 'http://mikaelcv.herokuapp.com/MyCV.html',
                    // Todo change above link
                }, function(response){});
            }
        </script>
    @endforeach
    <div class="mdl-cell mdl-cell--12-col right">
        <a href="{{ url('badge/create') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>


    <div class="mdl-cell mdl-cell--12-col center">
        <h1>Course Announcements</h1>
    </div>
    @foreach($course->announcements as $announcement)
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet demo-card-event mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand">
                <h4>{{ $announcement->title }}</h4><br>
            </div>
            <div class="mdl-card__supporting-text">
                Content: {{ $announcement->content }}<br>
                Course_id: {{ $announcement->course_id }}<br>
                Priority: {{ $announcement->priority }}<br>
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a href="{{ url('announcement/'.$announcement->id) }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    View
                </a>
                <div class="mdl-layout-spacer"></div>
                <a href="{{ url('announcement/'.$announcement->id.'/edit') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    edit
                </a>
                <div class="mdl-layout-spacer"></div>
                {!! Form::model($announcement, ['method' => 'DELETE', 'url'=>'announcement/'.$announcement->id]) !!}
                <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit">
                    <i class="material-icons">cancel</i>
                </button>
                {!! Form::close() !!}
            </div>
        </div>
    @endforeach
    <div class="mdl-cell mdl-cell--12-col right">
        <a href="{{ url('announcement/create') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>
@stop