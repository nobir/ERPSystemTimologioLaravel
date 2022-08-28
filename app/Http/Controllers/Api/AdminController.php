<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\MailVerifyLinkSender;
use App\Models\Address;
use App\Models\Branch;
use App\Models\Category;
use App\Models\CategoryInvoice;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permission;
use App\Models\Region;
use App\Models\Station;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\RequiredIf;

class AdminController extends Controller
{
    public function viewUsers(Request $request)
    {
        $users = User::where('verified', 1)->with('address', 'permissions')->paginate(5);

        return response()->json(['users' => $users]);
    }

    public function viewStatistic(Request $request)
    {
        // In the database config set mysql strict mode to false otherwise it wont work
        $categories = DB::table('categories')
            ->join('category_invoice', 'categories.id', '=', 'category_invoice.category_id') //->take(10)->get();
            ->select('categories.*', DB::raw('count(*) as total')) //->take(10)->get();
            ->groupBy('category_id')->orderByDesc('total')->take(10)->get();

        return response()->json($categories);
    }

    public function viewSearchUsers(Request $request)
    {
        $validation = validator::make($request->all(), [
            'search_by' => 'required|in:id,name,username,email,local_address,police_station,city,zip_code,country,station,permission',
            'search_value' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 422);
        }

        // return response()->json([$request->all()]);
        $search_by = $request->search_by;
        $search_value = $request->search_value;
        $users = null;

        if ($search_by === 'id') {
            $users = User::where($search_by, "$search_value")->where('verified', 1)->with('address', 'permissions')->paginate(5);
        } else if ($search_by === 'local_address' || $search_by === 'police_station' || $search_by === 'city' || $search_by === 'zip_code' || $search_by === 'country') {
            $users = User::whereHas('address', function (Builder $query) use ($search_by, $search_value) {
                $query->where($search_by, 'LIKE', "%$search_value%");
            })->where('verified', 1)->with('address', 'permissions')->paginate(5);
        } else if ($search_by === 'station') {
            $users = User::whereHas('station', function (Builder $query) use ($search_value) {
                $query->where('name', 'LIKE', "%$search_value%");
            })->where('verified', 1)->with('address', 'permissions')->paginate(5);
        } else if ($search_by === 'permission') {
            $users = User::whereHas('permissions', function (Builder $query) use ($search_value) {
                $query->where('name', 'LIKE', "%$search_value%");
            })->where('verified', 1)->with('address', 'permissions')->paginate(5);
        } else {
            $users = User::where($search_by, "LIKE", "%$search_value%")->where('verified', 1)->with('address', 'permissions')->paginate(5);
        }

        if (!$users || $users->count() == 0) {
            return response()->json(["error_message" => 'No users found'], 406);
        }

        return response()->json(['users' => $users]);
    }

    public function viewUnverifiedUsers(Request $request)
    {
        $users = User::where('verified', 0)->with('address', 'permissions')->paginate(5);

        return response()->json(['users' => $users]);
    }

    public function viewSearchUnverifiedUsers(Request $request)
    {
        $validation = validator::make($request->all(), [
            'search_by' => 'required|in:id,name,username,email,local_address,police_station,city,zip_code,country,station,permission',
            'search_value' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 422);
        }

        // return response()->json([$request->all()]);
        $search_by = $request->search_by;
        $search_value = $request->search_value;
        $users = null;

        if ($search_by === 'id') {
            $users = User::where($search_by, "$search_value")->where('verified', 0)->with('address', 'permissions')->paginate(5);
        } else if ($search_by === 'local_address' || $search_by === 'police_station' || $search_by === 'city' || $search_by === 'zip_code' || $search_by === 'country') {
            $users = User::whereHas('address', function (Builder $query) use ($search_by, $search_value) {
                $query->where($search_by, 'LIKE', "%$search_value%");
            })->where('verified', 0)->with('address', 'permissions')->paginate(5);
        } else if ($search_by === 'station') {
            $users = User::whereHas('station', function (Builder $query) use ($search_value) {
                $query->where('name', 'LIKE', "%$search_value%");
            })->where('verified', 0)->with('address', 'permissions')->paginate(5);
        } else if ($search_by === 'permission') {
            $users = User::whereHas('permissions', function (Builder $query) use ($search_value) {
                $query->where('name', 'LIKE', "%$search_value%");
            })->where('verified', 0)->with('address', 'permissions')->paginate(5);
        } else {
            $users = User::where($search_by, "LIKE", "%$search_value%")->where('verified', 0)->with('address', 'permissions')->paginate(5);
        }

        if (!$users || $users->count() == 0) {
            return response()->json(["error_message" => 'No users found'], 406);
        }

        return response()->json(['users' => $users]);
    }

    public function verifyUser(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        $validation = validator::make($request->all(), [
            'id' => 'required|exists:permissions,id',
        ]);

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 422);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(["error_message" => 'User not found'], 406);
        }

        $user->verified = 1;
        $user->update();

        return response()->json(['success_message' => "User verified successfully"]);
    }

    public function unverifyUser(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        $validation = validator::make($request->all(), [
            'id' => 'required|exists:permissions,id',
        ]);

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 422);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(["error_message" => 'User not found'], 406);
        }

        $user->verified = 0;
        $user->update();

        return response()->json(['success_message' => "User Unverified successfully"]);
    }

    public function createUser(Request $request)
    {
        $branches = Branch::all();
        $regions = Region::all();
        $permissions = Permission::all();

        $user_types = [
            '4' => 'Receptionist',
            '3' => 'Employee',
            '2' => 'Manager',
            '1' => 'CEO',
        ];

        return response()->json([
            'user_types' => $user_types,
            'branches' => $branches,
            'regions' => $regions,
            'permissions' => $permissions,
        ]);
    }

    public function createUserSubmit(Request $request)
    {
        $request->merge([
            'permission_ids' => array_unique(array_filter($request->permission_ids)),
        ]);

        $$validation = validator::make(
            $request->all(),
            [
                'verified' => 'required|numeric|regex:/^[0-1]$/i',
                'name' => 'required|min:3',
                'username' => 'required|min:3|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'hire_date' => 'required|date|date_format:Y-m-d',
                'type' => 'required|numeric|min:0|max:4',
                'salary' => 'required|numeric|min:0',
                'region_id' => 'required_if:type,==,2',
                'branch_id' => new RequiredIf($request->type >= 3),
                'permission_ids' => 'required|array|exists:permissions,id',
            ]
        );

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 422);
        }

        // return $request->input();

        $region = Region::find($request->region_id);

        if ($request->branch_id) {
            $branch = Branch::find($request->branch_id);
        } else {
            $branch = null;
        }

        if ($branch != null && $region->id != $branch->region->id) {
            return response()->json(["error_message" => 'Branch is not under this region'], 406);
        }

        foreach ($request->permission_ids as $permission) {
            if (!Permission::find($permission)) {
                return response()->json(["error_message" => 'Permission not found'], 406);
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

        if ($branch == null) {
            $user->region_id = $request->region_id;
        }

        $user->branch_id = $request->branch_id;

        $user->save();

        foreach ($request->permission_ids as $permission) {
            $user->permissions()->attach($permission);
        }
        $user->update();


        // return $request->input();


        // Mail::to($request->email)
        //     ->send(new MailVerifyLinkSender('Verify Email', $user->id, $rnd_int));


        return response()->json(['success_message' => "User created successfully. A verification link has been sent to the user's email."]);
    }

    public function editUser(Request $request, $id)
    {
        $branches = Branch::all();
        $regions = Region::all();
        $user = User::find($id);

        if (!$user) {
            return response()->json(["error_message" => 'User not found'], 406);
        }

        $permissions = Permission::all();

        $user_types = [
            '4' => 'Receptionist',
            '3' => 'Employee',
            '2' => 'Manager',
            '1' => 'CEO',
            // '0' => 'System Admin',
        ];

        return response()->json([
            'user' => $user,
            'user_types' => $user_types,
            'branches' => $branches,
            'regions' => $regions,
            'permissions' => $permissions,
        ]);
    }

    public function editUserSubmit(Request $request, $id)
    {
        $request->merge([
            'permission_ids' => array_unique(array_filter($request->permission_ids)),
        ]);

        // return $request->input();

        $validation = validator::make(
            $request->all(),
            [
                'verified' => 'required|numeric|regex:/^[0-1]$/i',
                'name' => 'required|min:3',
                // 'username' => 'required|min:3|unique:users,username',
                // 'email' => 'required|email|unique:users,email',
                'hire_date' => 'required|date|date_format:Y-m-d',
                'type' => 'required|numeric|min:0|max:4',
                'salary' => 'required|numeric|min:0',
                'region_id' => 'required_if:type,==,2',
                'branch_id' => new RequiredIf($request->type >= 3),
                'permission_ids' => 'required|array|min:1|exists:permissions,id',
            ]
        );

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 422);
        }

        $region = Region::find($request->region_id);

        if ($request->branch_id) {
            $branch = Branch::find($request->branch_id);
        } else {
            $branch = null;
        }

        if ($branch != null && $region != null && $region->id != $branch->region->id) {
            return response()->json(["error_message" => 'Branch is not under this region'], 406);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(["error_message" => 'User not found'], 406);
        }


        foreach ($request->permission_ids as $permission) {
            if (!Permission::find($permission)) {
                return response()->json(["error_message" => 'Permission not found'], 406);
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

        if ($branch == null) {
            $user->region_id = $request->region_id;
        }

        $user->branch_id = $request->branch_id;
        $user->update();

        $user->permissions()->detach();
        // return back();
        foreach ($request->permission_ids as $permission) {
            $user->permissions()->attach($permission);
        }

        return response()->json(["success_message" => 'User updated successfully']);
    }

    public function sendEmailVerifyLinkSubmit(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'email' => 'required|email|exists:users,email',
            ]
        );

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();

        if ($user->verify_email === 0) {
            return response()->json(["error_message" => 'User already verified'], 406);
        }

        $rnd_int = random_int(100000, 999999);

        $user->verify_email = $rnd_int;
        $user->password = Crypt::encrypt($rnd_int);
        $user->update();

        Mail::to($request->email)
            ->send(new MailVerifyLinkSender('Verify Email', $user->id, $rnd_int,));

        return response()->json(["success_message" => "A verification link has beed sent to $user->email"]);
    }

    public function deleteUser(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        $validation = validator::make($request->all(), [
            'id' => 'required|exists:permissions,id',
        ]);

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 422);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(["error_message" => 'User not found'], 406);
        }

        $user->delete();

        return response()->json(['success_message' => "User deleted successfully"]);
    }

    // public function createPermission(Request $request)
    // {
    //     return view('ceo.createPermission');
    // }

    public function viewPermissions(Request $request)
    {
        $users = Permission::paginate(5);

        return response()->json(['permissions' => $users]);
    }

    public function viewSearchPermissions(Request $request)
    {
        $validation = validator::make($request->all(), [
            'search_value' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 422);
        }

        $search_value = $request->search_value;
        $permissions = null;

        if (!empty($search_value)) {
            $permissions = Permission::where('name', 'LIKE', "%$search_value%")->paginate(5);
        } else {
            $permissions = Permission::paginate(5);
        }

        if (!$permissions || $permissions->count() == 0) {
            return response()->json(["error_message" => 'No permissions found'], 406);
        }

        return response()->json(['permissions' => $permissions]);
    }

    public function addPermissionSubmit(Request $request)
    {
        $validation = validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 422);
        }

        $permission = new Permission();

        $permission->name = $request->name;
        $permission->invoice_add = $request->invoice_add ? 1 : 0;
        $permission->invoice_manage = $request->invoice_manage ? 1 : 0;
        $permission->inventory_manage = $request->inventory_manage ? 1 : 0;
        $permission->category_manage = $request->category_manage ? 1 : 0;
        $permission->station_manage = $request->station_manage ? 1 : 0;
        $permission->operation_manage = $request->operation_manage ? 1 : 0;
        $permission->permission_mange = $request->permission_mange ? 1 : 0;
        $permission->save();

        return response()->json(["success_message" => 'Permission created successfully']);

        return redirect()->back();
    }

    public function editPermission(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        $validation = validator::make($request->all(), [
            'id' => 'required|exists:permissions,id',
        ]);

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 422);
        }

        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json(["error_message" => 'Permission not found'], 406);
        }

        return response()->json($permission);
    }

    public function editPermissionSubmit(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        $validation = validator::make($request->all(), [
            'id' => 'required|exists:permissions,id',
        ]);

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 422);
        }

        $permission = Permission::find($id);

        $permission->name = $request->name;
        $permission->invoice_add = $request->invoice_add ? 1 : 0;
        $permission->invoice_manage = $request->invoice_manage ? 1 : 0;
        $permission->inventory_manage = $request->inventory_manage ? 1 : 0;
        $permission->category_manage = $request->category_manage ? 1 : 0;
        $permission->station_manage = $request->station_manage ? 1 : 0;
        $permission->operation_manage = $request->operation_manage ? 1 : 0;
        $permission->permission_mange = $request->permission_mange ? 1 : 0;

        $permission->update();

        return response()->json(["success_message" => 'Permission updated successfully']);
    }

    public function deletePermission(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        $validation = validator::make($request->all(), [
            'id' => 'required|exists:permissions,id',
        ]);

        if ($validation->fails()) {
            return response()->json(["error_list" => $validation->errors()], 422);
        }

        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json(["error_message" => 'Permission not found'], 406);
        }

        foreach ($permission->users as $user) {
            $user->permissions()->detach($permission->id);
        }

        $permission->delete();

        return response()->json(["success_message" => 'Permission deleted successfully']);
    }
}
