@extends('master')

@section('content')
<!-- <div class="container custom-login">
<div class="row">
<div class="col-sm-4 col-sm-offset-4 ">
<form action="login" method="post">
{{ csrf_field() }}
  <div class="form-group">

    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  
  <button type="submit" class="btn btn-default">Login</button>
</form>
</div>
</div>

</div> -->




 <!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor1/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>
        
				<form class="login100-form validate-form" action="login" method=post enctype="multipart/form-data">
        {{ csrf_field() }}

					<span class="login100-form-title">
					 Login
					</span>
					
                @if ($errors->any())
                <div class="alert alert-danger">
              <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
              </div>
            @endif
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
          <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					

					<div class="text-center p-t-136">
						<a class="txt2" href="/register">
							<h4>Create your Account</h4>
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

<!--===============================================================================================-->
	<script src="vendor1/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
@endsection