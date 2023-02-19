@extends('layout')
@php
$title = 'Please upload a picture of your favorite kitten';
@endphp

@section('title', $title)
@section('content')
    <div class="container">
        <main>
            <form class="needs-validation" novalidate method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" class="form-control" id="file" name="file" placeholder="" value="" required>
                    </div>
                </div>

                <button class="btn btn-primary btn mt-3" type="submit">Upload</button>
            </form>
        </main>
    </div>
@endsection
