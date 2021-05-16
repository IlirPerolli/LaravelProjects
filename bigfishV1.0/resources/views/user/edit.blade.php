@extends('layouts.index')
@section('styles')
    <style>

            .author_img{
                width:100% !important;
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
                    <div class="col-lg-8 col-md-8">
                        @if(session()->has('updated_user'))
                            <div class="alert alert-success" role="alert">
                                {{session('updated_user')}}
                            </div>
                        @endif
                        <h3 class="mb-30 title_color">Edit Profile</h3>


                        <form action="{{route('user.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="mt-10">
                                <input type="text" name="name" placeholder="First Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'First Name'"  class="single-input" required value="{{$user->name}}">
                            </div>
                            @error('name')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div class="mt-10">
                                <input type="text" name="surname" placeholder="Last Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Last Name'" class="single-input" required value="{{$user->surname}}">
                            </div>
                            @error('surname')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div class="mt-10">
                                <input type="email" name="email" placeholder="Email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required class="single-input" value="{{$user->email}}">
                            </div>
                            @error('email')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div class="mt-10">
                                <textarea class="single-textarea" placeholder="Bio" name="bio" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Bio'">{{$user->bio}}</textarea>
                            </div>
                            @error('bio')
                            <span style="color:red">{{ $message }}</span>
                            @enderror

                            @error('photo_id')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
{{--                            <div class="mt-10">--}}
{{--                                <input type="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" class="single-input">--}}
{{--                            </div>--}}
                            <div class="mt-10 text-center">
                                <a href="{{route('user.password.edit')}}">Change password</a>
                            </div>

                            <div class="mt-10 float-right">
                                <button class="genric-btn primary circle arrow" type="submit" >Ndrysho <span class="lnr lnr-arrow-right"></span></button>

                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 col-md-4 mt-sm-30 element-wrap">
                        <div class="blog_right_sidebar">
                            <aside class="single_sidebar_widget author_widget">
                                <img class="author_img rounded-circle" src="{{$user->photo->photo}}" alt="" style="width:200px; height: 200px">
                                    <a href="{{route('user.photo.edit')}}">Edit photo</a>
                                <h4 style="margin-top: 10px!important;">{{$user->name . " ". $user->surname}}</h4>
                                <p>{{$user->bio}}</p>
                                <div class="social_icon">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-github"></i></a>
                                    <a href="#"><i class="fa fa-behance"></i></a>
                                </div>
                                <h6 style="color:black; text-align: center">Posts {{$user_posts}} | <a href="{{route('followings',$user->slug)}}" style="color:black">Following {{$followings}}</a> | <a href="{{route('followers',$user->slug)}}" style="color:black">Followers {{$followers}}</a></h6>
                                <p>{{$user->about}}</p>
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
