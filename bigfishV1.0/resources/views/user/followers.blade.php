@extends('layouts.index')
<title>{{$user->name . " ". $user->surname}} &#8226; Followers </title>
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
    <div class="whole-wrap" style="margin-top: 150px; margin-bottom: 150px;">
        <div class="container">

            <h4 class="mb-4"><span style="color: #343a40;font-size: 22px">{{$user->name. " ". $user->surname}}'s </span>Followers:</h4>
        @if(count($followers)>0)
            @foreach($followers as $follower)

                                    <div class="media">
                        <a href="{{route('user.show',$follower->slug)}}"> <img class="align-self-start mr-3 rounded-circle" src="{{$follower->photo->photo}}" alt="{{$follower->name . " ". $follower->surname}}" width="50px" height="50px"></a>
                        <div class="media-body">
                            @if($follower->bio)
                                <a href="{{route('user.show',$follower->slug)}}"> <h5 class="mt-0">{{$follower->name . " ". $follower->surname}}</h5></a>
                                <p style="margin-top: -5px">{{$follower->bio}}</p>
                            @else
                                <a href="{{route('user.show',$follower->slug)}}"> <h5 class="mt-0">{{$follower->name . " ". $follower->surname}}</h5></a>
                                <p style="margin-top: -5px">(No bio available)</p>
                            @endif

                        </div>
                    </div>

                @endforeach
            @else
                <h5 class="text-center" style="color:red">No followers found.</h5>
                @endif

        </div>


        <nav aria-label="Pagination" style="margin-top: 50px">
            <ul class="pagination justify-content-center">
                {{$followers->links()}}
            </ul>
        </nav>
    </div>


    <!-- End Align Area -->
@endsection
