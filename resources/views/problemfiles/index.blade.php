@extends('template')
@section('content')

    <form action="{{route('addfile', [])}}" method="post" enctype="multipart/form-data">
        <input type="file" name="filefield">
        <input type="submit">
    </form>

    <h1> Pictures list</h1>
    <div class="row">
        <ul class="thumbnails">
            @foreach($problemFiles as $problemFile)
                <div class="col-md-2">
                    <div class="thumbnail">
                        <img src="{{route('getfile', str_replace('.','_',$problemFile->filename))}}" alt="ALT NAME" class="img-responsive" />
                        <div class="caption">
                            <p>{{$problemFile->filename}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </ul>
    </div>

@endsection