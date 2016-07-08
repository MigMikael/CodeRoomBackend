@extends('template')

@section('content')
    <h1>All Problems</h1>
    <hr>

    @foreach($problems as $problem)

        <hr>
    @endforeach

    <h2>
        <a href="{{ url('problems/create') }}" class="btn btn-primary">add new demo result</a>
    </h2>

@endsection