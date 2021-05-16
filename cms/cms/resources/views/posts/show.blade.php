@extends('layouts.app')

@section('content')
    <a href="{{route('posts.edit', $post->id)}}"> {{$post->title}}</a>
@endsection

@section('footer')
@endsection
