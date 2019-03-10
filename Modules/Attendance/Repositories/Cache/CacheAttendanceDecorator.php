<?php

namespace Modules\Attendance\Repositories\Cache;

use Modules\Attendance\Repositories\AttendanceRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheAttendanceDecorator extends BaseCacheDecorator implements AttendanceRepository
{
    public function __construct(AttendanceRepository $attendance)
    {
        parent::__construct();
        $this->entityName = 'attendance.attendances';
        $this->repository = $attendance;
    }
}
