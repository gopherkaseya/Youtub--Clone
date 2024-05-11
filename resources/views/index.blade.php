<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/index-style.css')}}">
    <link rel="stylesheet" href="{{asset('css/view-style.css')}}">
</head>
<body>
<header>
    <div class="user-info">
        @auth
        <img src="{{asset('images/google-icon.webp')}}" alt="Icône">
        <span>{{ \Illuminate\Support\Facades\Auth::user()->name}}</span>
        @endauth
        @guest
                <a href="{{ route('auth.login') }}">Se connecter</a>
            @endguest
    </div>
    <nav>
        <a href="/">Vidéos</a>
        <a href="{{route('dashboard')}}">Dashboard</a>
    </nav>
</header>
    <div class="container">
        @foreach($videos as $video)
            <div class="box">
                <a href="/video/{{$video->id}}">
                    <img src="{{$video->imageUrl()}}" width="200px">
                </a>
                <br>
                {{$video->title}}
                <br>
                {{$video->description}}
                <br>
                {{$video->views}}
                <br>
                {{$video->created_at->format('Y')}}

            </div>
        @endforeach
    </div>
</body>
</html>
