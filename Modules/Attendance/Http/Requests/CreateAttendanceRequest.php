<?php

namespace Modules\Attendance\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateAttendanceRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'attendance_date' => 'required',
            'user_id' => 'required',
        ];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
