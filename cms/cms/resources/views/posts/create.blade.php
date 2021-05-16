@extends('layouts.app')

@section('content')
    <h1> Create post</h1>



    {!! Form::open(['method' => 'post', 'action'=>'PostsController@store', 'files'=>'true']) !!}



    <div class="form-group">
        {!! Form::label('title', 'Title') !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
    </div><br>

    <div class="form-group">
        {!! Form::file('file', ['class'=>'form-control']) !!}
    </div>
<br>
        <div class="form-group">
        {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}
@endsection
@if(count($errors)>0)
    <div class="alert alert-danger">
    <ul>
    @foreach($errors->all() as $error)

            <li> {{$error}}</li>

        @endforeach
    </ul>

    </div>
    @endif

@section('footer')
@endsection
