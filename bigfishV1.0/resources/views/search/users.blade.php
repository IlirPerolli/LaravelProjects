@extends('layouts.index')
<title>Bigfish &#8226; Search </title>
@section('styles')
    <style>body{
            background: #F9F9FF;
        }
        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: black !important;
            opacity: 1; /* Firefox */
        }

        :-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: black !important;
        }

        ::-ms-input-placeholder { /* Microsoft Edge */
            color: black !important;
        }</style>
@endsection
@section('content')


    <!-- Start Align Area -->
    <div class="whole-wrap" style="margin-top: 150px; margin-bottom: 150px;">
        <div class="container">
            <div class="col-lg-5 col-sm-6 m-auto" style="margin-bottom: 50px !important;">
                <aside class="f_widget news_widget mt-5">
                    <h3>Search Users</h3>
                    <form action="{{route('search')}}" method="GET" role="search">

                        <div class="input-group d-flex flex-row">
                            <input name="q" placeholder="Search Users" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Users'" type="text" style="background:white;border: 1px solid #d6d6d6;color:black" autocomplete="off">
                            <button class="btn sub-btn" type="submit"><span class="lnr lnr-arrow-right"></span></button>

                        </div>
                    </form>

                </aside>

            </div>

            @if(isset($users))
                <h4>Results for: {{$_GET['q']}}</h4>
            @foreach($users as $user)
            <div class="media">
                <a href="{{route('user.show',$user->slug)}}"> <img class="align-self-start mr-3 rounded-circle" src="{{$user->photo->photo}}" alt="{{$user->name . " ". $user->surname}}" width="50px" height="50px"></a>
                <div class="media-body">
                    @if($user->bio)
                        <a href="{{route('user.show',$user->slug)}}"> <h5 class="mt-0">{{$user->name . " ". $user->surname}}</h5></a>
                        <p style="margin-top: -5px">{{$user->bio}}</p>
                        @else
                        <a href="{{route('user.show',$user->slug)}}"> <h5 class="mt-0">{{$user->name . " ". $user->surname}}</h5></a>
                        <p style="margin-top: -5px">(No bio available)</p>
                    @endif

                </div>
            </div>

            @endforeach
            @endif
            @if(Session::has('user_not_found'))
                        <div class="alert alert-danger">{{session('user_not_found')}}</div>
                    @endif
            </div>



        </div>

    <!-- End Align Area -->
@endsection
