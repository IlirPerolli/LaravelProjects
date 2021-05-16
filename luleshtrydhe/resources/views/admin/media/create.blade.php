@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css">
@endsection
@section('content')

    <h1>Media create</h1>
        {!! Form::open(['method' => 'post', 'action'=>'AdminMediasController@store', 'class'=>'dropzone']) !!}

            {!! Form::close() !!}

    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
    @endsection
@endsection
