<div class="box-body">
    {!! Form:: normalSelect('user_id', 'Employee', $errors, $employees) !!}
    {!! Form::normalInput('attendance_date', 'Attendance Date', $errors,['id'=>'attendance_date']) !!}

</div>
