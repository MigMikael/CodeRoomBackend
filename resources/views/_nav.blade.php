<nav class="mdl-navigation">
    <a class="mdl-navigation__link" href="{{ url('/') }}"><strong>Home</strong></a>
    <hr>
    <a class="mdl-navigation__link" href="{{ url('course') }}">Course</a>
    <a class="mdl-navigation__link" href="{{ url('announcement') }}">Announcement</a>
    <a class="mdl-navigation__link" href="{{ url('lesson') }}">Lesson</a>
    <a class="mdl-navigation__link" href="{{ url('badge') }}">Badge</a>
    <hr>
    <a class="mdl-navigation__link" href="{{ url('problem') }}">Problem</a>
    <a class="mdl-navigation__link" href="{{ url('problem_analysis') }}">ProblemAnalysis</a>
    <hr>
    <a class="mdl-navigation__link" href="{{ url('submission') }}">Submission</a>
    <a class="mdl-navigation__link" href="{{ url('results') }}">Result</a>
    <hr>
    <a class="mdl-navigation__link" href="{{ url('teacher') }}">Teacher</a>
    <a class="mdl-navigation__link" href="{{ url('student') }}">Student</a>
    {{--<a class="mdl-navigation__link" href="{{ url('student_course') }}">StudentCourse</a>--}}
    {{--<a class="mdl-navigation__link" href="{{ url('teacher_course') }}">TeacherCourse</a>--}}
    <hr>
    @if (Auth::guest())
        <a class="mdl-navigation__link" href="{{ url('/login') }}">Login</a>
        <a class="mdl-navigation__link" href="{{ url('/register') }}">Register</a>
    @else
        <a class="mdl-navigation__link" href="#">{{ Auth::user()->name }}</a>
        <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
            <i class="material-icons">more_vert</i>
        </button>

        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
            for="demo-menu-lower-right">
            <a href="{{ url('/logout') }}"><li class="mdl-menu__item">Logout</li></a>
            <li disabled class="mdl-menu__item">Disabled Action</li>
        </ul>
    @endif
</nav>