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
        $validation = Validator::make(
            $request->all(),
            [
                'auth_id' => 'required',
            ]
        );

        $user = User::where('id', $request->auth_id)->with('address', 'region', 'branch', 'permissions')->first();
        return response()->json($user);
    }

    // public function profileEdit(Request $request)
    // {
    //     $user = User::where('id', $request->session()->get('user')->id)->first();

    //     $permissions = Permission::all();

    //     $user_types = [
    //         '4' => 'Receptionist',
    //         '3' => 'Employee',
    //         '2' => 'Manager',
    //         '1' => 'CEO',
    //         // '0' => 'System Admin',
    //     ];
    //     return view('dashboard.profileEdit')
    //         ->with('user', $user)
    //         ->with('user_types', $user_types)
    //         ->with('permissions', $permissions);
    // }

    // public function profileEditSubmit(Request $request)
    // {
    //     $user = User::find($request->session()->get('user')->id);

    //     $validation_rules = [
    //         'name' => 'required|min:3',
    //         'hire_date' => 'required|date|date_format:Y-m-d',
    //         'salary' => 'required|numeric|min:0',
    //     ];

    //     if ($user->type <= 1) {
    //         $request->merge([
    //             'permission_ids' => array_unique(array_filter($request->permission_ids)),
    //         ]);

    //         $validation_rules = array_merge(
    //             $validation_rules,
    //             [
    //                 // 'type' => 'required|numeric|min:0|max:4',
    //                 // 'station_id' => 'required|numeric|exists:stations,id',
    //                 'permission_ids' => 'required|array|min:1|exists:permissions,id',
    //             ]
    //         );
    //     }

    //     // return $user->id;

    //     $this->validate($request, $validation_rules);

    //     if ($user->type <= 1) {

    //         foreach ($request->permission_ids as $permission) {
    //             if (!Permission::find($permission)) {
    //                 $request->session()->flash('error_message', 'Permission not found.');

    //                 return redirect()->back();
    //             }
    //         }

    //         // $user->type = $request->type;
    //         $user->hire_date = $request->hire_date;
    //         $user->salary = $request->salary;
    //         $user->permissions()->detach();
    //         // return back();
    //         foreach ($request->permission_ids as $permission) {
    //             $user->permissions()->attach($permission);
    //         }
    //     }

    //     // return $request->input();

    //     $user->name = $request->name;
    //     $user->address->local_address = $request->local_address;
    //     $user->address->police_station = $request->police_station;
    //     $user->address->city = $request->city;
    //     $user->address->country = $request->country;
    //     $user->address->zip_code = $request->zip_code;
    //     $user->address->update();
    //     $user->update();

    //     $request->session()->remove('user');
    //     $request->session()->put('user', $user);

    //     $request->session()->flash('success_message', "updated successfully.");

    //     return redirect()->back();
    // }

    // public function profilePicture(Request $request)
    // {
    //     return view('dashboard.profilePicture');
    // }

    // public function profilePictureSubmit(Request $request)
    // {
    //     $this->validate(
    //         $request,
    //         [
    //             'avatar' => 'required|max:2048|image|file',
    //         ]
    //     );

    //     $user = User::find($request->session()->get('user')->id);

    //     if (!$user) {
    //         $request->session()->flash('error_message', 'User not found.');
    //         return redirect()->back();
    //     }

    //     // return public_path();

    //     $path = $request->file('avatar')->store('public/avatars');

    //     if (!$path) {
    //         $request->session()->flash('error_message', 'Error uploading avatar.');
    //         return redirect()->back();
    //     }

    //     $user->avatar = str_replace('public', 'storage', $path);
    //     $user->update();

    //     $request->session()->remove('user');
    //     $request->session()->put('user', $user);

    //     $request->session()->flash('success_message', "Uploaded avatar successfully.");
    //     return redirect()->back();
    // }

    // public function changePassword(Request $request)
    // {
    //     return view('dashboard.changePassword');
    // }

    // public function changePasswordSubmit(Request $request)
    // {
    //     // dd($request->all());

    //     /**
    //      * reqular expression
    //      * @link https://regexr.com/6pguf
    //      */

    //     $this->validate(
    //         $request,
    //         [
    //             'currentpass' => 'required',
    //             'newpass' => 'required|min:8|regex:/^(?=.*[\!\@\#\$\%\^\&\*\(\)])(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
    //             'retypepass' => 'required|same:newpass',
    //         ],
    //         [
    //             'newpass.regex' => "Password must contain at least one special character, one uppercase letter, one lowercase letter and one digit.",
    //         ]
    //     );

    //     $user = User::find($request->session()->get('user')->id);

    //     if (!$user) {
    //         $request->session()->flash('error_message', 'User not found.');
    //         return redirect()->back();
    //     }

    //     $check_current_pass = Crypt::decrypt($user->password) . "" === $request->currentpass . "";

    //     if (!$check_current_pass) {
    //         $request->session()->flash('error_message', 'Current password is incorrect.');
    //         return redirect()->back();
    //     }

    //     $user->password = Crypt::encrypt($request->newpass);
    //     $user->update();

    //     $request->session()->remove('user');
    //     $request->session()->put('user', $user);

    //     $request->session()->flash('success_message', "Password changed successfully.");
    //     return redirect()->back();
    // }
}
