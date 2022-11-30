@extends('layouts.base')

@section('content')
<div class="col-md-8 articles" id="site-content">
    <div class="card-body">
        @auth
        <p>Welcome <b>{{ Auth::user()->name }}</b></p>
        <a class="btn btn-danger" href="{{ route('logout') }}">Logout</a>
        @endauth
        @guest
        <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
        <a class="btn btn-info" href="{{ route('register') }}">Register</a>
        @endguest
    </div>
    <article class="posts">
        <h1>Ini Bagian Home</h1>
        <h2 class="title-post">Lorem Ipsun Dolor Sit Amet</h2>
        <div class="meta-post">
            <span><i class="bi bi-person-circle"></i> Dewa Kucing</span>
            <span><i class="bi bi-calendar"></i> 12 April 2022</span>
        </div>
        <div class="content">
            <img class="img"
                src="https://img.okezone.com/content/2022/09/12/261/2666024/bayern-munich-vs-barcelona-julian-nagelsmann-ngaku-tak-tertekan-meski-die-toren-tengah-tampil-buruk-sEiUFRzG67.JPG">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed
                laoreet sapien eu velit elementum, at facilisis urna facilisis.
                ellentesque quis erat vulputate, dignissim lorem eu, facilisis
                enim. Ut cursus tristique quam, vitae pretium nibh laoreet sit
                amet.
            </p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed
                laoreet sapien eu velit elementum, at facilisis urna facilisis.
                ellentesque quis erat vulputate, dignissim lorem eu, facilisis
                enim. Ut cursus tristique quam, vitae pretium nibh laoreet sit
                amet.
            </p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed
                laoreet sapien eu velit elementum, at facilisis urna facilisis.
                ellentesque quis erat vulputate, dignissim lorem eu, facilisis
                enim. Ut cursus tristique quam, vitae pretium nibh laoreet sit
                amet.
            </p>
        </div>
    </article>
</div>
@endsection
