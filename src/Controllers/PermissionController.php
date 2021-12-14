<?php

namespace Module\Permission\Controllers;

use App\Http\Controllers\Controller;


use Module\Permission\Models\Permission;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Module\Permission\Models\ParentPermission;

class PermissionController extends Controller
{







    /*
     |--------------------------------------------------------------------------
     | INDEX METHOD
     |--------------------------------------------------------------------------
    */
    public function index()
    {
        $permissions = Permission::with('parent_permission.submodule.module')->orderByDesc('id')->paginate(20000);

        return view('permission.index', compact('permissions'));
    }

   
    








    /*
     |--------------------------------------------------------------------------
     | CREATE METHOD
     |--------------------------------------------------------------------------
    */
    public function create()
    {
        $parentPermissions = ParentPermission::orderByDesc('id')->pluck('name', 'id');

        return view('permission.create', compact('parentPermissions'));
    }

   
    








    /*
     |--------------------------------------------------------------------------
     | STORE METHOD
     |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {

        $data = $request->validate([

            'name'                 => 'required|unique:permissions,name',
            'parent_permission_id' => 'required',
            'description'          => 'nullable',
        ]);

        
        try {

            $data['slug'] = Str::slug(Str::plural($request->name), '-') . '.index';
       
            Permission::firstOrCreate($data);

            if ($request->actions != null) {

                foreach ($request->actions as $key => $action) {


                    Permission::firstOrCreate([
                        'parent_permission_id' => $request->parent_permission_id,
                        'name'                 => $action,
                        'slug'                 => Str::slug(Str::plural($request->name), '-') . '.' . Str::lower($action),
                        'description'          => $request->description,
                    ]);
                }
            }

            return redirect()->route('permissions.index')->with('message', 'Permission Create Successfull');

        } catch (Exception $ex) {

            return redirect()->back()->with('error', $ex->getMessage());
            
        }
    }




    







    /*
     |--------------------------------------------------------------------------
     | EDIT METHOD
     |--------------------------------------------------------------------------
    */
    public function edit(Permission $permission)
    {
        $parentPermissions = ParentPermission::pluck('name', 'id');

        return view('permission.edit', compact('permission', 'parentPermissions'));
    }

    

    







    /*
     |--------------------------------------------------------------------------
     | UPDATE METHOD
     |--------------------------------------------------------------------------
    */
    public function update(Request $request, Permission $permission)
    {
        $data = $request->validate([

            'name'                 => 'required',
            'slug'                 => 'required|unique:permissions,slug,' . $permission->id,
            'parent_permission_id' => 'required',
        ]);

        try {

            $permission->update($request->all());

            return redirect()->route('permissions.index')->with('message', 'Permission Update Successfull');

        } catch (Exception $ex) {

            return redirect()->back()->with('error', 'Some error, please check');
        }
    }


    







    /*
     |--------------------------------------------------------------------------
     | DELETE/DESTROY METHOD
     |--------------------------------------------------------------------------
    */
    public function destroy(Permission $permission)
    {
        try {

            $permission->delete();

            return redirect()->back()->with('message', 'Permission deleted Successfull');

        } catch (Exception $ex) {

            return redirect()->back()->with('error', $ex->getMessage());

        }
    }




    







    /*
     |--------------------------------------------------------------------------
     | PERMITTED USER LIST
     |--------------------------------------------------------------------------
    */
    public function view_permitted_users(Request $request)
    {
        $this->updateEmployeeId($request);

        $users = User::orderByDesc('id')
            ->with('company', 'employee.department', 'employee.designation')
            ->where('status', '>', 0)
            ->whereHas('employee')
            ->get();

        return view('permitted_user_list', compact('users'));
    }


    







    /*
     |--------------------------------------------------------------------------
     | UPDATE EMPLOYEE ID
     |--------------------------------------------------------------------------
    */
    public function updateEmployeeId($request)
    {
        if ($request->filled('update_type')) {
            $users = User::active()->whereNotNull('employee_id')->whereNull('employee_full_id')->with('employee:id,employee_full_id')->get();

            foreach($users ?? [] as $user) {
                $user->update(['employee_full_id' => optional($user->employee)->employee_full_id]);
            }
        }
    }


    







    /*
     |--------------------------------------------------------------------------
     | DELETE PERMITTED USER
     |--------------------------------------------------------------------------
    */
    public function permittedUserDelete(User $user)
    {
        try {

            $user->companies()->detach();

            $user->departments()->detach();

            $user->designations()->detach();

            $user->permissions()->detach();

            $user->status = 0;
            $user->employee_id = null;

            $user->save();

            return redirect()->route('permitted.users')->with('message', 'User delete and permisions reset successfull');

        } catch (Exception $th) {

            return redirect()->back()->with('error', 'Some error please check');
        }
    }


    







    /*
     |--------------------------------------------------------------------------
     | CHANGE USER STATUS
     |--------------------------------------------------------------------------
    */
    public function userChangeStatus($id, $status)
    {
        $user = User::find($id);

        $user->status = $status;

        $user->save();
        
        return redirect()->back();
    }
}
