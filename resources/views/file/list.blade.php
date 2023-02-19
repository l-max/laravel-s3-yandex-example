@extends('layout')
@php
    $title = 'List of uploaded pictures';
@endphp

@section('title', $title)
@section('content')
<div class="container">
    <main>
        <a class="btn btn-primary mb-2" href="/upload-file" role="button">Upload your picture.</a>
        <br>

        <ul class="list-group">
            @foreach ($files as $file)
                <li class="list-group-item"><a href="{{ $file->url }}">{{ $file->file_name }}</a> ({{ $file->size }} bytes)</li>
            @endforeach
        </ul>
    </main>
</div>
@endsection
