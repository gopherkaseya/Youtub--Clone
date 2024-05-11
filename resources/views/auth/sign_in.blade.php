@extends('bases')
@section('style_links')
    @vite('resources/css/auth.css')
@endsection
@section('content')
    <body class="flex justify-center  h-full items-center">
        <div class="flex shadow-xl">
            <div class="p-6">
                <h1 class="text-black text-red-600 text-lg font-bold mb-4">Enregistrement <h1/>
                <div class="md:flex">
                    <img class="h-96 w-60 mr-6 object-cover" src="https://img.freepik.com/premium-vector/online-registration-illustration-design-concept-websites-landing-pages-other_108061-939.jpg?w=740" alt=""/>

                    <form class="md:w-60 md:flex-col content-center items-center" method="post" action="">
                        @csrf
                        <div>
                            <label class="label">Nom</label>
                            <input type="text" class="input" name="name" value="{{old('name')}}" placeholder="Nom d'utilisateur">
                        </div>

                        <div>
                            <label class="label">Adresse mail</label>
                            <input type="email" class="input" name="email" value="{{old('email')}}" placeholder="Adresse mail">
                        </div>

                        <div class="mb-6">
                            <label class="label">Mot de passe</label>
                            <input  type="password" class="input" name="password" placeholder="Mot de passe">
                        </div>

                        <button class="button" type="submit">S'enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</div>

@endsection
