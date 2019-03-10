<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>Employees</h1>
	<br><br>
	<h3>Employee List</h3>
	@if(isset($employees))
		@foreach($employees as $employee)
			Name: {{$employee->name}} <br>
			Position: {{$employee->postition}}<br>
			Description: {{$employee->description}}<br>
		@endforeach
	@endif
</body>
</html>