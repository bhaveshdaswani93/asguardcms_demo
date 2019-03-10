<?php

namespace Modules\Employee\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // use Translatable;

    protected $table = 'employee__employees';
    public $translatedAttributes = [];
    protected $fillable = ['name','description','position'];
}
