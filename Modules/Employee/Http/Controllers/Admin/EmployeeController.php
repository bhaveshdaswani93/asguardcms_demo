<?php

namespace Modules\Employee\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Employee\Entities\Employee;
use Modules\Employee\Http\Requests\CreateEmployeeRequest;
use Modules\Employee\Http\Requests\UpdateEmployeeRequest;
use Modules\Employee\Repositories\EmployeeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class EmployeeController extends AdminBaseController
{
    /**
     * @var EmployeeRepository
     */
    private $employee;

    public function __construct(EmployeeRepository $employee)
    {
        parent::__construct();

        $this->employee = $employee;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $employees = $this->employee->all();

        return view('employee::admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('employee::admin.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateEmployeeRequest $request
     * @return Response
     */
    public function store(CreateEmployeeRequest $request)
    {
        $this->employee->create($request->all());

        return redirect()->route('admin.employee.employee.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('employee::employees.title.employees')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Employee $employee
     * @return Response
     */
    public function edit(Employee $employee)
    {
        return view('employee::admin.employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Employee $employee
     * @param  UpdateEmployeeRequest $request
     * @return Response
     */
    public function update(Employee $employee, UpdateEmployeeRequest $request)
    {
        $this->employee->update($employee, $request->all());

        return redirect()->route('admin.employee.employee.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('employee::employees.title.employees')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Employee $employee
     * @return Response
     */
    public function destroy(Employee $employee)
    {
        $this->employee->destroy($employee);

        return redirect()->route('admin.employee.employee.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('employee::employees.title.employees')]));
    }
}
