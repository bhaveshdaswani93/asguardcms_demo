<?php

namespace Modules\Leavemanagement\Repositories\Cache;

use Modules\Leavemanagement\Repositories\LeavemanagementRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheLeavemanagementDecorator extends BaseCacheDecorator implements LeavemanagementRepository
{
    public function __construct(LeavemanagementRepository $leavemanagement)
    {
        parent::__construct();
        $this->entityName = 'leavemanagement.leavemanagements';
        $this->repository = $leavemanagement;
    }
}
