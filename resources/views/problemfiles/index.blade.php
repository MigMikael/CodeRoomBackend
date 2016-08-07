@extends('template')

@section('content')

    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--2-col"></div>
        <div class="mdl-cell mdl-cell--8-col">
            {!! Form::open(['url'=>'problemfile/add', 'files' => true]) !!}
            <div class="form-group mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell--5-col">
                {!! Form::text('filename', null, ['class' => 'form-control mdl-textfield__input']) !!}

                <label for="filename" class="mdl-textfield__label">Problem Name</label>
            </div>

            <div class="form-group mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell--5-col">
                {!! Form::text('package', null, ['class' => 'form-control mdl-textfield__input']) !!}

                <label for="package" class="mdl-textfield__label">Package Name</label>
            </div>

            {!! Form::file('filefield') !!}

            <div class="form-group mdl-cell mdl-cell--12-col">
                {!! Form::submit('Add Problem', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="mdl-cell mdl-cell--2-col"></div>
    </div>

    <h1> File list</h1>
    <div class="row">
        <ul class="thumbnails">
            @foreach($problemFiles as $problemFile)
                <div class="col-md-2">
                    <div class="thumbnail">
                        @if($problemFile->mime == 'application/zip')
                            <img src="../zipfilelogo.jpg" alt="ALT NAME" class="img-responsive" />
                        @else
                            <img src="{{route('getfile', str_replace('.','_',$problemFile->filename))}}" alt="ALT NAME" class="img-responsive" />
                        @endif
                        <div class="caption">
                            <p>{{$problemFile->original_filename}}</p>
                            <a href="{{route('getfile', str_replace('.','_',$problemFile->filename))}}">Download</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </ul>
    </div>

@endsection