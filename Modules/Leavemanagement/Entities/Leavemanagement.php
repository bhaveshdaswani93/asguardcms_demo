<?php

namespace Modules\Leavemanagement\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Sentinel\User;

class Leavemanagement extends Model
{
    // use Translatable;

    protected $table = 'leavemanagement__leavemanagements';
    public $translatedAttributes = [];
    protected $fillable = ['leave_status','leave_date','leave_reason','user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
