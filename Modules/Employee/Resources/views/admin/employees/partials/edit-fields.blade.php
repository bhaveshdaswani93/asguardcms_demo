<div class="box-body">
    {!! Form::normalInput('name', 'Name', $errors,$employee) !!}
    {!! Form::normalInput('position', 'Position', $errors,$employee) !!}
    {!! Form:: normalTextarea('description', 'Description', $errors,$employee) !!}
</div>
