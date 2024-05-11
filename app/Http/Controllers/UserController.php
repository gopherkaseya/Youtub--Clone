<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index():View
    {
        $videos = Video::all();
        return \view('index',['videos' => $videos]);
    }

    public function dashboard()
    {
        $videos = Video::where('user_id','=','1')->get();
        return view('dashboard',['videos' => $videos]);
    }
}
