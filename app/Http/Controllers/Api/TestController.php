<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Address;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Category;
use App\Models\Region;
use App\Models\Station;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'auth_id' => 'required',
            ]
        );

        $user = User::where('id', $request->auth_id)->with('address', 'region', 'branch', 'permissions')->first();
        return response()->json($user);
    }
}
