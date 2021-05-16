@extends('layouts.index')
@section('styles')
    <style>body{
            background: #F9F9FF;
        }
        </style>
        @endsection
@section('title')
    <title>Bigfish &#8226; Home </title>
    @endsection
@section('content')
    @if(@auth()->guest())
    <div class="container" style="margin-top: 150px;">
        <h1>NewsFeed</h1>

            <h4 class="text-center" style="margin-bottom: 50px">You need to login to see NewsFeed</h4>

    </div>
    @endif
@include('includes.home_gallery_area')

@endsection
