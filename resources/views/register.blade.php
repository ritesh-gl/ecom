@extends('master')

@section('content')
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Realtime Form Validation</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/formhack.css">
	
</head>
<body>

	<div class="container">
		<form method="post" name="frm" action="register"  class="resgisteration" enctype="multipart/form-data">
    {{ csrf_field() }}
			<h1>Registration Form</h1>
  
  @if ($errors->any())
                <div class="alert alert-danger">
              <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
              </div>
            @endif
			<label for="employeeid">
				<span>Email ID</span>

				<input type="email" name="email" placeholder="Email" id="employeeid" required="required" >

				<ul class="input-requirements">
					<li>At least 3 characters long</li>
					<li>valid</li>
					
				</ul>
			</label>
			
			
			<label for="empname">
				<span> Name</span>

				<input type ="text" name="name" placeholder="Name" id="empname" required="required">

				<ul class="input-requirements">
					<li>At least 3 characters long</li>
					<li>Must only contain letters (no special characters)</li>
				</ul>
			</label>
			
			
			
			<!-- <label for="department">
				<span>Gender</span>
				<input type="text" name="Dept" placeholder="Gender" id="department">
				<ul class="input-requirements">
					<li>At least 2 characters long</li>
					<li>Must only contain letters (no special characters)</li>
				</ul>
			</label> -->
			
			<label for="contact">
				<span>Contact Number</span>

				
				<input type="text" id="contact" name="contact" placeholder="Contact No." required="required">

				<ul class="input-requirements">
					<li>10 digits long</li>
					<li>Must only contain numbers</li>
				</ul>
			</label>
			
			

			<label for="password">
				<span>Password</span>

				<input type="password" name="password" placeholder="Password" id="password" required="required"/>

				<ul class="input-requirements">
					<li>At least 8 characters long (and less than 100 characters)</li>
					<li>Contains at least 1 number</li>
					<li>Contains at least 1 lowercase letter</li>
					<li>Contains at least 1 uppercase letter</li>
					<li>Contains a special character (e.g. @ !)</li>
				</ul>
			</label>

			<label for="password_repeat">
				<span>Confirm Password</span>
				<input type="password" name="password_repeat" id="password_repeat" placeholder="Confirm Password" required="required"/>
			</label>

			
			<br>

			<input type="submit" value="submit">
			<br >	
			<h3 align=center>If already Registered 
				<a href="/login">Login<h3></a>
					</h3>

		</form>
	</div>
	
    <script src="./js/script.js"></script>
</body>
</html>
@endsection