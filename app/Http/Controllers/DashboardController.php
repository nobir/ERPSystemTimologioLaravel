<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard.index');
    }

    public function profile(Request $request)
    {
        $user = User::where('id', $request->session()->get('user')->id)->first();

        return view('dashboard.profile')
            ->with('user', $user);
    }
}
