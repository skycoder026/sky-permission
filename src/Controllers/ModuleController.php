<?php

namespace Skycoder\SkyPermission\Controllers;

use App\Http\Controllers\Controller;

use Exception;
use Illuminate\Http\Request;
use Skycoder\SkyPermission\Models\Module;

class ModuleController extends Controller
{







    /*
     |--------------------------------------------------------------------------
     | INDEX METHOD
     |--------------------------------------------------------------------------
    */
    public function index()
    {
        $modules = Module::get();

        return view('sky-permission::setups.modules.index', compact('modules'));
    }











    /*
     |--------------------------------------------------------------------------
     | STORE METHOD
     |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:modules,name']);

        try {

            Module::create(['name' => $request->name]);

            return redirect()->route('modules.index')->with('message', 'Module Create Successfull');

        } catch (Exception $ex) {

            return redirect()->back()->with('error', 'Some error, please check');
        }
    }









    /*
     |--------------------------------------------------------------------------
     | ACTIVE - DEACTIVE MODULE STATUS
     |--------------------------------------------------------------------------
    */
    public function activeDeactive(Module $module)
    {
        if ($module->status == 1) {

            $module->update(['status' => 0]);

            return redirect()->back()->with('message', $module->name . ' De-ctivated successfully');

        } else {

            $module->update(['status' => 1]);

            return redirect()->back()->with('message', $module->name . ' Activated successfully');
        }
    }










    /*
     |--------------------------------------------------------------------------
     | EDIT METHOD
     |--------------------------------------------------------------------------
    */
    public function edit(Module $module)
    {
        $modules = Module::orderBy('name')->paginate(30);

        return view('sky-permission::setups.modules.index', compact('modules', 'module'));
    }









    /*
     |--------------------------------------------------------------------------
     | UPDATE METHOD
     |--------------------------------------------------------------------------
    */
    public function update(Request $request, Module $module)
    {
        $request->validate(['name' => 'required|unique:modules,name,' . $module->id]);

        try {

            $module->update(['name' => $request->name]);

            return redirect()->route('modules.index')->with('message', 'Module Update Successfull');

        } catch (Exception $ex) {

            return redirect()->route('modules.index')->with('error', 'Some error, please check');
        }
    }









    /*
     |--------------------------------------------------------------------------
     | DELETE/DESTROY METHOD
     |--------------------------------------------------------------------------
    */
    public function destroy(Module $module)
    {
        try {

            $module->delete();

            return redirect()->route('modules.index')->with('message', 'Module deleted Successfull');

        } catch (Exception $ex) {

            return redirect()->back()->with('error', 'Some error, please check');
        }
    }
}
