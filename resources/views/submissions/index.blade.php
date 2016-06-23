@extends('template')

@section('content')
    <h1>All Submissions</h1>

    <hr>
    @foreach($submissions as $submission)
        <h5><strong>ID : </strong>{{ $submission->id }}</h5>
        <h5><strong>User ID : </strong>{{ $submission->user_id }}</h5>
        <h5><strong>Problem ID : </strong>{{ $submission->prob_id }}</h5>
        <h5><strong>Submission Number : </strong>{{ $submission->sub_num }}</h5>
        <h5><strong>Time : </strong>{{ $submission->time }}</h5>
        <h5><strong>Code : </strong>{{ $submission->code }}</h5>
        <hr>
    @endforeach

    <h2>
        <a href="{{ url('submissions/create') }}">add new demo submission</a>
    </h2>
@stop
