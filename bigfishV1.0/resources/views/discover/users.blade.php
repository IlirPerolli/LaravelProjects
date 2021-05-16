@extends('layouts.index')
<title>Bigfish &#8226; Discover Users </title>
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
    <div class="whole-wrap" style="margin-top: 120px; margin-bottom: 120px;">
        <div class="container">



            <h3 class="text-center" style="margin-bottom: 50px;">Discover Users</h3>
            @if(count($users)>0)
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
            @else
                <h4 style="margin-bottom: 20px; color:red" class="text-center">No users found</h4>
            @endif


        </div>



    </div>

    <!-- End Align Area -->
@endsection
