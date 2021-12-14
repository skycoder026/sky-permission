@extends('layouts.master')
@section('title','User Role')
@section('page-header')
    <i class="fa fa-plus-circle"></i> User Role/Permission
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-multiselect.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-multiselect.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">

<style>

	.panel-group .panel {
		border-radius: 5px;
		border-color: #EEEEEE;
        padding:0;
	}

	.panel-default > .panel-heading {
        color: #010101;
        background-color: #f2f2f2;
		border-color: ##EEEEEE;
	}

	.panel-title {
		font-size: 14px;
	}

	.panel-title > a {
		display: block;
		padding: 2px;
		text-decoration: none;
	}

	.short-full {
		float: right;
        color: #010101;
	}
</style>
@stop


@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="widget-box">
                <div class="widget-header" style="background:#DFE2CD">


                    <h4 class="widget-title" style="font-size:20px !important; color:#41B883"> User Role/Permission </h4>

                    <span class="widget-toolbar">
                        <a href="{{ route('permission-access.create') }}">
                            <i class="ace-icon fa fa-list-alt"></i> Clear
                        </a>
                    </span>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <form class="form-horizontal" action="{{ route('permission-access.store') }}" method="POST" role="form">
                            @csrf

                            <!-- Employee info -->
                            <div class="row">


                                @include('partials._alert_message')


                                 <div class="col-md-4 pull-right" style="height: 40px;">
                                    <div class="input-group" style="width:100%">
                                        <select class="chosen-select-100-percent form-control existing_employee" name="existing_employee">
                                            <option value="">- select -</option>
                                            @foreach ($existing_employee as $key => $employee)
                                                @if (isset($user))
                                                    <option value="{{ $employee->id }}" {{ $user->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->employee_full_id }} -> {{ $employee->name }}</option>
                                                @else
                                                    <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->employee_full_id }} -> {{ $employee->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="input-group-btn">
                                            <a href="" class="btn btn-default btn-sm load-employee" type="button"> Load Permissions </a>
                                        </span>
                                    </div>
                                </div>


                            </div>


                            <!-- Employee info -->
                            <div class="row">


                                <div class="col-md-4" style="height: 40px;">
                                   <div class="input-group" style="width:100%">
                                       <label class="input-group-addon" style="width:130px; text-align:left"> Employee Id </label>
                                       <select class="chosen-select form-control" id="select-new-employee-id" onchange="loadEmployeeInfo(this)" name="employee_id">
                                           <option value=""> select </option>
                                           @foreach ($employee_ids as $id => $employee)
                                               <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}
                                                    data-name="{{ $employee->name }}"
                                                    data-email="{{ $employee->email }}"
                                                    data-full-id="{{ $employee->employee_full_id }}"
                                                    data-company="{{ $employee->company_id }}"
                                                    data-department="{{ optional($employee->department)->name }}"
                                                    data-designation="{{ optional($employee->designation)->name }}"
                                                    >
                                                    {{ $employee->employee_full_id }} -> {{ $employee->name }}
                                                </option>
                                           @endforeach
                                       </select>
                                   </div>
                               </div>


                                <input type="hidden" class="company_id" name="company_id">

                                <div class="col-md-4" style="height: 40px;">
                                    <div class="input-group" style="width:100%">
                                        <label class="input-group-addon" style="width:130px; text-align:left"> Employee Name </label>
                                        <input type="text" name="employee_name"  value="{{ old('employee_name') }}"  class="form-control employee_name" readonly  />
                                    </div>
                                </div>

                                <div class="col-md-4" style="height: 40px;">
                                    <div class="input-group" style="width:100%">
                                        <label class="input-group-addon" style="width:130px; text-align:left"> Email </label>
                                        <input type="text" class="form-control email" name="email" value="{{ old('email') }}" placeholder="Employee Email"  />
                                    </div>
                                </div>

                                <div class="col-md-4" style="height: 40px;">
                                    <div class="input-group" style="width:100%">
                                        <label class="input-group-addon" style="width:130px; text-align:left"> Employee Full Id </label>
                                        <input type="text" name="employee_full_id" value="{{ old('employee_full_id') }}" class="form-control employee-full-id" readonly />
                                    </div>
                                </div>

                                <div class="col-md-4" style="height: 40px;">
                                    <div class="input-group" style="width:100%">
                                        <label class="input-group-addon" style="width:130px; text-align:left"> Department </label>
                                        <input type="text" name="department" value="{{ old('department') }}" class="form-control department" readonly />
                                    </div>
                                </div>

                                <div class="col-md-4" style="height: 40px;">
                                    <div class="input-group" style="width:100%">
                                        <label class="input-group-addon" style="width:130px; text-align:left"> Designation </label>
                                        <input type="text" name="designation" value="{{ old('designation') }}" class="form-control designation" readonly />
                                    </div>
                                </div>


                                <div class="col-md-4" style="height: 40px;">
                                    <div class="input-group" style="width:100%">
                                        <label class="input-group-addon" style="width:130px; text-align:left"> Password </label>
                                        <input type="password" name="password" class="form-control" placeholder=".............." class="form-control" />
                                    </div>
                                </div>










                                <!-- branches -->
                                <div class="col-md-4 pull-right" style="height: 40px;">
                                   <div class="input-group" style="width:100%">
                                        <label class="input-group-addon">Branch</label>
                                        <select class="chosen-select-100-percent form-control" name="branch_id">
                                           <option value="">- select -</option>
                                           @foreach ($branches as $id => $name)
                                                <option value="{{ $id }}" {{ old('brnach_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                           @endforeach
                                        </select>
                                   </div>
                               </div>
                            </div>




                            <!-- Company -->
                            @if( in_array('Company', $hasFeatures))
                                <div class="panel-group" style="margin-top:40px" id="accordion" role="tablist" aria-multiselectable="true">

                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="company_collapse">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_company" aria-expanded="true" aria-controls="collapse_company">
                                                    <i class="short-full glyphicon glyphicon-plus"></i>
                                                    <span style="line-height:12px; font-size:15px; font-weight:800; letter-spacing: 1.5px"> Companies </span>
                                                </a>
                                            </h4>
                                        </div>

                                        <div id="collapse_company" class="panel-collapse collapse" role="tabpanel" aria-labelledby="company_collapse">
                                            <div class="panel-body">
                                                <div class="row order-type">
                                                    <table class="table table-bordered table-sm mx-auto" style="width:98%; margin-left:auto; margin-right:auto; color:#41B883">
                                                        <thead>
                                                            <tr>
                                                                <td colspan="5">
                                                                    <label>
                                                                        <input type="checkbox" class="ace parentCheckBox">
                                                                        <span class="lbl" style="font-weight:800"> Select All </span>
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                        </thead>


                                                        <tbody>
                                                            @foreach ($companies->chunk(5) as $row)
                                                                <tr>
                                                                    @foreach ($row as $id => $company)
                                                                        <td width="20%">
                                                                            <label>
                                                                                @if (isset($hasCompanies))
                                                                                    <input name="companies[]" value="{{ $id }}" {{ in_array($company, $hasCompanies) ? 'checked' : '' }} type="checkbox" class="ace childCheckBox">
                                                                                @else
                                                                                    <input name="companies[]" value="{{ $id }}" type="checkbox" class="ace childCheckBox">
                                                                                @endif
                                                                                <span class="lbl"> {{ $company }} </span>
                                                                            </label>
                                                                        </td>
                                                                    @endforeach
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif


                            <!-- Department -->
                            @if( in_array('Department', $hasFeatures))
                                <div class="panel-group" style="margin-top:40px" id="accordion" role="tablist" aria-multiselectable="true">

                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="department_collapse">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_department" aria-expanded="true" aria-controls="collapse_department">
                                                    <i class="short-full glyphicon glyphicon-plus"></i>
                                                    <span style="line-height:12px; font-size:15px; font-weight:800; letter-spacing: 1.5px"> Departments </span>
                                                </a>
                                            </h4>
                                        </div>


                                        <div id="collapse_department" class="panel-collapse collapse" role="tabpanel" aria-labelledby="department_collapse">
                                            <div class="panel-body">
                                                <div class="row order-type">
                                                    <table class="table table-bordered table-sm mx-auto" style="width:98%; margin-left:auto; margin-right:auto; color:#41B883">
                                                        <thead>
                                                            <tr>
                                                                <td colspan="5">
                                                                    <label>
                                                                        <input type="checkbox" class="ace parentCheckBox">
                                                                        <span class="lbl" style="font-weight:800"> Select All </span>
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                        </thead>



                                                        <tbody>
                                                            @foreach ($departments->chunk(5) as $row)
                                                                <tr>
                                                                    @foreach ($row as $id => $department)
                                                                        <td width="20%">
                                                                            <label>
                                                                                @if (isset($hasDepartments))
                                                                                    <input name="departments[]" value="{{ $id }}" {{ in_array($department, $hasDepartments) ? 'checked' : '' }} type="checkbox" class="ace childCheckBox">
                                                                                @else
                                                                                    <input name="departments[]" value="{{ $id }}" type="checkbox" class="ace childCheckBox">
                                                                                @endif
                                                                                <span class="lbl"> {{ $department }} </span>
                                                                            </label>
                                                                        </td>
                                                                    @endforeach
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif



                            <!-- Designation -->
                            @if( in_array('Designation', $hasFeatures))
                                <div class="panel-group" style="margin-top:40px" id="accordion" role="tablist" aria-multiselectable="true">

                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="designation_collapse">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_designation" aria-expanded="true" aria-controls="collapse_designation">
                                                    <i class="short-full glyphicon glyphicon-plus"></i>
                                                    <span style="line-height:12px; font-size:15px; font-weight:800; letter-spacing: 1.5px"> Designations </span>
                                                </a>
                                            </h4>
                                        </div>


                                        <div id="collapse_designation" class="panel-collapse collapse" role="tabpanel" aria-labelledby="designation_collapse">
                                            <div class="panel-body">
                                                <div class="row order-type">
                                                    <table class="table table-bordered table-sm mx-auto" style="width:98%; margin-left:auto; margin-right:auto; color:#41B883">
                                                        <thead>
                                                            <tr>
                                                                <td colspan="5">
                                                                    <label>
                                                                        <input type="checkbox" class="ace parentCheckBox">
                                                                        <span class="lbl" style="font-weight:800"> Select All </span>
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                        </thead>



                                                        <tbody>
                                                            @foreach ($designations->chunk(5) as $row)
                                                                <tr>
                                                                    @foreach ($row as $id => $designation)
                                                                        <td width="20%">
                                                                            <label>
                                                                                @if (isset($hasDepartments))
                                                                                    <input name="designations[]" value="{{ $id }}" {{ in_array($designation, $hasDesignations) ? 'checked' : '' }} type="checkbox" class="ace childCheckBox">
                                                                                @else
                                                                                    <input name="designations[]" value="{{ $id }}" type="checkbox" class="ace childCheckBox">
                                                                                @endif
                                                                                <span class="lbl"> {{ $designation }} </span>
                                                                            </label>
                                                                        </td>
                                                                    @endforeach
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif







                            <!-- access control -->
                            @if ($modules->count() > 0)
                                <div class="well text-center" style="margin-top:30px; margin-left:auto; margin-right:auto; font-size:20px; padding:10px; font-weight:bold">Access Control</div>
                            @endif




                            <!-- menus -->
                            <div class="access-control">
                                <ul style="list-style:none" class="list-group">
                                    @foreach ($modules as $index => $module)
                                        <li class="list-group-item">
                                            <label>
                                                <input type="checkbox" class="ace module-checkbox-control">
                                                <span class="lbl" style="font-size:16px !important"> {{ $module->name }} </span>
                                            </label>
                                            @foreach ($module->submodules as $submodule)
                                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="heading{{ $submodule->id }}">
                                                            <h4 class="panel-title">
                                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $submodule->id }}" aria-expanded="true" aria-controls="collapse{{ $submodule->id }}">
                                                                    <i class="short-full glyphicon glyphicon-plus"></i>
                                                                    <span style="font-size:14px !important">{{ $submodule->name }}</span>
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse{{ $submodule->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $submodule->id }}">
                                                            <div class="panel-body">
                                                                <div class="row order-type" style="margin-top:10px">
                                                                    <table class="table table-striped table-sm mx-auto" style="width:98%; margin-left:auto; margin-right:auto; color:#41B883" >
                                                                        <thead>
                                                                            <tr  style="border:none !important">
                                                                                <td colspan="9" style="border:none !important">
                                                                                    <label>
                                                                                        <input type="checkbox" class="ace parentCheckBox">
                                                                                        <span class="lbl" style="font-weight:800"> Select All </span>
                                                                                    </label>
                                                                                </td>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>

                                                                            @foreach ($submodule->parent_permissions as $in => $parent_permissions)
                                                                                <tr>
                                                                                    @foreach ($parent_permissions->permissions as $permission)
                                                                                        <td style="border:none !important">
                                                                                            <label>
                                                                                                @if (isset($isPermitted))
                                                                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ in_array($permission->slug, $isPermitted) ? 'checked' : '' }} class="ace {{ $loop->first ? ' childCheckBox module_row' : 'childCheckBox rowChildCheckBox' }}">
                                                                                                @else
                                                                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="ace {{ $loop->first ? ' childCheckBox module_row' : 'childCheckBox rowChildCheckBox' }}">
                                                                                                @endif
                                                                                                <span class="lbl"> {{ $permission->name }} </span>
                                                                                            </label>
                                                                                        </td>
                                                                                    @endforeach
                                                                                </tr>
                                                                            @endforeach

                                                                        </tbody>
                                                                    </table>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach
                                        </li>
                                    @endforeach
                                </ul>




                                <!-- actions -->
                                <div class="form-group pull-right" style="margin-top:14px">
                                    <button class="btn  btn-sm btn-success"> <i class="fa fa-save"></i> Save</button>
                                    <a href="{{ route('permissions.index') }}" class="btn btn-sm  btn-info"> <i class="fa fa-list"></i> List </a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" id="csrf" value="{{ csrf_token() }}">

@endsection

@section('js')

<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.custom.min.js') }}"></script>
<script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
<script src="{{ asset('assets/custom_js/chosen-box.js') }}"></script>


<!-- dynamically control checkbox -->
<script type="text/javascript">

    $('.module-checkbox-control').click(function () {
        if($(this).is(':checked')) {
            $(this).closest('li').find('.parentCheckBox').prop("checked", true);
            $(this).closest('li').find('.rowChildCheckBox').prop("checked", true);
            $(this).closest('li').find('.childCheckBox').prop("checked", true);
        } else {
            $(this).closest('li').find('.parentCheckBox').prop("checked", false);
            $(this).closest('li').find('.rowChildCheckBox').prop("checked", false);
            $(this).closest('li').find('.childCheckBox').prop("checked", false);
        }
    })

    // when clicked on Check All
    $(".parentCheckBox").click(function () {
        if($(this).is(':checked')) {
            var childCheckBoxes =  $(this).closest('table').find('tbody tr input');
            childCheckBoxes.prop( "checked", true );

            $.each($(this).closest("table").find('tbody .effected_by_parent'), function(key) {
                $(this).val(1);
            });
        } else {
            var childCheckBoxes =  $(this).closest('table').find('tbody tr input');
            childCheckBoxes.prop("checked", false);

            $.each($(this).closest("table").find('tbody .effected_by_parent'), function(key) {
                $(this).val(0);
            });
        }
    });

    // when clicked on any children checkbox
    $(".childCheckBox").click(function () {
        var flag = true;
        var checkbox_table = $(this).closest('table');

        var childCheckBoxes =  checkbox_table.find('tbody');
        $(childCheckBoxes).find('input[type=checkbox]').each(function () {
            if (!this.checked) {
                flag = false;
            }
        });
        $(this).closest('table').find('thead tr input').prop("checked", flag);

    });

    // when clicked module row on module name
    $(".module_row").click(function () {
        if($(this).is(':checked')) {
            $(this).closest("label").find('.permission_module').val(1);
            var childCheckBoxes =  $(this).closest('tr').find('input');
            childCheckBoxes.prop( "checked", true );

            $.each($(this).closest("tr").find('.array_permission'), function(key) {
                $(this).val(1);
            });
        } else {
            $(this).closest("label").find('.permission_module').val(0);
            var childCheckBoxes =  $(this).closest('tr').find('input');
            childCheckBoxes.prop("checked", false);

            $.each($(this).closest("tr").find('.array_permission'), function(key) {
                $(this).val(0);
            });

        }
    });

    // when clicked on any children checkbox
    $(".rowChildCheckBox").click(function () {
        // set value 1 if checked
        if($(this).is(":checked")) {
            $(this).closest("label").find('.array_permission').val(1);
        } else {
            $(this).closest("label").find(".array_permission").val(0);
        }


        var flag = false;
        var rowChildCheckBoxes = $(this).closest('tr');

        // var rowChildCheckBoxes =  checkbox_table.find('tr');
        $(rowChildCheckBoxes).find('input[type=checkbox]').each(function (index) {
            if (this.checked) {
                if (index != 0) { flag = true; }
            }
        });

        $(this).closest('tr').find('.module_row').prop("checked", flag);

        if (flag) {
            $(this).closest('tr').find('.permission_module').val(1);
        } else {
            $(this).closest('tr').find('.permission_module').val(0);
        }

    });
</script>

<!--  Select Box Search-->
<script type="text/javascript">
    jQuery(function($){
        if(!ace.vars['touch']) {
            $('.chosen-select').chosen({allow_single_deselect:true});
        }
    })
</script>



<!-- // populate employee information when select employee id -->
<script type="text/javascript">
    $(".employee_full_id").change(function () {
        var employee_id = $(this).val();
        var csrf_token  = $("#csrf").val();

        // fetch data using ajax
        $.ajax({
            url: '{{ route('employee_list') }}',
            type: 'get',
            data: 'id='+employee_id+'&_token='+csrf_token,

            success: function (res) {

                $('.hidden-employee-id').val(res.id)
                $(".employee_name").val(res.name);
                $(".company_id").val(res.company_id);
                $(".email").val(res.email);
                $(".department").val(res.department.name);
                $(".designation").val(res.designation.name);
            }
        });
    })
    
    function loadEmployeeInfo(object)
    {
        let employee = $('#select-new-employee-id option:selected')

        $(".employee_name").val(employee.data('name'));
        $(".email").val(employee.data('email'));
        $(".employee-full-id").val(employee.data('full-id'));
        $(".company_id").val(employee.data('company'));
        $(".department").val(employee.data('department'));
        $(".designation").val(employee.data('designation'));
    }

    $('.typeahead').on('typeahead:selected', function(evt, item) {
        let data = item.value.split(" ->")
        loadSelectedEmployee(data[0])
    })
    
    // load existing employees id to a tag
    $('.existing_employee').change(function () {
        var id = $(this).val();
        let text = `/setting/permission-access/create/${id}`
        $(".load-employee").attr("href", text);
    });
</script>


<!-- accrodion -->

<script>
	function toggleIcon(e) {
        $(e.target)
            .prev('.panel-heading')
            .find(".short-full")
            .toggleClass('glyphicon-plus glyphicon-minus');
    }
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>
@stop
