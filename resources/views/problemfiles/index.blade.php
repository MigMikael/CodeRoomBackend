@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col center">
        <h1>All ProblemFile</h1>
    </div>
    @foreach($problemFiles as $problemFile)
        <div class="mdl-cell mdl-cell--3-col mdl-cell--2-col-phone mdl-cell--2-col-tablet demo-card-event mdl-card mdl-shadow--2dp">
            <div class="mdl-card__media">
                @if($problemFile->mime == 'application/zip')
                    <img src="../zipfilelogo.jpg" alt="Zip File Image" class="article-image" border="0"/>
                @else
                    <img src="{{route('getfile', str_replace('.','_',$problemFile->filename))}}" alt="Actual Image" class="article-image" border="0"/>
                @endif
            </div>
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">{{ $problemFile->original_filename }}</h2>
            </div>
            <div class="mdl-card__supporting-text">
                {{ $problemFile->filename }}
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect"
                   href="{{ route('getfile', str_replace('.','_',$problemFile->filename)) }}">
                    Download
                </a>
            </div>
        </div>
    @endforeach
    <div class="mdl-cell mdl-cell--12-col right">
        <a href="{{ url('problemfile/create') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>
@endsection