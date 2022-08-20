<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Token;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\WorkingHour;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function loginSubmit(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required',
            ]
        );

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 422);
        }

        $user  = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(["error_message" => 'Invalid email or password'], 406);
        }

        $verified_check = $user->verified == 1 ? true : false;

        if (!$verified_check) {
            return response()->json(["error_message" => 'Your account is not verified yet'], 406);
        }

        $verify_email_check = $user->verify_email == 0 ? true : false;

        if (!$verify_email_check) {
            return response()->json(["error_message" => 'Your must verify your email first'], 406);
        }

        $password_check = Crypt::decrypt($user->password) == $request->password ? true : false;

        if (!$password_check) {
            return response()->json(["error_message" => 'Invalid email or password'], 406);
        }

        $user->status = 1;

        $working_hour = new WorkingHour();

        $working_hour->user_id = $user->id;
        $working_hour->date = date('Y-m-d');
        $working_hour->entry_time = now();

        $working_hour->save();

        $token = new Token();

        $token->token = Str::random(64);
        $token->created_at = date('d-m-y h:i:s');
        $token->expired_at = null;
        $token->user_id = $user->id;
        $token->save();

        return response()->json(['user' => $user, 'token' => $token->token]);
    }

    public function logout(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'auth_id' => 'required|numeric|exists:users,id',
            ]
        );

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 422);
        }

        // return response()->json(["success_message" => "Successfully logout"]);

        User::where('id', $request->auth_id)
            ->update(['status' => 0]);
        WorkingHour::where('user_id', $request->id)
            ->where('exit_time', null)
            ->update(['exit_time' => now()]);
        Token::where('token', $request->token)->where('user_id', $request->id)
            ->update(['expired_at' => date('d-m-y h:i:s')]);

        return response()->json(["success_message" => "Successfully logout"]);
    }

    public function emailVerify(Request $request, $user_id, $code)
    {
        $validation = Validator::make(
            ['user_id' => $user_id, 'code' => $code],
            [
                'user_id' => 'required|numeric|exists:users,id',
                'code' => 'required|numeric',
            ]
        );

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 406);
        }

        $user = User::find($user_id);
        // return var_dump($code);

        if (!$user || $user->verify_email != $code) {
            return response()->json(["error_message" => 'Invalid verification link'], 406);
        }

        if ($user->verify_email === 0) {
            return response()->json(["error_message" => 'Your account is already verified'], 406);
        }

        $user->verify_email = 0;
        $user->update();

        return response()->json(["success_message" => "$user->email verified successfully."]);
    }
}
