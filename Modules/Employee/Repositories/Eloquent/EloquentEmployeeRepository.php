<?php

namespace Modules\Employee\Repositories\Eloquent;

use Modules\Employee\Repositories\EmployeeRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentEmployeeRepository extends EloquentBaseRepository implements EmployeeRepository
{
	public function find($id)
    {
        return $this->model->find($id);
    }

    public function all()
    {
        return $this->model->orderBy('created_at', 'DESC')->get();
    }
}
