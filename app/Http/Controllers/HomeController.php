<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function about()
    {
        return view('home.about');
    }

    public function login(Request $request)
    {
        // $request->session()->put('loggedin', true);
        // $request->session()->put('name', "Nobir");
        // $request->session()->put('type', "admin");
        return view('home.login');
    }

    public function loginSubmit(Request $request)
    {
        // $request->session()->put('loggedin', true);
        return $request->input();
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return view('home.login');
    }
}
