@extends('layouts.index')
<title>Bigfish &#8226; Create Posts </title>
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css">

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
                        <h3 class="mb-30 title_color">Add Posts</h3>
                    <form action="{{route('post.store.multiple')}}" method="post" class="dropzone" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                    </form>


                    </div>

                </div>
            </div>

    </div>


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
@endsection
