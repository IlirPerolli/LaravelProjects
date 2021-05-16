@extends('layouts.index')
@section('styles')
    <style>body{
            background: #F9F9FF;
        }
        @media screen and (max-width: 340px) {
            .card{
                width:100% !important;
            }

        }
        @media screen and (max-width: 640px){
            .author_img{
                margin:0!important;
                width: 90% !important;
                margin: auto !important;
            }
            .media{
                width: 100%;
                margin: 0!important;
                display: inline-block;
            }
            .media-body{
                margin: 0!important;
                margin-top: 15px!important;
                width: 90% !important;
            }

        }

        @media screen and (max-width: 940px){
            .media{
                width: auto !important;
            }
        }
    </style>
@endsection
@section('title')
    <title>{{$user->name . " ". $user->surname}} &#8226; Profile</title>
@endsection

@section('content')


{{--@include('includes.profile_banner_area')--}}
{{--<div class="card" style="width: 18rem; margin: 0 auto; float: none; margin-top: 140px; ">--}}
{{--    <img class="card-img-top" src="{{$user->photo->photo}}" alt="Card image cap">--}}
{{--    <div class="card-body">--}}

{{--        <h5 class="card-title text-center">{{"@".$user->username}}</h5>--}}


{{--        <h6 style="color:black; text-align: center">Posts {{$user_posts}} | <a href="{{route('followings',$user->slug)}}" style="color:black">Following {{$followings}}</a> | <a href="{{route('followers',$user->slug)}}" style="color:black">Followers {{$followers}}</a></h6>--}}
{{--        <h5 class="card-title text-center font-weight-bold" style="color:black; font-size: 18px;">{{$user->name . " ". $user->surname}}</h5>--}}
{{--        <p class="card-text text-center">{{$user->bio}}</p>--}}

{{--        <div style="margin:auto 0; text-align: center; margin-top:20px">--}}
{{--        @if(auth()->check() && auth()->user()->id != $user->id)--}}

{{--            @if (auth()->user()->followings->contains($user->id))--}}
{{--                <form action="{{route('user.unfollow',$user->id)}}" method="post">--}}
{{--                    <hr>--}}
{{--                    @csrf--}}
{{--                    @method('post')--}}
{{--                    <button class="genric-btn primary radius" type="submit">Following</button>--}}
{{--                </form>--}}
{{--                <br>--}}
{{--                --}}{{--                                    @if(session('success_follow'))--}}
{{--                --}}{{--                                        <div class="alert alert-success">{{session('success_follow')}}</div>--}}
{{--                --}}{{--                                    @endif--}}

{{--                @if(session('user_error'))--}}
{{--                    <div class="alert alert-danger">{{session('user_error')}}</div>--}}
{{--                @endif--}}
{{--            @else--}}
{{--                <form action="{{route('user.follow',$user->id)}}" method="post">--}}
{{--                    <hr>--}}
{{--                    @csrf--}}
{{--                    @method('post')--}}
{{--                    <button class="genric-btn primary radius" type="submit">Follow</button>--}}
{{--                </form>--}}
{{--                <br>--}}
{{--                --}}{{--                                @if(session('success_unfollow'))--}}
{{--                --}}{{--                                <div class="alert alert-success">{{session('success_unfollow')}}</div>--}}
{{--                --}}{{--                                    @endif--}}
{{--                @if(session('user_error'))--}}
{{--                    <div class="alert alert-danger">{{session('user_error')}}</div>--}}
{{--                @endif--}}

{{--            @endIf--}}

{{--        @endIf--}}
{{--        @if(auth()->guest())--}}
{{--            <form action="{{route('user.follow',$user->id)}}" method="post">--}}
{{--                <hr>--}}
{{--                @csrf--}}
{{--                @method('post')--}}
{{--                <button class="genric-btn primary radius" type="submit">Follow</button>--}}
{{--            </form>--}}
{{--        @endif--}}

{{--       </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="col-lg-6 col-12 m-auto" style="margin-top: 140px!important;">
    <div class="media m-auto" style=" width: 500px">
    <img class="align-self-center mr-3 rounded-circle author_img" src="{{$user->photo->photo}}" alt="Generic placeholder image rounded-circle" alt="{{$user->name . " ". $user->surname}}" width="200px" height="200px">

        <div class="media-body ml-2">
        <h5 class="mt-0">{{"@".$user->username}}</h5>

        <h6 style="color:black;">Posts {{$user_posts}} | <a href="{{route('followings',$user->slug)}}" style="color:black">Following {{$followings}}</a> | <a href="{{route('followers',$user->slug)}}" style="color:black">Followers {{$followers}}</a></h6>
        <h5 class="mt-0">{{$user->name . " ". $user->surname}}</h5>
        <p>{{$user->bio}}</p>
        <div style="margin:auto 0; text-align: left; margin-top:20px">
            @if(auth()->check() && auth()->user()->id != $user->id)

                @if (auth()->user()->followings->contains($user->id))
                    <form action="{{route('user.unfollow',$user->id)}}" method="post">

                        @csrf
                        @method('post')
                        <button class="genric-btn primary radius" type="submit">Following</button>
                    </form>
                    <br>
                    {{--                                    @if(session('success_follow'))--}}
                    {{--                                        <div class="alert alert-success">{{session('success_follow')}}</div>--}}
                    {{--                                    @endif--}}

                    @if(session('user_error'))
                        <div class="alert alert-danger">{{session('user_error')}}</div>
                    @endif
                @else
                    <form action="{{route('user.follow',$user->id)}}" method="post">

                        @csrf
                        @method('post')
                        <button class="genric-btn primary radius" type="submit">Follow</button>
                    </form>
                    <br>
                    {{--                                @if(session('success_unfollow'))--}}
                    {{--                                <div class="alert alert-success">{{session('success_unfollow')}}</div>--}}
                    {{--                                    @endif--}}
                    @if(session('user_error'))
                        <div class="alert alert-danger">{{session('user_error')}}</div>
                    @endif

                @endIf

            @endIf
            @if(auth()->guest())
                <form action="{{route('user.follow',$user->id)}}" method="post">

                    @csrf
                    @method('post')
                    <button class="genric-btn primary radius" type="submit">Follow</button>
                </form>
            @endif

        </div>

    </div>
</div>
</div>
    <div class="col-lg-6 m-auto">
        @if(session()->has('deleted_post'))<br>
        <div class="alert alert-danger" role="alert">
            {{session('deleted_post')}}
        </div>
        @endif
    </div>



@include('includes.profile_gallery_area')
@endsection
@section('scripts')
    <script type="text/javascript">
        var cw = $('.author_img').width();
        $('.author_img').css({
            'height': cw + 'px'
        });
    </script>
@endsection
