@extends('template')

@section('content')
    <h1>All Problems</h1>
    <hr>

    @foreach($problems as $problem)
        <h5>{{ $problem->name }}</h5>
        <hr>
    @endforeach

    <h2>
        <a href="{{ url('problems/create') }}" class="btn btn-primary">new demo problem</a>
    </h2>

@endsection