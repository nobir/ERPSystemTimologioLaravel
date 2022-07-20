<?php

namespace App\Http\Controllers;

use App\Mail\MailVerifyLinkSender;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Region;
use App\Models\Address;
use App\Models\Category;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class ManagerController extends Controller
{
    public function index(Request $request)
    {
        return view('manager.index');
    }

    public function createBranch(Request $request)
    {
        $regions = Region::all();
        return view('manager.createBranch')
            ->with('regions', $regions);
    }

    public function createBranchSubmit(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' =>  "required|unique:branches,name",
                'region_id' => "required",
                'local_address' => "required",
                'police_station' => "required",
                'city' => "required",
                'country' => "required",
                'zip_code' => "required",
            ],
            [
                'local_address.required' => "Local address is necessary; Such as:Bashundhara R/A",
                'police_station.required' => "Local Police station is necessary; Such as:Vatara,Pollobi",
                'city.required' => "City name is needed; Such as:Dhaka, Rajshahi",
                'country.required' => "Country name is required; Such as: Bangladesh, Norway",
                'zip_code.required' => "Zip code is needed; Such as: 1200,1230",
            ]
        );

        $region = Region::find($request->region_id);

        if (!$region || $region->count() == 0) {
            $request->session()->flash('error_message', 'Region not found.');
            return redirect()->route('manager.viewEmployees');
        }

        $address = new Address();
        $address->local_address = $request->local_address;
        $address->police_station = $request->police_station;
        $address->city = $request->city;
        $address->country = $request->country;
        $address->zip_code = $request->zip_code;
        $address->save();

        $branch = new Branch();
        $branch->name = $request->name;
        $branch->region_id = $request->region_id;
        $branch->address_id = $address->id;
        $branch->save();

        $request->session()->flash('success_message', 'Successfully Branch Created');
        return redirect()->back();
    }

    public function editBranch(Request $request, $id)
    {
        $branch = Branch::where('id', $id)->first();
        $regions = Region::all();
        if (!$branch) {
            $request->session()->flash('error_message', 'Invalid branch ID');
            return redirect()->route('manager.index');
        }
        return view('manager.editBranch')
            ->with('branch', $branch)
            ->with('regions', $regions);
    }

    public function editBranchSubmit(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                // 'name' =>  "required|unique:branches,name",
                'region_id' => "required",
                'local_address' => "required",
                'police_station' => "required",
                'city' => "required",
                'country' => "required",
                'zip_code' => "required",
            ],
            [
                'local_address.required' => "Local address is necessary; Such as:Bashundhara R/A",
                'police_station.required' => "Local Police station is necessary; Such as:Vatara,Pollobi",
                'city.required' => "City name is needed; Such as:Dhaka, Rajshahi",
                'country.required' => "Country name is required; Such as: Bangladesh, Norway",
                'zip_code.required' => "Zip code is needed; Such as: 1200,1230",
            ]
        );

        $region = Region::find($request->region_id);

        if (!$region || $region->count() == 0) {
            $request->session()->flash('error_message', 'Region not found.');
            return redirect()->route('manager.viewEmployees');
        }

        $branch = Branch::where('id', $id)->first();
        // $branch->name = $request->name;
        $branch->region_id = $request->region_id;
        $branch->address->local_address = $request->local_address;
        $branch->address->police_station = $request->police_station;
        $branch->address->city = $request->city;
        $branch->address->country = $request->country;
        $branch->address->zip_code = $request->zip_code;
        $branch->address->update();
        $branch->update();

        $request->session()->flash('success_message', 'Successfully Brance Updated');
        return redirect()->back();
    }

    public function viewBranches(Request $request)
    {
        $branches = Branch::paginate(5);

        return view('manager.viewBranches')
            ->with('branches', $branches);
    }

    public function deleteBranch(Request $request, $id)
    {
        $branch = Branch::find($id);

        if (!$branch) {
            $request->session()->flash('error_message', 'Branch not found.');
            return redirect()->back();
        }

        $branch->delete();

        $request->session()->flash('success_message', "Branch deleted successfully.");

        return redirect()->back();
    }

    public function viewCategories()
    {
        $categories = Category::paginate(5);

        return view("manager.viewCategories")
            ->with('categories', $categories);
    }

    public function createCategory(Request $request)
    {
        return view('manager.createCategory');
    }

    public function createCategorySubmit(Request $request)
    {
        $this->validate(
            $request,
            [
                "name" => "required|min:3",
                "details" => "required",
                "size" => "required|numeric",
                "cost_price" => "required|numeric",
                "sell_price" => "required|numeric",
                "discount" => "required|numeric",
            ]
        );

        $category = new Category();

        $category->name = $request->name;
        $category->details = $request->details;
        $category->size = $request->size;
        $category->cost_price = $request->cost_price;
        $category->sell_price = $request->sell_price;
        $category->discount = $request->discount;

        $category->save();

        $request->session()->flash('success_message', "Successfully created category.");

        return redirect()->back();
    }

    public function editCategory(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category || $category->count() == 0) {
            $request->session()->flash('error_message', 'Category not found.');
            return redirect()->route('manager.viewEmployees');
        }

        return view('manager.editCategory')
            ->with('category', $category);
    }

    public function editCategorySubmit(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                "name" => "required|min:3",
                "details" => "required",
                "size" => "required|numeric",
                "cost_price" => "required|numeric",
                "sell_price" => "required|numeric",
                "discount" => "required|numeric",
            ]
        );

        $category = Category::find($id);

        if (!$category || $category->count() == 0) {
            $request->session()->flash('error_message', 'Category not found.');
            return redirect()->route('manager.viewEmployees');
        }

        $category->name = $request->name;
        $category->details = $request->details;
        $category->size = $request->size;
        $category->cost_price = $request->cost_price;
        $category->sell_price = $request->sell_price;
        $category->discount = $request->discount;

        $category->update();

        $request->session()->flash('success_message', 'Successfully Category Updated');
        return redirect()->back();
    }

    public function deleteCategory(Request $request, $id)
    {
        $branch = Category::find($id);

        if (!$branch) {
            $request->session()->flash('error_message', 'Category not found.');
            return redirect()->back();
        }

        $branch->delete();

        $request->session()->flash('success_message', "Category deleted successfully.");

        return redirect()->back();
    }

    public function viewEmployees(Request $request)
    {
        $users = User::where('verified', 1)->where('type', 3)->paginate(5);

        return view('manager.viewEmployees')
            ->with('users', $users);
    }

    public function searchEmployees(Request $request)
    {
        return redirect()->back();
    }

    public function searchEmployeesSubmit(Request $request)
    {
        $this->validate($request, [
            'search_by' => 'required|in:id,name,username,email,local_address,police_station,city,zip_code,country,station,permission',
            'search_value' => 'required',
        ]);

        return redirect()->route('manager.viewSearchEmployees', [
            'search_by' => $request->search_by,
            'search_value' => $request->search_value,
        ]);
    }

    public function viewSearchEmployees(Request $request, $search_by, $search_value)
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
            return redirect()->route('manager.viewEmployees');
        }

        return view('manager.viewEmployees')
            ->with('users', $users);
    }

    public function createEmployee(Request $request)
    {
        $branches = Branch::all();
        $permissions = Permission::all();

        return view('manager.createEmployee')
            ->with('branches', $branches)
            ->with('permissions', $permissions);
    }

    public function createEmployeeSubmit(Request $request)
    {
        // $request->merge([
        //     'permission_ids' => array_unique(array_filter($request->permission_ids)),
        // ]);

        $this->validate(
            $request,
            [
                'verified' => 'required|numeric|regex:/^[0-1]$/i',
                'name' => 'required|min:3',
                'username' => 'required|min:3|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'hire_date' => 'required|date|date_format:Y-m-d',
                // 'type' => 'required|numeric|min:0|max:4',
                'salary' => 'required|numeric|min:0',
                'branch_id' => 'required|numeric|exists:branches,id',
                // 'permission_ids' => 'required|array|exists:permissions,id',
            ]
        );

        // return $request->input();

        $branch = Branch::find($request->branch_id);

        if (!$branch) {
            $request->session()->flash('error_message', 'Branch not found.');
            return redirect()->back();
        }

        // foreach ($request->permission_ids as $permission) {
        //     if (!Permission::find($permission)) {
        //         $request->session()->flash('error_message', 'Permission not found.');

        //         return redirect()->back();
        //     }
        // }

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
        $user->type = 3;
        $user->email = $request->email;
        $user->password = Crypt::encrypt($rnd_int);
        $user->salary = $request->salary;
        $user->hire_date = $request->hire_date;
        $user->address_id = $address->id;
        $user->branch_id = $branch->id;
        $user->save();

        // foreach ($request->permission_ids as $permission) {
        //     $user->permissions()->attach($permission);
        // }
        $user->update();


        // return $request->input();


        Mail::to($request->email)
            ->send(new MailVerifyLinkSender('Verify Email', $user->id, $rnd_int));

        $request->session()->flash('success_message', "Employee created successfully. A verification link has been sent to the user's email.");

        return redirect()->route('manager.createEmployee');
    }

    public function deleteEmployee(Request $request, $id)
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

    public function editEmployee(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            $request->session()->flash('error_message', 'User not found.');
            return redirect()->back();
        }

        $branches = Branch::all();
        $permissions = Permission::all();

        // $user_types = [
        //     '4' => 'Receptionist',
        //     '3' => 'Employee',
        //     '2' => 'Manager',
        //     '1' => 'CEO',
        //     // '0' => 'System Admin',
        // ];

        return view('manager.editEmployee')
            ->with('user', $user)
            //->with('user_types', $user_types)
            ->with('branches', $branches)
            ->with('permissions', $permissions);
    }

    public function editEmployeeSubmit(Request $request, $id)
    {
        // $request->merge([
        //     'permission_ids' => array_unique(array_filter($request->permission_ids)),
        // ]);

        // return $request->input();

        $this->validate(
            $request,
            [
                'verified' => 'required|numeric|regex:/^[0-1]$/i',
                'name' => 'required|min:3',
                // 'username' => 'required|min:3|unique:users,username',
                // 'email' => 'required|email|unique:users,email',
                'hire_date' => 'required|date|date_format:Y-m-d',
                // 'type' => 'required|numeric|min:0|max:4',
                'salary' => 'required|numeric|min:0',
                'branch_id' => 'required|numeric|exists:branches,id',
                // 'permission_ids' => 'required|array|min:1|exists:permissions,id',
            ]
        );

        $branch = Branch::find($request->branch_id);

        if (!$branch) {
            $request->session()->flash('error_message', 'Branch not found.');
            return redirect()->back();
        }

        $user = User::find($id);

        if (!$user) {
            $request->session()->flash('error_message', 'User not found.');
            return redirect()->back();
        }


        // foreach ($request->permission_ids as $permission) {
        //     if (!Permission::find($permission)) {
        //         $request->session()->flash('error_message', 'Permission not found.');

        //         return redirect()->back();
        //     }
        // }

        // return $request->input();

        $user->verified = $request->verified;
        $user->name = $request->name;
        // $user->type = $request->type;
        $user->salary = $request->salary;
        $user->hire_date = $request->hire_date;
        $user->address->local_address = $request->local_address;
        $user->address->police_station = $request->police_station;
        $user->address->city = $request->city;
        $user->address->country = $request->country;
        $user->address->zip_code = $request->zip_code;
        $user->address->update();
        $user->branch_id = $branch->id;
        $user->update();


        // $user->permissions()->detach();
        // // return back();
        // foreach ($request->permission_ids as $permission) {
        //     $user->permissions()->attach($permission);
        // }

        $request->session()->flash('success_message', "Employee updated successfully.");

        return redirect()->back();
    }
}
