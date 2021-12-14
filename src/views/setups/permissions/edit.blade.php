@extends('sky-permission::layouts.master')

@section('title', 'Edit Permission')

@section('page-header')
    <i class="fa fa-edit"></i> Edit Permission
@stop

@section('css')

    <link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}" />
@stop


@section('content')

    <div class="row">

        <div class="col-sm-8 col-sm-offset-2">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title"> @yield('page-header')</h4>

                    <span class="widget-toolbar">
                        <a href="{{ route('permissions.index') }}">
                            <i class="ace-icon fa fa-list-alt"></i> List
                        </a>
                    </span>
                    <span class="widget-toolbar">
                        <a href="{{ route('permissions.create') }}">
                            <i class="ace-icon fa fa-plus"></i> Add New
                        </a>
                    </span>

                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <form class="form-horizontal" action="{{ route('permissions.update', $permission->id) }}" method="post" >
                            @csrf
                            @method('PUT')

                            @include('sky-permission::partials._alert_message')




                            <div class="form-group col-sm-12">
                                <label class="col-sm-3 control-label" for="form-field-1-1"> Submodule </label>
                                <div class="col-xs-12 col-sm-8 @error('permission_group_id') has-error @enderror">
                                    <select name="permission_group_id" id="form-field-select-3" style="with:100% !important" data-placeholder="Select" class="form-control chosen-select">
                                        <option value="">-Select-</option>
                                        @foreach($permissionGroups as $id => $permissionGroup)
                                        <option value="{{ $id }}" {{ $id == $permission->permission_group_id ? 'selected' : '' }}>{{ $permissionGroup }}</option>
                                        @endforeach
                                    </select>

                                    @error('permission_group_id')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-field-1-1">Name </label>
                                <div class="col-xs-12 col-sm-8 @error('name') has-error @enderror">
                                    <input type="text" class="form-control" name="name"
                                           value="{{ old('name') ?: $permission->name }}" placeholder="Permission Name">

                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-field-1-1">Slug </label>
                                <div class="col-xs-12 col-sm-8 @error('slug') has-error @enderror">
                                    <input type="text"  class="form-control" name="slug"
                                           value="{{ old('slug') ?: $permission->slug }}" placeholder="Permission Slug">

                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>




                            <div class="form-group">
                                <label for="inputError" class="col-xs-12 col-sm-3 col-md-3 control-label"></label>
                                <div class="col-xs-12 col-sm-6">
                                    <button class="btn btn-success"> <i class="fa fa-edit"></i> Update</button>
                                    <a href="{{ route('permissions.index') }}" class="btn btn-info"> <i class="fa fa-list"></i> List </a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>




@endsection

@section('js')

    <script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.maskedinput.min.js') }}"></script>


    <script src="{{ asset('assets/custom-js/chosen-box.js') }}"></script>

    <!--  Select Box Search-->
    <script type="text/javascript">
        jQuery(function($){
            if(!ace.vars['touch']) {
                $('.chosen-select').chosen({allow_single_deselect:true});
            }
        });
    </script>


@stop
