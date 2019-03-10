<?php

namespace Modules\Leavemanagement\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Leavemanagement\Entities\Leavemanagement;
use Modules\Leavemanagement\Http\Requests\CreateLeavemanagementRequest;
use Modules\Leavemanagement\Http\Requests\UpdateLeavemanagementRequest;
use Modules\Leavemanagement\Repositories\LeavemanagementRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Repositories\Sentinel\SentinelAuthentication;

class LeavemanagementController extends AdminBaseController
{
    /**
     * @var LeavemanagementRepository
     */
    private $leavemanagement;
    private $auth;

    public function __construct(LeavemanagementRepository $leavemanagement)
    {
        parent::__construct();

        $this->leavemanagement = $leavemanagement;
        $this->auth = app(SentinelAuthentication::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = $this->auth->user();
        if($user->hasRoleName('Employee'))
        {
            $leavemanagements = Leavemanagement::where('user_id',$user->id)->with('user')->get();
        }
        else
        {
            $leavemanagements = Leavemanagement::with('user')->get();    
        }
        

        return view('leavemanagement::admin.leavemanagements.index', compact('leavemanagements'));
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
        return view('leavemanagement::admin.leavemanagements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateLeavemanagementRequest $request
     * @return Response
     */
    public function store(CreateLeavemanagementRequest $request)
    {
        $user = $this->auth->user();
        $input = $request->all();
        $input['user_id']= $user->id;
        $this->leavemanagement->create($input);

        return redirect()->route('admin.leavemanagement.leavemanagement.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('leavemanagement::leavemanagements.title.leavemanagements')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Leavemanagement $leavemanagement
     * @return Response
     */
    public function edit(Leavemanagement $leavemanagement)
    {
        return view('leavemanagement::admin.leavemanagements.edit', compact('leavemanagement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Leavemanagement $leavemanagement
     * @param  UpdateLeavemanagementRequest $request
     * @return Response
     */
    public function update(Leavemanagement $leavemanagement, UpdateLeavemanagementRequest $request)
    {
        $this->leavemanagement->update($leavemanagement, $request->all());

        return redirect()->route('admin.leavemanagement.leavemanagement.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('leavemanagement::leavemanagements.title.leavemanagements')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Leavemanagement $leavemanagement
     * @return Response
     */
    public function destroy(Leavemanagement $leavemanagement)
    {
        $this->leavemanagement->destroy($leavemanagement);

        return redirect()->route('admin.leavemanagement.leavemanagement.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('leavemanagement::leavemanagements.title.leavemanagements')]));
    }
}
