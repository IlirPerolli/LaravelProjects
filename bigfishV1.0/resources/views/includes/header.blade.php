<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{asset('img/favicon.png')}}" type="image/png">
    @yield('title')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/linericon/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/owl-carousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/lightbox/simpleLightbox.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/nice-select/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/animate-css/animate.css')}}">
    <!-- main css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    @yield('styles')
</head>
<body>

<!--================Header Menu Area =================-->
<header class="header_area">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container box_1620">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand logo_h" href="{{route('home')}}"><img src="{{asset('logo/logo.png')}}" alt="" style="width: 50px"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                <ul class="nav navbar-nav menu_nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Home</a></li>
                    <li class="nav-item submenu dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Discover</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a class="nav-link" href="{{route('discover.posts')}}">Discover Posts</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('discover.users')}}">Discover Users</a></li>
                            </ul>

                    <li class="nav-item"><a class="nav-link" href="{{route('about')}}">About</a></li>
                    @if(auth()->check())
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Post</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="{{route('post.create')}}">Add a post</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('post.create.multiple')}}">Add multiple posts</a></li>
                            </ul>
                        </li>

                    @endif
                    @if(auth()->check())
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{auth()->user()->name . " ". auth()->user()->surname}}</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="{{route('user.show',auth()->user()->slug)}}">Show Profile</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('user.edit',auth()->user()->slug)}}">Edit profile</a></li>
                            </ul>
                        </li>

                    @endif
                    @if(!auth()->check())
                    <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ url('/logout') }}">Logout</a></li>
                    @endif



                    <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item"><a href="{{route('search')}}" class="search"><i class="lnr lnr-magnifier"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!--================Header Menu Area =================-->
