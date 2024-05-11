<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function connect(LoginRequest $request)
    {
        $credentials = $request->validated();

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('index'));
        }

        return to_route('auth.login')->withErrors([
            'email' => 'Email not found'
        ])->onlyInput('email');
    }

    public function sign_in()
    {
        return view('auth.sign_in');
    }

    public function register(RegisterRequest $request)
    {

        User::create($request->validated());

        return to_route('auth.login')->with([
            'welcome' => "Votre compte a été crée avec succés ! Veuillez maintenant vous connecter !"
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return to_route('index');
    }
}
