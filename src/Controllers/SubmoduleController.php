<?php

namespace Skycoder\SkyPermission\Controllers;

use App\Http\Controllers\Controller;

use Exception;
use Illuminate\Http\Request;
use Skycoder\SkyPermission\Models\Module;
use Skycoder\SkyPermission\Models\Submodule;

class SubmoduleController extends Controller
{







    /*
     |--------------------------------------------------------------------------
     | INDEX METHOD
     |--------------------------------------------------------------------------
    */
    public function index()
    {
        $submodules = Submodule::with('module')->orderByDesc('id')->get();

        $modules    = Module::orderBy('name')->pluck('name', 'id');

        return view('sky-permission::setups.submodules.index', compact('submodules', 'modules'));
    }













    /*
     |--------------------------------------------------------------------------
     | STORE METHOD
     |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $data = $request->validate([

            'name'      => 'required|unique:submodules,name',
            'module_id' => 'required'
        ]);

        try {

            Submodule::create($data);

            return redirect()->route('submodules.index')->with('message', 'Sub Module Create Successfull');

        } catch (Exception $ex) {

            return redirect()->back()->with('error', 'Some error, please check');
        }
    }












    /*
     |--------------------------------------------------------------------------
     | EDIT METHOD
     |--------------------------------------------------------------------------
    */
    public function edit(Submodule $submodule)
    {
        $modules    = Module::orderBy('name')->pluck('name', 'id');

        $submodules = Submodule::with('module')->orderBy('name')->paginate(30);

        return view('sky-permission::setups.submodules.index', compact('modules', 'submodules', 'submodule'));
    }











    /*
     |--------------------------------------------------------------------------
     | UPDATE METHOD
     |--------------------------------------------------------------------------
    */
    public function update(Request $request, Submodule $submodule)
    {
        $data = $request->validate([

            'name'      => 'required|unique:submodules,name,' . $submodule->id,
            'module_id' => 'required'
        ]);

        try {

            $submodule->update($data);

            return redirect()->route('submodules.index')->with('message', 'Submodule Update Successfull');

        } catch (Exception $ex) {

            return redirect()->route('submodules.index')->with('error', 'Some error, please check');
        }
    }











    /*
     |--------------------------------------------------------------------------
     | DELETE/DESTROY METHOD
     |--------------------------------------------------------------------------
    */
    public function destroy(Submodule $submodule)
    {
        try {

            $submodule->delete();

            return redirect()->route('submodules.index')->with('message', 'Sub Module deleted Successfull');

        } catch (Exception $ex) {

            return redirect()->back()->with('error', 'Some error, please check');
        }
    }
}
