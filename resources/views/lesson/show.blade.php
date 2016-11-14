@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
        <div class="mdl-card__title">
            <h2>{{ $lesson->name }}</h2>
        </div>
        <div class="mdl-card__supporting-text">
            <h6>Course Name: {{ $lesson->course->name }}</h6><br>
            Course ID: {{ $lesson->course_id }}<br>
            Status: {{ $lesson->status }}<br>
            Order: {{ $lesson->order }}<br>
            Problem Num:{{ $lesson->problems_count }}<br>
        </div>
        <div class="mdl-card__actions mdl-card--border">
            <a href="{{ url('lesson/'.$lesson->id.'/edit') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                edit
            </a>
        </div>
        <div class="mdl-card__menu">
            {!! Form::model($lesson, ['method' => 'DELETE', 'url'=>'lesson/'.$lesson->id]) !!}
            <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit">
                <i class="material-icons">cancel</i>
            </button>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="mdl-cell mdl-cell--12-col">
        <div class="mdl-card__title">
            <h4>Lesson Problem</h4>
        </div>
    </div>

    <table class="mdl-cell mdl-cell--12-col mdl-data-table mdl-js-data-table mdl-shadow--2dp">
        <thead>
        <tr>
            <th class="mdl-data-table__cell--non-numeric">Name</th>
            <th>Evaluator</th>
            <th>TimeLimit</th>
            <th>MemoryLimit</th>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lesson->problems as $problem)
            <tr>
                <td class="mdl-data-table__cell--non-numeric">{{ $problem->name }}</td>
                <td>{{ $problem->evaluator }}</td>
                <td>{{ $problem->timelimit }}</td>
                <td>{{ $problem->memorylimit }}</td>
                <td>
                    <a href="{{ url('problem/'.$problem->id) }}"
                       class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                        <i class="material-icons">launch</i>
                    </a>
                </td>
                <td>
                    <a href="{{ url('problem/'.$problem->id.'/edit') }}"
                       class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                        <i class="material-icons">border_color</i>
                    </a>
                </td>
                <td>
                    {!! Form::model($problem, ['method' => 'DELETE', 'url'=>'problem/'.$problem->id]) !!}
                    <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit">
                        <i class="material-icons">cancel</i>
                    </button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mdl-cell mdl-cell--12-col right">
        <a href="{{ url('problem/create') }}"
           class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>
@stop