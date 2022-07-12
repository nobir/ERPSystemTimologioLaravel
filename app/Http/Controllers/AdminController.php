<?php

namespace App\Http\Controllers;

use App\Mail\MailVerifyLinkSender;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permission;
use App\Models\Station;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('ceo.index');
    }

    public function viewUsers(Request $request)
    {
        $users = User::where('verified', 1)->paginate(5);

        return view('ceo.viewUsers')
            ->with('users', $users);
    }

    public function viewUnverifiedUsers(Request $request)
    {
        $users = User::where('verified', 0)->paginate(5);

        return view('ceo.viewUnverifiedUsers')
            ->with('users', $users);
    }

    public function searchUsers(Request $request)
    {
        return redirect()->back();
    }

    public function searchUnverifiedUsers(Request $request)
    {
        return redirect()->back();
    }

    public function searchUsersSubmit(Request $request)
    {
        $this->validate($request, [
            'search_by' => 'required|in:id,name,username,email,local_address,police_station,city,zip_code,country,station,permission',
            'search_value' => 'required',
        ]);

        return redirect()->route('admin.viewSearchUsers', [
            'search_by' => $request->search_by,
            'search_value' => $request->search_value,
        ]);
    }

    public function searchUnverifiedUsersSubmit(Request $request)
    {
        $this->validate($request, [
            'search_by' => 'required|in:id,name,username,email,local_address,police_station,city,zip_code,country,station,permission',
            'search_value' => 'required',
        ]);

        return redirect()->route('admin.viewSearchUnverifiedUsers', [
            'search_by' => $request->search_by,
            'search_value' => $request->search_value,
        ]);
    }

    public function viewSearchUsers(Request $request, $search_by, $search_value)
    {
        $request->merge(['search_by' => $search_by, 'search_value' => $search_value]);

        $this->validate($request, [
            'search_by' => 'required|in:id,name,username,email,local_address,police_station,city,zip_code,country,station,permission',
            'search_value' => 'required',
        ]);

        $users = null;

        if ($search_by === 'id') {
            $users = User::where($search_by, "$search_value")->where('verified', 1)->paginate(5);
        } else if ($search_by === 'local_address' || $search_by === 'police_station' || $search_by === 'city' || $search_by === 'zip_code' || $search_by === 'country') {
            $users = User::whereHas('address', function (Builder $query) use ($search_by, $search_value) {
                $query->where($search_by, 'LIKE', "%$search_value%");
            })->where('verified', 1)->paginate(5);
        } else if ($search_by === 'station') {
            $users = User::whereHas('station', function (Builder $query) use ($search_value) {
                $query->where('name', 'LIKE', "%$search_value%");
            })->where('verified', 1)->paginate(5);
        } else if ($search_by === 'permission') {
            $users = User::whereHas('permissions', function (Builder $query) use ($search_value) {
                $query->where('name', 'LIKE', "%$search_value%");
            })->where('verified', 1)->paginate(5);
        } else {
            $users = User::where($search_by, "LIKE", "%$search_value%")->where('verified', 1)->paginate(5);
        }

        if (!$users || $users->count() == 0) {
            $request->session()->flash('error_message', 'No users found.');
            return redirect()->route('admin.viewUsers');
        }

        return view('ceo.viewUsers')
            ->with('users', $users);
    }

    public function viewSearchUnverifiedUsers(Request $request, $search_by, $search_value)
    {
        $request->merge(['search_by' => $search_by, 'search_value' => $search_value]);

        $this->validate($request, [
            'search_by' => 'required|in:id,name,username,email,local_address,police_station,city,zip_code,country,station,permission',
            'search_value' => 'required',
        ]);

        $users = null;

        if ($search_by === 'id') {
            $users = User::where($search_by, "$search_value")->where('verified', 0)->paginate(5);
        } else if ($search_by === 'local_address' || $search_by === 'police_station' || $search_by === 'city' || $search_by === 'zip_code' || $search_by === 'country') {
            $users = User::whereHas('address', function (Builder $query) use ($search_by, $search_value) {
                $query->where($search_by, 'LIKE', "%$search_value%");
            })->where('verified', 0)->paginate(5);
        } else if ($search_by === 'station') {
            $users = User::whereHas('station', function (Builder $query) use ($search_value) {
                $query->where('name', 'LIKE', "%$search_value%");
            })->where('verified', 0)->paginate(5);
        } else if ($search_by === 'permission') {
            $users = User::whereHas('permissions', function (Builder $query) use ($search_value) {
                $query->where('name', 'LIKE', "%$search_value%");
            })->where('verified', 0)->paginate(5);
        } else {
            $users = User::where($search_by, "LIKE", "%$search_value%")->where('verified', 0)->paginate(5);
        }

        if (!$users || $users->count() == 0) {
            $request->session()->flash('error_message', 'No users found.');
            return redirect()->route('admin.viewUnverifiedUsers');
        }

        return view('ceo.viewUnverifiedUsers')
            ->with('users', $users);
    }

    public function verifyUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->verified = 1;
        $user->update();

        $request->session()->flash('success_message', 'User verified successfully.');

        return redirect()->route('admin.viewUsers');
    }

    public function unverifyUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->verified = 0;
        $user->update();

        $request->session()->flash('success_message', 'User unverified successfully.');

        return redirect()->back();
    }

    public function createUser(Request $request)
    {
        $stations = Station::all();
        $permissions = Permission::all();

        $user_types = [
            '4' => 'Receptionist',
            '3' => 'Employee',
            '2' => 'Manager',
            '1' => 'CEO',
            // '0' => 'System Admin',
        ];

        return view('ceo.createUser')
            ->with('user_types', $user_types)
            ->with('stations', $stations)
            ->with('permissions', $permissions);
    }

    public function createUserSubmit(Request $request)
    {
        $request->merge([
            'permission_ids' => array_unique(array_filter($request->permission_ids)),
        ]);

        $this->validate(
            $request,
            [
                'verified' => 'required|numeric|regex:/^[0-1]$/i',
                'name' => 'required|min:3',
                'username' => 'required|min:3|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'hire_date' => 'required|date|date_format:Y-m-d',
                'type' => 'required|numeric|min:0|max:4',
                'salary' => 'required|numeric|min:0',
                'station_id' => 'required|numeric|exists:stations,id',
                'permission_ids' => 'required|array|exists:permissions,id',
            ]
        );

        // return $request->input();

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

        $rnd_int = random_int(100000, 999999);

        $address = new Address();
        $address->local_address = $request->local_address;
        $address->police_station = $request->police_station;
        $address->city = $request->city;
        $address->country = $request->country;
        $address->zip_code = $request->zip_code;
        $address->save();

        $user = new User();

        $user->verified = $request->verified;
        $user->verify_email = $rnd_int;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->type = $request->type;
        $user->email = $request->email;
        $user->password = Crypt::encrypt($rnd_int);
        $user->salary = $request->salary;
        $user->hire_date = $request->hire_date;
        $user->address_id = $address->id;
        $user->station_id = $station->id;
        $user->save();

        foreach ($request->permission_ids as $permission) {
            $user->permissions()->attach($permission);
        }
        $user->update();


        // return $request->input();


        Mail::to($request->email)
            ->send(new MailVerifyLinkSender('Verify Email', $user->id, $rnd_int));


        $request->session()->flash('success_message', "User created successfully. A verification link has been sent to the user's email.");

        return redirect()->route('admin.viewUsers');
    }

    public function sendEmailVerifyLink(Request $request)
    {
        return view('ceo.sendEmailVerifyLink');
    }

    public function editUser(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            $request->session()->flash('error_message', 'User not found.');
            return redirect()->back();
        }

        $stations = Station::all();
        $permissions = Permission::all();

        $user_types = [
            '4' => 'Receptionist',
            '3' => 'Employee',
            '2' => 'Manager',
            '1' => 'CEO',
            // '0' => 'System Admin',
        ];

        return view('ceo.editUser')
            ->with('user', $user)
            ->with('user_types', $user_types)
            ->with('stations', $stations)
            ->with('permissions', $permissions);
    }

    public function editUserSubmit(Request $request, $id)
    {
        $request->merge([
            'permission_ids' => array_unique(array_filter($request->permission_ids)),
        ]);

        // return $request->input();

        $this->validate(
            $request,
            [
                'verified' => 'required|numeric|regex:/^[0-1]$/i',
                'name' => 'required|min:3',
                // 'username' => 'required|min:3|unique:users,username',
                // 'email' => 'required|email|unique:users,email',
                'hire_date' => 'required|date|date_format:Y-m-d',
                'type' => 'required|numeric|min:0|max:4',
                'salary' => 'required|numeric|min:0',
                'station_id' => 'required|numeric|exists:stations,id',
                'permission_ids' => 'required|array|min:1|exists:permissions,id',
            ]
        );

        $station = Station::find($request->station_id);

        if (!$station) {
            $request->session()->flash('error_message', 'Station not found.');
            return redirect()->back();
        }

        $user = User::find($id);

        if (!$user) {
            $request->session()->flash('error_message', 'User not found.');
            return redirect()->back();
        }


        foreach ($request->permission_ids as $permission) {
            if (!Permission::find($permission)) {
                $request->session()->flash('error_message', 'Permission not found.');

                return redirect()->back();
            }
        }

        // return $request->input();

        $user->verified = $request->verified;
        $user->name = $request->name;
        $user->type = $request->type;
        $user->salary = $request->salary;
        $user->hire_date = $request->hire_date;
        $user->address->local_address = $request->local_address;
        $user->address->police_station = $request->police_station;
        $user->address->city = $request->city;
        $user->address->country = $request->country;
        $user->address->zip_code = $request->zip_code;
        $user->address->update();
        $user->station_id = $station->id;
        $user->update();


        $user->permissions()->detach();
        // return back();
        foreach ($request->permission_ids as $permission) {
            $user->permissions()->attach($permission);
        }

        $request->session()->flash('success_message', "User updated successfully.");

        return redirect()->back();
    }

    public function sendEmailVerifyLinkSubmit(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->verify_email === 0) {
            $request->session()->flash('error_message', 'User already verified.');
            return redirect()->back();
        }

        $rnd_int = random_int(100000, 999999);

        $user->verify_email = $rnd_int;
        $user->password = Crypt::encrypt($rnd_int);
        $user->update();

        Mail::to($request->email)
            ->send(new MailVerifyLinkSender('Verify Email', $user->id, $rnd_int,));

        $request->session()->flash('success_message', "A verification link has beed sent to $user->email");

        return redirect()->back();
    }

    public function deleteUser(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            $request->session()->flash('error_message', 'User not found.');
            return redirect()->back();
        }

        $user->delete();

        $request->session()->flash('success_message', "User deleted successfully.");

        return redirect()->back();
    }
}
