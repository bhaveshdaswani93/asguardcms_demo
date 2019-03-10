<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/employee'], function (Router $router) {
    $router->bind('employee', function ($id) {
        return app('Modules\Employee\Repositories\EmployeeRepository')->find($id);
    });
    $router->get('employees', [
        'as' => 'admin.employee.employee.index',
        'uses' => 'EmployeeController@index',
        'middleware' => 'can:employee.employees.index'
    ]);
    $router->get('employees/create', [
        'as' => 'admin.employee.employee.create',
        'uses' => 'EmployeeController@create',
        'middleware' => 'can:employee.employees.create'
    ]);
    $router->post('employees', [
        'as' => 'admin.employee.employee.store',
        'uses' => 'EmployeeController@store',
        'middleware' => 'can:employee.employees.create'
    ]);
    $router->get('employees/{employee}/edit', [
        'as' => 'admin.employee.employee.edit',
        'uses' => 'EmployeeController@edit',
        'middleware' => 'can:employee.employees.edit'
    ]);
    $router->put('employees/{employee}', [
        'as' => 'admin.employee.employee.update',
        'uses' => 'EmployeeController@update',
        'middleware' => 'can:employee.employees.edit'
    ]);
    $router->delete('employees/{employee}', [
        'as' => 'admin.employee.employee.destroy',
        'uses' => 'EmployeeController@destroy',
        'middleware' => 'can:employee.employees.destroy'
    ]);
// append

});
