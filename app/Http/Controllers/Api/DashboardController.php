<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    // public function index(Request $request)
    // {
    //     return view('dashboard.index');
    // }

    // public function profile(Request $request)
    // {
    //     $user = User::where('id', $request->session()->get('user')->id)->first();

    //     return view('dashboard.profile')
    //         ->with('user', $user);
    // }

    public function profile(Request $request)
    {
        $user = User::where('id', $request->header('auth_id'))->with('address', 'region', 'branch', 'permissions')->first();
        return response()->json($user);
    }

    public function profileEdit(Request $request)
    {
        $user = User::where('id', $request->header('auth_id'))->with("address", "permissions")->first();

        $permissions = Permission::all();

        $permissions_ids = [];

        foreach ($user->permissions as $value) {
            $permissions_ids[] = $value->id;
        }

        $user_types = [
            'CEO',
            'Region Manager',
            'Branch Manager',
            'Employee',
        ];
        // 'permission_ids' => $_permissions
        return response()->json(['user' => $user, 'user_type' => $user_types, 'permissions' => $permissions, 'permission_ids' => $permissions_ids]);
    }

    public function profileEditSubmit(Request $request)
    {
        // return response()->json([$request->all()]);
        $user = User::find($request->header("auth_id"));

        $validation_rules = [
            'name' => 'required|min:3',
            'hire_date' => 'required|date|date_format:Y-m-d',
            'salary' => 'required|numeric|min:0',
        ];

        if ($user->type <= 1) {
            $request->merge([
                'permission_ids' => array_unique(array_filter($request->permission_ids ?? [])),
            ]);

            $validation_rules = array_merge(
                $validation_rules,
                [
                    // 'type' => 'required|numeric|min:0|max:4',
                    // 'station_id' => 'required|numeric|exists:stations,id',
                    'permission_ids' => 'required|array|min:1|exists:permissions,id',
                ]
            );
        }

        // return $user->id;

        $validation = Validator::make($request->all(), $validation_rules);

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 422);
        }

        if ($user->type <= 1) {
            $permissions_ids = $request->permission_ids && is_array($request->permission_ids) ? $request->permission_ids : [];
            foreach ($permissions_ids as $permission) {
                if (!Permission::find($permission)) {
                    // $request->session()->flash('error_message', 'Permission not found.');
                    return response()->json(["error_message" => 'Permission not found'], 406);

                    // return redirect()->back();
                }
            }

            // $user->type = $request->type;
            $user->hire_date = $request->hire_date;
            $user->salary = $request->salary;
            $user->permissions()->detach();
            // return back();
            foreach ($permissions_ids as $permission) {
                $user->permissions()->attach($permission);
            }
        }

        // return $request->input();

        $user->name = $request->name;
        $user->address->local_address = $request->address["local_address"];
        $user->address->police_station = $request->address["police_station"];
        $user->address->city = $request->address["city"];
        $user->address->country = $request->address["country"];
        $user->address->zip_code = $request->address["zip_code"];
        $user->address->update();
        $user->update();

        // $request->session()->remove('user');
        // $request->session()->put('user', $user);

        // $request->session()->flash('success_message', "Updated successfully.");
        return response()->json(["success_message" => 'Updated successfully']);

        // return redirect()->back();
    }

    // public function profilePicture(Request $request)
    // {
    //     return view('dashboard.profilePicture');
    // }

    public function profilePictureSubmit(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'avatar' => 'required|max:2048|image|file',
            ]
        );

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 422);
        }

        $user = User::find($request->header("auth_id"));

        if (!$user) {
            return response()->json(["error_message" => 'User not found'], 406);
        }

        // return public_path();

        $path = $request->file('avatar')->store('public/avatars');

        if (!$path) {
            return response()->json(["error_message" => 'Error uploading avatar'], 406);
        }

        $user->avatar = str_replace('public', 'storage', $path);
        $user->update();

        // $request->session()->remove('user');
        // $request->session()->put('user', $user);

        return response()->json(["success_message" => 'Uploaded avatar successfully']);
    }

    // public function changePassword(Request $request)
    // {
    //     return view('dashboard.changePassword');
    // }

    public function changePasswordSubmit(Request $request)
    {
        // dd($request->all());

        /**
         * reqular expression
         * @link https://regexr.com/6pguf
         */

        $validation = Validator::make(
            $request->all(),
            [
                'currentpass' => 'required',
                'newpass' => 'required|min:8|regex:/^(?=.*[\!\@\#\$\%\^\&\*\(\)])(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'retypepass' => 'required|same:newpass',
            ],
            [
                'newpass.regex' => "Password must contain at least one special character, one uppercase letter, one lowercase letter and one digit.",
            ]
        );

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 422);
        }

        $user = User::find($request->header('auth_id'));

        if (!$user) {
            return response()->json(["error_message" => 'User not found'], 406);
        }

        $check_current_pass = Crypt::decrypt($user->password) . "" === $request->currentpass . "";

        if (!$check_current_pass) {
            return response()->json(["error_message" => 'Current password is incorrect'], 406);
        }

        $user->password = Crypt::encrypt($request->newpass);
        $user->update();

        // $request->session()->remove('user');
        // $request->session()->put('user', $user);

        return response()->json(["success_message" => 'Password changed successfully']);
    }
}
