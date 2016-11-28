@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col center">
        <h1>All Submission</h1>
        <a href="{{ url('submission/create') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>

    <table class="mdl-cell mdl-cell--12-col mdl-data-table mdl-js-data-table mdl-shadow--2dp">
        <thead>
        <tr>
            <th class="mdl-data-table__cell--non-numeric">StudentID</th>
            <th>Username</th>
            <th>ProblemID</th>
            <th>SubNum</th>
            <th>SubTime</th>
            <th>View</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($submissions as $submission)
            <tr>
                <td class="mdl-data-table__cell--non-numeric">{{ $submission->student->student_id }}</td>
                <td>{{ $submission->student->username }}</td>
                <td>{{ $submission->problem_id }}</td>
                <td>{{ $submission->sub_num }}</td>
                <td>{{ $submission->created_at }}</td>
                <td>
                    <a href="{{ url('submission/'.$submission->id) }}"
                       class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" target="_blank">
                        <i class="material-icons">launch</i>
                    </a>
                </td>
                <td>
                    {!! Form::model($submission, ['method' => 'DELETE', 'url'=>'submission/'.$submission->id]) !!}
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

    </div>
@stop
