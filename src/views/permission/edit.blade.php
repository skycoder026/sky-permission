@extends('layouts.master')
@section('title','Edit Permission')
@section('page-header')
    <i class="fa fa-gear"></i> Edit Permission
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
                        <form class="form-horizontal" action="{{ route('permissions.update', $permission->id) }}" method="post" >
                        @csrf
                        @method('PUT')

                            @include('partials._alert_message')




                            <div class="form-group col-sm-12">
                                <label class="col-sm-3 control-label" for="form-field-1-1"> Sub Module </label>
                                <div class="col-xs-12 col-sm-8 @error('parent_permission_id') has-error @enderror">
                                    <select name="parent_permission_id" id="form-field-select-3" style="with:100% !important" data-placeholder="Select" class="form-control chosen-select">
                                        <option value="">-Select-</option>
                                        @foreach($parentPermissions as $id => $parentPermission)
                                        <option value="{{ $id }}" {{ $id == $permission->parent_permission_id ? 'selected' : '' }}>{{ $parentPermission }}</option>
                                        @endforeach  
                                    </select>

                                    @error('parent_permission_id')
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
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-field-1-1">Slug </label>
                                <div class="col-xs-12 col-sm-8 @error('slug') has-error @enderror">
                                    <input type="text"  class="form-control" name="slug"
                                           value="{{ old('slug') ?: $permission->slug }}" placeholder="Permission Slug">

                                    @error('slug')
                                    <span class="text-danger">
                                            {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="form-field-1-1">Parent </label>
                                <div class="col-xs-12 col-sm-8">
                                    <textarea name="description" rows="3" class="form-control" placeholder="Permission Description">{{ old('description') ?: $permission->description }}</textarea>
                                </div>
                            </div>




                            <div class="form-group">
                                <label for="inputError" class="col-xs-12 col-sm-3 col-md-3 control-label"></label>
                                <div class="col-xs-12 col-sm-6">
                                    <button class="btn btn-success"> <i class="fa fa-save"></i> Update</button>
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
    


    <!--  Select Box Search-->
    <script type="text/javascript">
        jQuery(function($){
            if(!ace.vars['touch']) {
                $('.chosen-select').chosen({allow_single_deselect:true});
            }
        });
    </script>

   
@stop