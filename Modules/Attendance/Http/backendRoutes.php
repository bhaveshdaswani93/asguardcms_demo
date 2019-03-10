<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/attendance'], function (Router $router) {
    $router->bind('attendance', function ($id) {
        return app('Modules\Attendance\Repositories\AttendanceRepository')->find($id);
    });
    $router->get('attendances', [
        'as' => 'admin.attendance.attendance.index',
        'uses' => 'AttendanceController@index',
        'middleware' => 'can:attendance.attendances.index'
    ]);
    $router->get('attendances/create', [
        'as' => 'admin.attendance.attendance.create',
        'uses' => 'AttendanceController@create',
        'middleware' => 'can:attendance.attendances.create'
    ]);
    $router->post('attendances', [
        'as' => 'admin.attendance.attendance.store',
        'uses' => 'AttendanceController@store',
        'middleware' => 'can:attendance.attendances.create'
    ]);
    $router->get('attendances/{attendance}/edit', [
        'as' => 'admin.attendance.attendance.edit',
        'uses' => 'AttendanceController@edit',
        'middleware' => 'can:attendance.attendances.edit'
    ]);
    $router->put('attendances/{attendance}', [
        'as' => 'admin.attendance.attendance.update',
        'uses' => 'AttendanceController@update',
        'middleware' => 'can:attendance.attendances.edit'
    ]);
    $router->delete('attendances/{attendance}', [
        'as' => 'admin.attendance.attendance.destroy',
        'uses' => 'AttendanceController@destroy',
        'middleware' => 'can:attendance.attendances.destroy'
    ]);
// append

});
