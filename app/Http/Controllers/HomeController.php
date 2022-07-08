<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WorkingHour;
use Illuminate\Support\Facades\Crypt;

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
        return view('home.login');
    }

    public function loginSubmit(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user  = User::where('email', $request->email)->first();

        if (!$user) {
            $request->session()->flash('error_message', 'Invalid email or password');
            return redirect()->back();
        }

        $verified_check = $user->verified == 1 ? true : false;

        if (!$verified_check) {
            $request->session()->flash('error_message', 'Your account is not verified yet');
            return redirect()->back();
        }

        $verify_email_check = $user->verify_email == 0 ? true : false;

        if (!$verify_email_check) {
            $request->session()->flash('error_message', 'Your must verify your email first');
            return redirect()->back();
        }

        $password_check = Crypt::decrypt($user->password) == $request->password ? true : false;

        if (!$password_check) {
            $request->session()->flash('error_message', 'Invalid email or password');
            return redirect()->back();
        }

        $user->status = 1;

        $request->session()->put('user', $user);
        $request->session()->put('loggedin', true);

        $working_hour = new WorkingHour();

        $working_hour->user_id = $user->id;
        $working_hour->date = date('Y-m-d');
        $working_hour->entry_time = now();

        $working_hour->save();

        return redirect()->route('dashboard.index');
    }

    public function logout(Request $request)
    {
        User::where('id', $request->session()->get('user')->id)
            ->update(['status' => 0]);
        WorkingHour::where('user_id', $request->session()->get('user')->id)
            ->where('exit_time', null)
            ->update(['exit_time' => now()]);

        $request->session()->flush();

        return redirect()->route('home.login');
    }

    public function emailVerify(Request $request, $user_id, $code)
    {
        $user = User::find($user_id);
        // return var_dump($code);

        if(!$user || $user->verify_email != $code) {
            $request->session()->flash('error_message', 'Invalid verification link');
            return redirect()->route('home.login');
        }

        if($user->verify_email === 0 ) {
            $request->session()->flash('error_message', 'Your account is already verified');
            return redirect()->route('home.login');
        }

        $user->verify_email = 0;
        $user->update();

        $request->session()->flash('success_message', "$user->email verified successfully.");

        return redirect()->route('home.login');
    }
}
