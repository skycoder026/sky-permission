<?php

namespace Skycoder\SkyPermission\Controllers;

use App\Http\Controllers\Controller;


use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Skycoder\SkyPermission\Models\Permission;
use Skycoder\SkyPermission\Models\PermissionGroup;

class PermissionController extends Controller
{







    /*
     |--------------------------------------------------------------------------
     | INDEX METHOD
     |--------------------------------------------------------------------------
    */
    public function index()
    {
        $permissions = Permission::with('permission_group.submodule.module')->orderByDesc('id')->get();

        return view('sky-permission::setups.permissions.index', compact('permissions'));
    }











    /*
     |--------------------------------------------------------------------------
     | CREATE METHOD
     |--------------------------------------------------------------------------
    */
    public function create()
    {
        $permissionGroups = PermissionGroup::orderByDesc('id')->pluck('name', 'id');

        return view('sky-permission::setups.permissions.create', compact('permissionGroups'));
    }











    /*
     |--------------------------------------------------------------------------
     | STORE METHOD
     |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {

        $data = $request->validate([

            'name'                  => 'required|unique:permissions,name',
            'permission_group_id'   => 'required',
            'description'           => 'nullable',
        ]);


        try {

            $data['slug'] = Str::slug(Str::plural($request->name), '-') . '.index';

            Permission::firstOrCreate($data);

            if ($request->actions != null) {

                foreach ($request->actions as $key => $action) {


                    Permission::firstOrCreate([

                        'permission_group_id'   => $request->permission_group_id,
                        'name'                  => $action,
                        'slug'                  => Str::slug(Str::plural($request->name), '-') . '.' . Str::slug($action, '-'),
                    ]);
                }
            }

            return redirect()->route('permissions.index')->with('message', 'Permission Successfully Created');

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
        $permissionGroups = PermissionGroup::pluck('name', 'id');

        return view('sky-permission::setups.permissions.edit', compact('permission', 'permissionGroups'));
    }











    /*
     |--------------------------------------------------------------------------
     | UPDATE METHOD
     |--------------------------------------------------------------------------
    */
    public function update(Request $request, Permission $permission)
    {
        $data = $request->validate([

            'name'                  => 'required',
            'slug'                  => 'required|unique:permissions,slug,' . $permission->id,
            'permission_group_id'   => 'required',
        ]);

        try {

            $permission->update($request->all());

            return redirect()->route('permissions.index')->with('message', 'Permission Updated Successfully');

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
}
