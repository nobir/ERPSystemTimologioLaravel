<?php

namespace App\Http\Middleware;

use App\Models\Token;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IsAdminUserApi
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
            ],
            [
                'auth_id' => 'required|numeric|exists:users,id',
            ]
        );

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 422);
        }
        $user = User::find($request->header('auth_id'));

        if ($user == null) {
            return response()->json([
                "error_message" => 'User not found'
            ], 406);
        }

        if ($user != null && !($user->type <= 1)) {
            return response()->json([
                "error_message" => 'User is not admin or above'
            ], 406);
        }

        return $next($request);
    }
}
