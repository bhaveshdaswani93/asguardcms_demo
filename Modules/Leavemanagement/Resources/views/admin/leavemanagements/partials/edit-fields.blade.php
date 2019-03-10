<div class="box-body">
    {!! Form::normalInput('leave_date', 'Leave Date', $errors,$leavemanagement,['id'=>'leave_date','disabled'=>'disabled']) !!}
   {!! Form:: normalTextarea('leave_reason', 'Leave Reason', $errors,$leavemanagement,['disabled'=>'disabled']) !!}
   {!! Form:: normalSelect('leave_status', 'Leave Reason', $errors, ['approved'=>'approve','rejected'=>'reject']) !!}
</div>
