<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;


Route::controller(\App\Http\Controllers\UserController::class)->group( function (){
    Route::get('/', 'index')->name('index');
    Route::get('login/',  'login')->name('login');
    Route::get('/new', 'new')->name('new-video')->middleware('auth');;
    Route::get('/dashboard','dashboard')->name('dashboard')->middleware('auth');;
});

Route::controller(\App\Http\Controllers\AuthController::class)->group(function (){
   Route::get('/login','login')->name('auth.login');
   Route::post('/login','connect');
   Route::get('/sign-in','sign_in')->name('auth.sign_in');
   Route::post('/sign-in', 'register');
   Route::delete('/logout', 'logout')->name('auth.logout')->middleware('auth');;

});

Route::resource('video', VideoController::class);
Route::resource('comment', CommentController::class);

Route::controller(LikeController::class)->group(function (){
    Route::post('like', 'like')->name("like")->middleware('auth');
    Route::post('dislike', 'dislike')->name("dislike")->middleware('auth');;
});

Route::get('/navbar', function (){
   return view('navbar');
});

