<?php

namespace Skycoder\SkyPermission\Controllers;

use App\Http\Controllers\Controller;

use Exception;
use Illuminate\Http\Request;
use Skycoder\SkyPermission\Models\PermissionGroup;
use Skycoder\SkyPermission\Models\Submodule;

class PermissionGroupController extends Controller
{







    /*
     |--------------------------------------------------------------------------
     | INDEX METHOD
     |--------------------------------------------------------------------------
    */
    public function index()
    {
        $permissionGroups = PermissionGroup::with('submodule')->orderByDesc('id')->get();
        $submodules = Submodule::orderByDesc('id')->pluck('name', 'id');

        return view('sky-permission::setups.permission-groups.index', compact('submodules', 'permissionGroups'));
    }











    /*
     |--------------------------------------------------------------------------
     | STORE METHOD
     |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $data = $request->validate([

            'name'         => 'required|unique:permission_groups,name',
            'submodule_id' => 'required'
        ]);

        try {

            PermissionGroup::create($data);

            return redirect()->route('permission-groups.index')->with('message', 'Permission Group Create Successfull');

        } catch (Exception $ex) {

            return redirect()->back()->with('error', 'Some error, please check');

        }
    }












    /*
     |--------------------------------------------------------------------------
     | EDIT METHOD
     |--------------------------------------------------------------------------
    */
    public function edit(PermissionGroup $permissionGroup)
    {
        $submodules        = Submodule::pluck('name', 'id');

        $permissionGroups = PermissionGroup::with('submodule')->orderBy('name')->paginate(30);

        return view('sky-permission::setups.permission-groups.index', compact('submodules', 'permissionGroups', 'permissionGroup'));
    }











    /*
     |--------------------------------------------------------------------------
     | UPDATE METHOD
     |--------------------------------------------------------------------------
    */
    public function update(Request $request, PermissionGroup $permissionGroup)
    {
        $data = $request->validate([

            'name'         => 'required|unique:permission_groups,name,' . $permissionGroup->id,
            'submodule_id' => 'required'
        ]);

        try {
            $permissionGroup->update($data);

            return redirect()->route('permission-groups.index')->with('message', 'Permission Group Update Successfully');

        } catch (Exception $ex) {

            return redirect()->route('permission-groups.index')->with('error', 'Some error, please check');

        }
    }











    /*
     |--------------------------------------------------------------------------
     | DELETE/DESTROY METHOD
     |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        try {

            PermissionGroup::destroy($id);

            return redirect()->back()->with('message', 'Data deleted successfully');

        } catch (Exception $ex) {

            return redirect()->back()->with('error', 'Some error, please check');

        }

    }
}
