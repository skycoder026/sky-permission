@extends('sky-permission::layouts.master')

@section('title', 'Create Permission')

@section('page-header')
    <i class="fa fa-plus-circle"></i> Create Permission
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
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <form class="form-horizontal" action="{{ route('permissions.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            @include('sky-permission::partials._alert_message')


                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-field-1-1"> Parent Permission  </label>
                                <div class="col-xs-12 col-sm-8 @error('permission_group_id') has-error @enderror">
                                    <select class="chosen-select form-control" name="permission_group_id">
                                        <option value=""> select </option>
                                        @foreach ($permissionGroups as $id => $permissionGroup)
                                            <option value="{{ $id }}" {{ old('permission_group_id') == $id ? 'selected' : '' }}>{{ $permissionGroup }}</option>
                                        @endforeach
                                    </select>
                                    @error('permission_group_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-field-1-1"> Permission Name </label>
                                <div class="col-xs-12 col-sm-8 @error('name') has-error @enderror">
                                    <input type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" placeholder="Permission Name">

                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-field-1-1"> With </label>
                                <div class="col-xs-12 col-sm-8">
                                     <label>
                                        <input type="checkbox" name="actions[]" checked value="View" class="ace">
                                        <span class="lbl"> View </span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="actions[]" checked value="Create" class="ace">
                                        <span class="lbl"> Create </span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="actions[]" checked value="Edit" class="ace">
                                        <span class="lbl"> Edit </span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="actions[]" checked value="Delete" class="ace">
                                        <span class="lbl"> Delete </span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="actions[]" checked value="Approve" class="ace">
                                        <span class="lbl"> Approve </span>
                                    </label>
                                    <label>
                                        <input type="checkbox" name="actions[]" checked value="Super Approve" class="ace">
                                        <span class="lbl"> Super Approve </span>
                                    </label>
                                </div>

                            </div>




                            <div class="form-group">
                                <label for="inputError" class="col-xs-12 col-sm-3 col-md-3 control-label"></label>
                                <div class="col-xs-12 col-sm-6">
                                    <button class="btn btn-success"> <i class="fa fa-save"></i> Save </button>
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

    <script src="{{ asset('assets/js/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>


    <script src="{{ asset('assets/custom-js/chosen-box.js') }}"></script>
@stop
