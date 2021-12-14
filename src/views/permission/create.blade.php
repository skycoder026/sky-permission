@extends('layouts.master')
@section('title','Create Permission')
@section('page-header')
    <i class="fa fa-gear"></i> Create Permission
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
                            <i class="ace-icon fa fa-list-alt"></i> Permission List
                        </a>
                    </span>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <form class="form-horizontal" action="{{ route('permissions.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                            @include('partials._alert_message')


                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-field-1-1"> Parent Permission  </label>
                                <div class="col-xs-12 col-sm-8 @error('parent_permission_id') has-error @enderror">
                                    <select class="chosen-select form-control" name="parent_permission_id">
                                        <option value=""> select </option>
                                        @foreach ($parentPermissions as $id => $parentPermission)
                                            <option value="{{ $id }}" {{ old('parent_permission_id') == $id ? 'selected' : '' }}>{{ $parentPermission }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_permission_id')
                                    <span class="text-danger">
                                            {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-field-1-1"> Permission Name </label>
                                <div class="col-xs-12 col-sm-8 @error('name') has-error @enderror">
                                    <input type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" placeholder="Permission Name">

                                    @error('name')
                                    <span class="text-danger">
                                            {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-field-1-1"> Description </label>
                                <div class="col-xs-12 col-sm-8 @error('description') has-error @enderror">
                                    <input type="text" class="form-control" name="description"
                                           value="{{ old('description') }}" placeholder="Description (optional)">

                                    @error('description')
                                    <span class="text-danger">
                                            {{ $message }}
                                    </span>
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
                                    {{-- <label>
                                        <input type="checkbox" name="actions[]" checked value="Update" class="ace">
                                        <span class="lbl"> Update </span>
                                    </label> --}}
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

    


    <!--  Select Box Search-->
    <script type="text/javascript">
        jQuery(function($){
            if(!ace.vars['touch']) {
                $('.chosen-select').chosen({allow_single_deselect:true});
            }

        })
    </script>
@stop