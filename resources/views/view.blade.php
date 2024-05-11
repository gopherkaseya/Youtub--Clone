<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index</title>
    <link rel="stylesheet" href="{{asset('css/view-style.css')}}">
</head>
<body>
        <header>
            <div class="user-info">
                @auth
                    <img src="{{asset('images/google-icon.webp')}}" alt="Icône">
                    <span>{{ \Illuminate\Support\Facades\Auth::user()->name}}</span>
                    <form action="{{ route('auth.logout') }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit">Se deconnecter</button>
                    </form>
                    <a href=""></a>
                @endauth
                @guest
                    <a href="{{ route('auth.login') }}">Se connecter</a>
                @endguest
            </div>
            <nav>
                <a href="/">Vidéos</a>
                <a href="#dashboard">Dashboard</a>
            </nav>
        </header>
        <section>
            <div id="video-section" class="video-card">
                <iframe id="video-player" src="{{asset('storage/'.$video->videoPath)}}" frameborder="0" allowfullscreen></iframe>
                <div id="video-info" class="video-info-card">
                    <h2>{{$video->title}}</h2>
                    <p>{{$video->description}}</p>
                    <span>{{$video->created_at}}</span>
                    <div class="like-dislike-card">
                        <form action="{{route('like')}}" method="post">
                            @csrf
                            <button type="submit"><span class="icon-card">&#128077;</span></button>
                            @auth
                                <input type="hidden" name="video_id" value="{{$video->id}}">
                            @endauth
                            <span class="count-card">
                                {{$likes}}
                            </span>
                        </form>
                        <form action="{{route('dislike')}}" method="post">
                            @csrf
                            <button type="submit"><span class="icon-card">&#128078;</span></button>
                            @auth
                                <input type="hidden" name="video_id" value="{{$video->id}}">
                            @endauth
                            <span class="count-card">
                                {{$dislikes}}
                            </span>
                        </form>

                    </div>
                    <div>
                    <div>
                        <form method="post" action="{{route('comment.store')}}" >
                            @csrf
                            @error('message')
                            {{$message}}
                            @enderror
                            <input type="text" name="message" id="">
                            <input type="hidden" name="video_id" value="{{$video->id}}">
                            @auth
                                <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                            @endauth
                            <button type="submit">Commenter</button>
                        </form>
                    </div>
                        @forelse($video->commentaires as $commentaire)
                            <div>
                                <p>
                                    Par : {{$commentaire->user['name'], }}
                                </p>
                                {{ $commentaire->message}}
                            </div>
                        @empty
                            <span> <i>Aucun commentaire .</i> </span>
                        @endforelse
                    </div>
                </div>
            </div>

            <div id="related-videos">
                <h2>Autres vidéos</h2>

                @foreach($suggestion_videos as $video)
                    <div>
                        <p>{{$video->title}}</p>

                        <a href="/video/{{$video->id}}">
                            <img class="video-thumbnail" src="{{asset('storage/'.$video->imagePath)}}" width="" alt="Video 1">
                        </a>
                    </div>
                @endforeach



                <!-- Ajoutez d'autres miniatures de vidéos ici -->
            </div>
        </section>
</body>
</html>
