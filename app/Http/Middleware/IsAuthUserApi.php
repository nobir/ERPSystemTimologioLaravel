<?php

namespace App\Http\Middleware;

use App\Models\Token;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IsAuthUserApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $validation = Validator::make(
            [
                'auth_id' => $request->header('auth_id'),
                'token' => $request->header('authorized')
            ],
            [
                'auth_id' => 'required|numeric|exists:users,id',
                'token' => 'required|max:64'
            ]
        );

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 422);
        }

        $token = Token::where('token', $request->header('authorized'))
            ->where('user_id', $request->header('auth_id'))
            ->whereNull("expired_at")->first();

        if ($token == null) {
            return response()->json([
                // $token,
                "error_message" => 'User not Authenticate'
            ], 406);
        }

        return $next($request);
    }
}
