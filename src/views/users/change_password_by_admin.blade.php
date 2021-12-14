@extends('layouts.master')
@section('title',' Change User Password')
@section('page-header')
    <i class="fa fa-lock"></i>  Change User Password
@stop
@section('css')

@stop


@section('content')



    <div class="row" style="margin-top:50px !important">
        <div class="col-xs-8 col-xs-offset-2">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title"> Change User Password </h4>

                    <span class="widget-toolbar">
                        <a href="{{ route('permitted.users') }}">
                            <i class="ace-icon fa fa-list-alt"></i> Permitted User List
                        </a>
                    </span>

                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <form class="form-search" action="{{ route('admin.update.password') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xs-8 col-xs-offset-2">

                                    @include('partials._alert_message')


                                    <div class="input-group" style="width:100% !important; margin-bottom:20px">
                                        <b>Set new password for <span class="text-info">{{ $user->name }}</span></b>
                                    </div>

                                    <div class="input-group" style="width:100% !important">
                                        <span class="input-group-btn" style="width:190px !important;">
                                            <button type="button" class="btn btn-inverse btn-white" style="width:190px !important; float: left !important; text-align: left">
                                                <span class="ace-icon fa fa-lock icon-on-left bigger-110"></span>
                                                Email
                                            </button>
                                        </span>
                                        <input type="email" name="email" value="{{ $user->email }}" class="form-control" placeholder="User Email Address">
                                    </div>

                                    <div class="hr"></div>

                                    <div class="input-group" style="width:100% !important">
                                        <span class="input-group-btn" style="width:190px !important;">
                                            <button type="button" class="btn btn-inverse btn-white" style="width:190px !important; float: left !important; text-align: left">
                                                <span class="ace-icon fa fa-lock icon-on-left bigger-110"></span>
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

                                    <input type="hidden" name="id" value="{{ $user->id }}"> <!-- user id as hidden -->

                                    <div class="input-group mt-1" style="width:100% !important">
                                        <span class="input-group-btn" style="width:190px !important">
                                            <button type="button" class="btn btn-inverse btn-white" style="width:190px !important; text-align: left">
                                                <span class="ace-icon fa fa-lock icon-on-right bigger-110"></span>
                                                Confirm Password
                                            </button>
                                        </span>
                                        <input type="password" name="confirm_password" class="form-control search-query" placeholder="..........">
                                    </div>

                                    @error('confirm_password')
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
