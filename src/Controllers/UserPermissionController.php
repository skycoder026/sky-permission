<?php

namespace Module\Permission\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Company;
use Module\HRM\Models\Department;
use Module\HRM\Models\Designation;
use Module\HRM\Models\Employee\Employee;

use Module\Garments\Models\Merchandising\Order\OrderType;


use Module\Permission\Models\PermissionFeature;
use App\Models\User;
use App\Traits\CheckPermission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Module\Garments\Models\Merchandising\Setup\Buyer;
use Module\Permission\Models\EmployeePermission;
use Module\Permission\Models\Module;
use Module\PosErp\Models\Branch;

class UserPermissionController extends Controller
{
    use CheckPermission;
   






    /*
     |--------------------------------------------------------------------------
     | INDEX METHOD
     |--------------------------------------------------------------------------
    */
    public function index($id)
    {
        $this->hasAccess("permission.accesses.create");     // check permission
        
        $user                 = User::where('employee_id', $id)->where('status', 1)->first();

        $data['user']         = $user;
        $data['modules']      = Module::with('submodules.parent_permissions.permissions')->get();
        $data['companies']    = Company::pluck('name', 'id');
        $data['departments']  = Department::pluck('name', 'id');
        $data['designations'] = Designation::pluck('name', 'id');


        $data['isPermitted']      = $user->permissions()->pluck('slug')->toArray();
        $data['hasCompanies']     = $user->companies()->pluck('name')->toArray();
        $data['hasDepartments']   = $user->departments()->pluck('name')->toArray();
        $data['hasDesignations']  = $user->designations()->pluck('name')->toArray();
        $data['hasFeatures']      = PermissionFeature::where('status', 1)->pluck('name')->toArray();
        $data['branches']         = Branch::pluck('name', 'id');

        $user = User::where('status', 0)->where('employee_id', '!=', null)->pluck('employee_id');

        $data['employee_ids']       = Employee::whereNotIn('id', $user)->select('employee_full_id', 'email', 'company_id', 'department_id', 'designation_id', 'id','name')->with('department:name,id', 'designation:name,id')->get();
        $data['existing_employee']  = Employee::whereHas('user', function ($q) {
            $q->where('status', 1);
        })->get(['employee_full_id', 'id','name']);

        return view('access.create', $data);
    }

   
   
    








    /*
     |--------------------------------------------------------------------------
     | CREATE METHOD
     |--------------------------------------------------------------------------
    */
    public function create()
    {
        $this->hasAccess("permission.accesses.create");     // check permission
    
        $user = User::where('employee_id', '!=', null)->where('status', 1)->pluck('employee_id');

        $data['employee_ids']       = Employee::whereNotIn('id', $user)->select('employee_full_id', 'email', 'company_id', 'department_id', 'designation_id', 'id','name')->with('department:name,id', 'designation:name,id')->get();
        $data['existing_employee']  = Employee::whereHas('user', function ($q) {
            $q->where('status', 1)
                ->whereNotNull('employee_id');
        })->get(['employee_full_id', 'id','name']);

        $data['modules']                = Module::where('name', '!=', 'Employee Permission')->with('submodules.parent_permissions.permissions')->active()->get();
        $data['companies']              = Company::pluck('name', 'id');
        $data['departments']            = Department::pluck('name', 'id');
        $data['designations']           = Designation::pluck('name', 'id');
        $data['hasFeatures']            = PermissionFeature::where('status', 1)->pluck('name')->toArray();
        $data['branches']               = Branch::pluck('name', 'id');

        return view('access.create', $data);
    }

   
   
    








    /*
     |--------------------------------------------------------------------------
     | STORE METHOD
     |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([

            'employee_id'    => 'required',
            'email'          => 'nullable|unique:users',
            'password'       => 'required|min:6',
        ]);

        
        try {

            $user = User::where('employee_id', '=', $request->employee_id)->first();


            if ($user != null) {

                $user_created = $user;

                return redirect()->back()->with('error', 'This employee already has a permission');

            } else {

                $user_created     = User::create([

                    'name'              => $request->employee_name,
                    'employee_id'       => $request->employee_id,
                    'employee_full_id'  => $request->employee_full_id,
                    'company_id'        => $request->company_id,
                    'email'             => $request->email,
                    'password'          => Hash::make($request->password),
                    'branch_id'         => $request->branch_id
                ]);


                $hasFeatures     = PermissionFeature::where('status', 1)->pluck('name')->toArray();


                if ($user_created) {

                    if (in_array('Company', $hasFeatures)) {
                        $user_created->companies()->sync($request->companies);
                    }

                    if (in_array('Department', $hasFeatures)) {
                        $user_created->departments()->sync($request->departments);
                    }

                    if (in_array('Designation', $hasFeatures)) {
                        $user_created->designations()->sync($request->designations);
                    }


                    $user_created->permissions()->sync($request->permissions);

                }
            }

            return back()->with('message', 'Permission create success');

        } catch (Exception $ex) {

            return back()->with('error', $ex->getMessage());
        }
    }

   
    








    /*
     |--------------------------------------------------------------------------
     | EDIT METHOD
     |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $this->hasAccess("permission.accesses.edit");     // check permission
      
        $data['user']         = User::with('branch')->find($id);
        $data['modules']      = Module::where('name', '!=', 'Employee Permission')->with('submodules.parent_permissions.permissions')->active()->get();
        $data['companies']    = Company::pluck('name', 'id');
        $data['departments']  = Department::pluck('name', 'id');
        $data['designations'] = Designation::pluck('name', 'id');




        $data['isPermitted']            = User::find($id)->permissions()->pluck('slug')->toArray();
        $data['hasCompanies']           = User::find($id)->companies()->pluck('name')->toArray();
        $data['hasDepartments']         = User::find($id)->departments()->pluck('name')->toArray();
        $data['hasDesignations']        = User::find($id)->designations()->pluck('name')->toArray();
        $data['hasFeatures']            = PermissionFeature::where('status', 1)->pluck('name')->toArray();

        return view('access.edit', $data);
    }

   
   
    








    /*
     |--------------------------------------------------------------------------
     | UPDATE METHOD
     |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $user_created = User::find($id);

        
        $hasFeatures  = PermissionFeature::where('status', 1)->pluck('name')->toArray();

        if (in_array('Company', $hasFeatures)) {
            $user_created->companies()->sync($request->companies);
        }

        if (in_array('Department', $hasFeatures)) {
            $user_created->departments()->sync($request->departments);
        }
        if (in_array('Designation', $hasFeatures)) {
            $user_created->designations()->sync($request->designations);
        }

        $user_created->permissions()->sync($request->permissions);



        


        if(auth()->id() == $id) {

            session()->forget('slugs');
        }

        return back();
    }


   
    








    /*
     |--------------------------------------------------------------------------
     | EMPLOYEE LIST BY AJAX 
     |--------------------------------------------------------------------------
    */
    public function employee_list(Request $request)
    {
        $employees_info = Employee::with(['company', 'department', 'designation', 'bank_information'])
            ->where('id', $request->id)
            ->orWhere('employee_full_id', $request->id)
            ->where('status', 1)->first();
        return response()->json($employees_info);
    }

   
    








    /*
     |--------------------------------------------------------------------------
     | PERMITTED EMPLOYEE LIST
     |--------------------------------------------------------------------------
    */
    public function permittedEmployeeList()
    {
        $employees = Employee::whereStatus(1)
            ->whereIn('company_id', Company::userCompanyId())
            ->whereIn('department_id', Department::userDepartmentId())
            ->whereIn('designation_id', Designation::userDesignationId())
            ->orderBy('name')
            ->select('employee_full_id', 'name')
            ->get();
        return response()->json($employees);
    }

   
    








    /*
     |--------------------------------------------------------------------------
     | SHOW EMPLOYEE PERMISSION PANEL
     |--------------------------------------------------------------------------
    */
    public function employeePermission(Request $request)
    {
        $this->hasAccess("permission.accesses.create");     // check permission
    

        $data['isEmployeePermitted']    = EmployeePermission::with('permission')->get()->pluck('permission.slug')->toArray();
        $data['modules']                = Module::where('name', 'Employee Permission')->with('submodules.parent_permissions.permissions')->active()->get();

        return view('access.employee-permission', $data);
    }

   
    








    /*
     |--------------------------------------------------------------------------
     | EMPLOYEE PERMISSION STORE
     |--------------------------------------------------------------------------
    */
    public function employeePermissionStore(Request $request)
    {
        $this->hasAccess("permission.accesses.create");     // check permission
    
        try {
            
            
            EmployeePermission::whereNotIn('permission_id', $request->employee_permissions ?? [])->delete();

            $old_employee_permissions = EmployeePermission::pluck('permission_id')->toArray() ?? [];

            $new_items = array_diff(array_filter($request->employee_permissions), $old_employee_permissions);
            $employee_permissions = [];

            foreach ($new_items as $key => $new_item) {

                $employee_permissions[] = [
                    'permission_id' => $new_item
                ];
            }

            if (count($employee_permissions)) {
                EmployeePermission::insert($employee_permissions);
            }

            return back()->with('message', 'Permission assign successfully');

        } catch (Exception $ex) {
            
            return back()->with('error', $ex->getMessage());
        }
    }
}
