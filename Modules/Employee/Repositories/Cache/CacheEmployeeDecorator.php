<?php

namespace Modules\Employee\Repositories\Cache;

use Modules\Employee\Repositories\EmployeeRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheEmployeeDecorator extends BaseCacheDecorator implements EmployeeRepository
{
    public function __construct(EmployeeRepository $employee)
    {
        parent::__construct();
        $this->entityName = 'employee.employees';
        $this->repository = $employee;
    }
}
