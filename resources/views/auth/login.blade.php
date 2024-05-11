@extends('bases')
@section('style_links')
    @vite('resources/css/auth.css')
@endsection
@section('content')
    <body class="flex justify-center  h-full items-center">
    <div class="flex justify-center  h-full items-center">


    <div class="flex shadow-xl">
        <div class="bg-white p-6">
            @if(session('welcome'))
                {{session('welcome')}}
            @endif
            <h1 class="text-black text-red-600 text-lg font-bold mb-4">Connexion</h1>
            <div class="md:flex">
                <img class="h-96 w-60 mr-6 object-cover" src="https://img.freepik.com/premium-vector/online-registration-sign-up-concept-flat-vector-illustration-young-male-cartoon-character-sitting-huge-smartphone-login-account-social-media-app-user-interface-secure-login_241107-1247.jpg?w=996" alt="">

                <form class="md:w-60 md:flex-col content-center items-center" method="post" action="">
                    @csrf
                    <div class="mb-4">
                        @error('email')
                        {{$message}}
                        @enderror
                        <label class="label" for="email">Adresse mail</label>
                        <input  type="text" id="email" name="email" value="{{old('email')}}" class="input"> <br/>
                    </div>
                    <div class="mb-6">
                        @error('password')
                        {{$message}}
                        @enderror
                        <label class="block text-zinc-500 mb-4 " for="password">Mot de passe</label>
                        <input  type="password" name="password" id="password" class="input">
                    </div>
                    <button type="submit" class="button">Se connecter</button>
                </form>
            </div>


            <a href="{{route('auth.sign_in')}}">S'enregistrer ?</a>
        </div>
    </div>
    </div>
    </body>
@endsection
