<?php

namespace Modules\Attendance\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Attendance\Entities\Attendance;
use Modules\Employee\Entities\Employee;
use Modules\Attendance\Http\Requests\CreateAttendanceRequest;
use Modules\Attendance\Http\Requests\UpdateAttendanceRequest;
use Modules\Attendance\Repositories\AttendanceRepository;
use Modules\Employee\Repositories\EmployeeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Core\Foundation\Asset\Manager\AssetManager;
use Modules\User\Entities\Sentinel\User;
use Cartalyst\Sentinel\Roles\EloquentRole as Role;

class AttendanceController extends AdminBaseController
{
    /**
     * @var AttendanceRepository
     */
    private $attendance;
    private $employee;

    public function __construct(AttendanceRepository $attendance,EmployeeRepository $employee)
    {
        parent::__construct();

        $this->attendance = $attendance;
        $this->employee = $employee;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $attendances = Attendance::with('user')->get();
        // dd($attendances);

        return view('attendance::admin.attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->assetManager->addAsset('jquery-ui.css',url('css/additionalCss/jquery-ui.css'));
        $this->assetManager->addAsset('jquery-ui.js',url('js/additionalJs/jquery-ui.js'));
        $this->assetPipeline->requireJs('jquery-ui.js');
        $this->assetPipeline->requireCss('jquery-ui.css');
        $employeeRole = Role::where('name','Employee')->first();
        $employees = User::whereHas('roles',function($q) use ($employeeRole) {
            $q->where('role_id',$employeeRole->id);
        })->get()->pluck('first_name','id')->toArray();
        // $employees = $this->user->all()->pluck('first_name','id')->toArray();
        return view('attendance::admin.attendances.create',compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateAttendanceRequest $request
     * @return Response
     */
    public function store(CreateAttendanceRequest $request)
    {
        $this->attendance->create($request->all());

        return redirect()->route('admin.attendance.attendance.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('attendance::attendances.title.attendances')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Attendance $attendance
     * @return Response
     */
    public function edit(Attendance $attendance)
    {
        return view('attendance::admin.attendances.edit', compact('attendance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Attendance $attendance
     * @param  UpdateAttendanceRequest $request
     * @return Response
     */
    public function update(Attendance $attendance, UpdateAttendanceRequest $request)
    {
        $this->attendance->update($attendance, $request->all());

        return redirect()->route('admin.attendance.attendance.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('attendance::attendances.title.attendances')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Attendance $attendance
     * @return Response
     */
    public function destroy(Attendance $attendance)
    {
        $this->attendance->destroy($attendance);

        return redirect()->route('admin.attendance.attendance.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('attendance::attendances.title.attendances')]));
    }
}
