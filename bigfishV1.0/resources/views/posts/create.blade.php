@extends('layouts.index')
<title>Bigfish &#8226; Create Post </title>
@section('styles')
    <style>body{
            background: #F9F9FF;
        }
     </style>
@endsection
@section('content')

    <div class="whole-wrap" style="margin-top: 150px; margin-bottom: 150px">
        <div class="container">



                <div class="row">
                    <div class="col-lg-8 col-md-8 m-auto">
                        @if(session()->has('added_post'))
                            <div class="alert alert-success" role="alert">
                                {{session('added_post')}}
                            </div>
                        @endif
                            @error('photo_id')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        <h3 class="mb-30 title_color">Add Post</h3>


                        <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="mt-10">
                                <textarea class="single-textarea" name="body" placeholder="Description" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Description'"></textarea>
                            </div>
                            <div class="mt-10">
                                <input type="file" name="photo_id" class="single-input">
                            </div>
                            <div class="mt-10 float-right">
                                <button class="genric-btn primary circle arrow" type="submit" >Create <span class="lnr lnr-arrow-right"></span></button>

                            </div>

                        </form>
                    </div>

                </div>

        </div>
    </div>

@endsection
