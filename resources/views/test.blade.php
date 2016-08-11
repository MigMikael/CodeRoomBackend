@extends('template')

@section('content')
    <form action="http://localhost:8888/problemfile/add" method="post" enctype="multipart/form-data">
        <input type="text" name="filename" />
        <input type="text" name="package" />
        File: <input type="file" name="filefield">
        <input type="submit" value="send">
    </form>
@stop