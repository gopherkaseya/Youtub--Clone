@extends('bases')
@section('style_links')
    @vite('resources/css/navbar.css')
@endsection
@section('content')
    <div class="bg-amber-200 flex p-2 justify-center items-center space-x-48">
        <div class="">
            Logo
        </div>

        <div class="flex">
            <input class="search" type="search" name="" id="" placeholder="Rechercher">
            <button class="button"><img class="h-5 pr-5 pl-5" src="{{asset('images/icons/search.svg')}}" alt=""></button>
        </div>

        <div class="flex border-2 border-b-cyan-900 h-20">
            <div class="pl-3 pr-3">
                <img src="{{asset('images/icons/create.svg')}}" class="h-7" alt="">
            </div>
            <div class="pl-3 pr-3">
                <img src="{{asset('images/icons/add-circle-outline.svg')}}" class="h-7">
            </div>
            <div class="pl-3 pr-3 bg-cyan-600 rounded ">
                G
            </div>
        </div>
    </div>
@endsection
