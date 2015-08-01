<?php
			$usr = Auth::user();
			if(is_null($usr)){
				$usr = array();
			}
			$usr["isLoggedIn"] = Auth::check();
?>

<!DOCTYPE html>
<html>
<head>
	
	<!-- Latest compiled and minified CSS -->
	<!-- link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" -->
	<!-- Optional theme -->
	<!-- link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" -->
	<link rel="stylesheet" href="/bootstrap-3.3.5/css/bootstrap.css">
	<link rel="stylesheet" href="/bootstrap-3.3.5/css/bootstrap-theme.css">
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

	<style>
	#loginForm, #signupForm{
		width:220px;
		margin: 12px;
	}
	#loginForm button, #signupForm button{
		width:100%;
	}
	
	body{
		max-width:1000px;
		margin: 0 auto;
	}
	</style>
</head>

<body>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapseHeader" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">Business Manager</a>
			</div>
			<div id="collapseHeader" class="collapse navbar-collapse">
				@if($usr['isLoggedIn'])
					<ul class="nav navbar-nav">
						<li><a href="/businesses/create">Add a business</a></li>
					</ul>
					<ul class="nav navbar-nav">
						<li><a href="/users/create">Add a user</a></li>
					</ul>
					<ul class="nav navbar-nav">
						<li><a href="/manage">Manage businesses</a></li>
					</ul>		
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							Welcome, {{$usr->name}} <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="/auth/logout">Logout</a></li>
							</ul>
						</li>
					</ul>
				@else
					<ul class="nav navbar-nav navbar-right">				
						<!-- Register/Signup -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Sign up</a>
							<ul class="dropdown-menu">
								<li>
									<form id="signupForm" method="POST" action="/auth/register">
									{!! csrf_field() !!}
										<div class="form-group">
											<label>Name</label>
											<input class="form-control" type="text" name="name">
										</div>
										<div class="form-group">
											<label>Email</label>
											<input class="form-control" type="email" name="email">
										</div>
										<div class="form-group">
											<label>Password</label>
											<input class="form-control" type="password" name="password">
										</div>
										<div class="form-group">
											<label>Confirm Password</label>
											<input class="form-control" type="password" name="password_confirmation">
										</div>										
										<button type="submit" class="btn btn-primary">Sign up</button>
									</form>
								</li>
							</ul>
						</li>
				
						<!-- Login -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Login</a>
							<ul class="dropdown-menu">
								<li>
									<form id="loginForm" method="POST" action="/auth/login">
									{!! csrf_field() !!}
										<div class="form-group">
											<label>Email</label>
											<input class="form-control" type="email" name="email">
										</div>
										<div class="form-group">
											<label>Password</label>
											<input class="form-control" type="password" name="password">
										</div>
										<div class="form-group">
											<input type="checkbox" name="remember"> Remember Me
										</div>
										<button type="submit" class="btn btn-primary">Log in</button>
									</form>						
								</li>
							</ul>
						</li>
					</ul>
				@endif
			</div>
		</div>
	</nav>
	
	<div id="content" class="container-fluid">
	 @yield('content')
	</div>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>