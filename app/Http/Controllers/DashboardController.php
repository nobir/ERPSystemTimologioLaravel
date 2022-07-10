<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Station;
use App\Models\Permission;

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

    public function profileEdit(Request $request)
    {
        $user = User::where('id', $request->session()->get('user')->id)->first();

        $stations = Station::all();
        $permissions = Permission::all();

        $user_types = [
            '4' => 'Receptionist',
            '3' => 'Employee',
            '2' => 'Manager',
            '1' => 'CEO',
            // '0' => 'System Admin',
        ];
        return view('dashboard.profileEdit')
            ->with('user', $user)
            ->with('user_types', $user_types)
            ->with('stations', $stations)
            ->with('permissions', $permissions);
    }

    public function profileEditSubmit(Request $request)
    {
        $user = User::find($request->session()->get('user')->id);

        $validation_rules = [
            'name' => 'required|min:3',
            'hire_date' => 'required|date|date_format:Y-m-d',
            'salary' => 'required|numeric|min:0',
        ];

        if ($user->type <= 1) {
            $request->merge([
                'permission_ids' => array_unique(array_filter($request->permission_ids)),
            ]);

            $validation_rules = array_merge(
                $validation_rules,
                [
                    // 'type' => 'required|numeric|min:0|max:4',
                    'station_id' => 'required|numeric|exists:stations,id',
                    'permission_ids' => 'required|array|min:1|exists:permissions,id',
                ]
            );
        }

        // return $user->id;

        $this->validate($request, $validation_rules);

        if ($user->type <= 1) {

            $station = Station::find($request->station_id);

            if (!$station) {
                $request->session()->flash('error_message', 'Station not found.');
                return redirect()->back();
            }

            foreach ($request->permission_ids as $permission) {
                if (!Permission::find($permission)) {
                    $request->session()->flash('error_message', 'Permission not found.');

                    return redirect()->back();
                }
            }

            // $user->type = $request->type;
            $user->station_id = $station->id;
            $user->permissions()->detach();
            // return back();
            foreach ($request->permission_ids as $permission) {
                $user->permissions()->attach($permission);
            }
        }

        // return $request->input();

        $user->name = $request->name;
        $user->salary = $request->salary;
        $user->hire_date = $request->hire_date;
        $user->address->local_address = $request->local_address;
        $user->address->police_station = $request->police_station;
        $user->address->city = $request->city;
        $user->address->country = $request->country;
        $user->address->zip_code = $request->zip_code;
        $user->address->update();
        $user->update();

        $request->session()->remove('user');
        $request->session()->put('user', $user);

        $request->session()->flash('success_message', "updated successfully.");

        return redirect()->back();
    }
}
