<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/leavemanagement'], function (Router $router) {
    $router->bind('leavemanagement', function ($id) {
        return app('Modules\Leavemanagement\Repositories\LeavemanagementRepository')->find($id);
    });
    $router->get('leavemanagements', [
        'as' => 'admin.leavemanagement.leavemanagement.index',
        'uses' => 'LeavemanagementController@index',
        'middleware' => 'can:leavemanagement.leavemanagements.index'
    ]);
    $router->get('leavemanagements/create', [
        'as' => 'admin.leavemanagement.leavemanagement.create',
        'uses' => 'LeavemanagementController@create',
        'middleware' => 'can:leavemanagement.leavemanagements.create'
    ]);
    $router->post('leavemanagements', [
        'as' => 'admin.leavemanagement.leavemanagement.store',
        'uses' => 'LeavemanagementController@store',
        'middleware' => 'can:leavemanagement.leavemanagements.create'
    ]);
    $router->get('leavemanagements/{leavemanagement}/edit', [
        'as' => 'admin.leavemanagement.leavemanagement.edit',
        'uses' => 'LeavemanagementController@edit',
        'middleware' => 'can:leavemanagement.leavemanagements.edit'
    ]);
    $router->put('leavemanagements/{leavemanagement}', [
        'as' => 'admin.leavemanagement.leavemanagement.update',
        'uses' => 'LeavemanagementController@update',
        'middleware' => 'can:leavemanagement.leavemanagements.edit'
    ]);
    $router->delete('leavemanagements/{leavemanagement}', [
        'as' => 'admin.leavemanagement.leavemanagement.destroy',
        'uses' => 'LeavemanagementController@destroy',
        'middleware' => 'can:leavemanagement.leavemanagements.destroy'
    ]);
// append

});
