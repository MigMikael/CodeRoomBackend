@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col center">
        <h1>All Submission</h1>
    </div>

    @foreach($submissions as $submission)
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet demo-card-event mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand">
                <h4>{{ $submission->id }}</h4>
            </div>
            <div class="mdl-card__supporting-text">
                <b>User ID :</b> {{ $submission->user_id }}<br>
                <b>Problem ID :</b> {{ $submission->prob_id }}<br>
                <b>Submission No :</b> {{ $submission->sub_num }}<br>
                <b>Time :</b> {{ $submission->time }}<br>
                <b>Code :</b> {{ $submission->code }}
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="">
                    View
                </a>
                <div class="mdl-layout-spacer"></div>
                <i class="material-icons">subject</i>
            </div>
        </div>
        {{--<h5><strong>ID : </strong>{{ $submission->id }}</h5>
        <h5><strong>User ID : </strong>{{ $submission->user_id }}</h5>
        <h5><strong>Problem ID : </strong>{{ $submission->prob_id }}</h5>
        <h5><strong>Submission Number : </strong>{{ $submission->sub_num }}</h5>
        <h5><strong>Time : </strong>{{ $submission->time }}</h5>
        <h5><strong>Code : </strong>{{ $submission->code }}</h5>
        <hr>--}}
    @endforeach
    <div class="mdl-cell mdl-cell--12-col right">
        <a href="{{ url('submissions/create') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>
@stop
