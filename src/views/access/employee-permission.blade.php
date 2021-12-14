@extends('layouts.master')
@section('title', 'Employee Permission')
@section('page-header')
    <i class="fa fa-plus-circle"></i> Employee Permission
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}" />
@stop


@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="widget-box">
                <div class="widget-header" style="background:#DFE2CD">

                    <span class="widget-toolbar pull-left" style="font-size:20px !important; color:#41B883">
                        Edit User Permission
                    </span>
                </div>

                <form class="form-horizontal" action="{{ route('permission-access.employee.store') }}" method="post" role="form">
                    @csrf 


                    <!-- Ppermissions For Employee -->
                    <ul style="list-style:none" class="list-group">
                        @foreach ($modules->where('name', 'Employee Permission') as $index => $module)
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
                                                                                    <input type="checkbox" name="employee_permissions[]" value="{{ $permission->id }}" {{ in_array($permission->slug, $isEmployeePermitted) ? 'checked' : '' }} class="ace {{ $loop->first ? ' childCheckBox module_row' : 'childCheckBox rowChildCheckBox' }}">
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
                    <div class="btn-group pull-right" style="margin-top:14px">
                        <a href="{{ route('permitted.users') }}" class="btn btn-sm  btn-info"> <i class="fa fa-list"></i> List</a>
                        <button class="btn  btn-sm btn-success"> <i class="fa fa-save"></i> Save </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <input type="hidden" id="csrf" value="{{ csrf_token() }}">

@endsection

@section('js')

<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.custom.min.js') }}"></script>
<script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>


<script src="{{ asset('assets/js/ace-elements.min.js') }}"></script>
<script src="{{ asset('assets/js/ace.min.js') }}"></script>


{{-- dynamically control checkbox --}}
<script type="text/javascript">

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



{{-- // populate employee information when select employee id --}}
<script type="text/javascript">
    $(".employee_full_id").change(function () {
        var employee_id = $(this).val();
        var csrf_token  = $("#csrf").val();

        // fetch data using ajax
        $.ajax({
            url: '{{ route('selected_employee') }}',
            type: 'POST',
            data: 'id='+employee_id+'&_token='+csrf_token,

            success: function (res) {
                console.log(res);
                $(".employee_name").val(res.name);
                $(".company_id").val(res.company_id);
                $(".email").val(res.email);
                $(".department").val(res.department.name);
                $(".designation").val(res.designation.name);
            }
        });
    })
</script>
{{-- acrodion --}}


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
