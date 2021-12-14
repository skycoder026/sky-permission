<?php

use Illuminate\Support\Facades\Route;
use Skycoder\SkyPermission\Controllers\ModuleController;
use Skycoder\SkyPermission\Controllers\PermissionGroupController;
use Skycoder\SkyPermission\Controllers\SubmoduleController;

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'permission'], function () {

    Route::resource('modules', ModuleController::class);
    Route::resource('submodules', SubmoduleController::class);
    Route::resource('permission-groups', PermissionGroupController::class);


    Route::resource('permissions', 'PermissionController');
    Route::resource('permission-access', 'UserPermissionController');


    Route::get('active-deactive-module/{module}', [ModuleController::class, 'activeDeactive'])->name('active.deactive.module');
    Route::get('permission-access/create/{id}', 'UserPermissionController@index')->name('load.existing.users.permission');
    Route::get('select/employee/list', 'UserPermissionController@employee_list')->name('employee_list');
    Route::get('permitted/employee/list', 'UserPermissionController@permittedEmployeeList')->name('permitted.employee.list');

    Route::get('permission-access-employee', 'UserPermissionController@employeePermission')->name('permission-access.employee');
    Route::post('permission-access-employee', 'UserPermissionController@employeePermissionStore')->name('permission-access.employee.store');



    Route::get('setting/view-permitted-users', 'PermissionController@view_permitted_users')->name('permitted.users');
    Route::get('user/{id}/status/{status}', 'PermissionController@userChangeStatus')->name('user.active.deactive');
    Route::delete('setting/permitted-users/delete/{user}', 'PermissionController@permittedUserDelete')->name('permitted.user.delete');
    Route::get('/permitted-users/{id}/edit', 'UserPermissionController@edit')->name('edit.permitted.users');
    Route::put('/update-permitted/{id}/users', 'UserPermissionController@update')->name('update.permission.access');
});
