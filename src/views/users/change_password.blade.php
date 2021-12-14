@extends('layouts.master')
@section('title',' Change Password')
@section('page-header')
    <i class="fa fa-lock"></i>  Change Password
@stop
@section('css')

@stop


@section('content')


         
    <div class="row" style="margin-top:50px !important">
        <div class="col-xs-8 col-xs-offset-2">
            <div class="widget-box">
                <div class="widget-header widget-header-small">
                    <h4><i class="fa fa-lock"></i>  Change Password</h4>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <form class="form-search" action="{{ route('user.password.update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xs-8 col-xs-offset-2">
                                    
                                    @include('partials._alert_message')
                                    
                                    <div class="input-group" style="width:100% !important">
                                        <span class="input-group-btn" style="width:170px !important; text-align:left !important">
                                            <button type="button" class="btn btn-inverse btn-white" style="width:170px !important">
                                                <span class="ace-icon fa fa-lock icon-on-right bigger-110"></span>
                                                Current Password
                                            </button>
                                        </span>
                                        <input type="password" name="current_password" class="form-control search-query" placeholder="..........">
                                    </div>
                                    @error('current_password')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror

                                    <div class="hr"></div>

                                    <div class="input-group" style="width:100% !important">
                                        <span class="input-group-btn" style="width:170px !important">
                                            <button type="button" class="btn btn-inverse btn-white" style="width:170px !important">
                                                <span class="ace-icon fa fa-lock icon-on-right bigger-110"></span>
                                                New Password
                                            </button>
                                        </span>
                                        <input type="password" name="new_password" class="form-control search-query" placeholder="..........">
                                    </div>
                                    @error('new_password')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror

                                    <div class="hr"></div>

                                    <div class="input-group" style="width:100% !important">
                                        <span class="input-group-btn" style="width:170px !important">
                                            <button type="button" class="btn btn-inverse btn-white" style="width:170px !important">
                                                <span class="ace-icon fa fa-lock icon-on-right bigger-110"></span>
                                                Confirm Password
                                            </button>
                                        </span>
                                        <input type="password" name="new_confirm_password" class="form-control search-query" placeholder="..........">
                                    </div>
                                    
                                    @error('new_confirm_password')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror

                                    <div class="form-group" style="margin-top:20px !important; text-align:right !important">
                                        <button type="submit" class="btn btn-success btn-sm"> <i class="fa fa-save"></i> Update Password </button>
                                    </div>
                                    
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


    

    
@stop