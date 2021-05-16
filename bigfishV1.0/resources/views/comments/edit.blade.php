@extends('layouts.index')
<title>Bigfish &#8226; Edit Post </title>
@section('content')
    <div class="whole-wrap" style="margin-top:80px;">
        <div class="container">


            <div class="section-top-border">
                <div class="row">
                    <div class="col-lg-8 col-md-8 m-auto">
                        @if(session()->has('comment_updated'))
                            <div class="alert alert-success" role="alert">
                                {{session('comment_updated')}}
                            </div>
                        @endif
                        @if(session()->has('nothing_updated'))
                            <div class="alert alert-success" role="alert">
                                {{session('nothing_updated')}}
                            </div>
                        @endif
                        <h3 class="mb-30 title_color">Edit Post</h3>


                        <form action="{{route('comment.update', $comment->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mt-10">
                                <textarea class="single-textarea" name="body" placeholder="Description" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Description'">{{$comment->body}}</textarea>
                            </div>

                            <div class="mt-10 float-right">
                                <button class="genric-btn primary circle arrow" type="submit" >Edit <span class="lnr lnr-arrow-right"></span></button>

                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
