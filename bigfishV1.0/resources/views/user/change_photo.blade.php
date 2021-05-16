@extends('layouts.index')
@section('styles')
    <style>

        @media screen and (max-width: 340px) {
            .author_img{
                width:100% !important;
            }
        }


    </style>
@endsection
@section('content')
    <title>{{$user->name . " ". $user->surname}} &#8226; Profile</title>
    @include('includes.profile_banner_area')


    <!-- Start Align Area -->
    <div class="whole-wrap">
        <div class="container">


            <div class="section-top-border">
                <div class="row">

                    <div class="col-lg-6 col-md-6 mt-sm-30 element-wrap m-auto">
                        <div class="blog_right_sidebar" style="width:100%; height: auto">
                            <aside class="single_sidebar_widget author_widget">
                                <img class="author_img rounded-circle" src="{{$user->photo->photo}}" alt="" style="width:250px">

                                <div class="col-lg-12 col-md-12" style="margin:0 auto;">
                                        <h3 class="mb-30 mt-10 title_color">Edit Photo</h3>
                                    @if(session('updated_photo'))
                                        <div class="alert alert-success">
                                        {{session('updated_photo')}}
                                    </div>
                                @endif
                                        @if(session('deleted_photo'))
                                            <div class="alert alert-danger">
                                                {{session('deleted_photo')}}
                                            </div>
                                        @endif
                                        @if(auth()->user()->photo_id != 1)
                                        <form action="{{route('user.photo.destroy')}}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="mt-10">
                                                <button class="genric-btn link" type="submit" name="remove_photo" style="text-decoration: none" >Remove photo</button>
                                            </div>

                                        </form>
                                    @endif
                                    <form action="{{route('user.photo.update')}}" method="POST" enctype="multipart/form-data" style="width: 100% !important;">
                                        @csrf
                                        @method('PATCH')
                                        <div class="mt-10">
                                            <input type="file" name="photo_id" class="single-input">
                                        </div>
                                        @error('photo_id')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror


                                        <div class="mt-10 float-right">
                                            <button class="genric-btn primary circle arrow" type="submit" >Ndrysho <span class="lnr lnr-arrow-right"></span></button>
                                        </div>
                                        <br>
                                        <br>
                                    </form>
                                </div>

                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- End Align Area -->
@endsection
@section('scripts')
    <script type="text/javascript">
        var cw = $('.author_img').width();
        $('.author_img').css({
            'height': cw + 'px'
        });
    </script>
@endsection
