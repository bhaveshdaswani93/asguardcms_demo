<?php

namespace Modules\Attendance\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Sentinel\User;


class Attendance extends Model
{
    // use Translatable;

    protected $table = 'attendance__attendances';
    public $translatedAttributes = [];
    protected $fillable = ['user_id','attendance_date'];

   public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
