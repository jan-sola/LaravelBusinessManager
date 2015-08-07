@extends('app')

@section('content')
	
	<style>
		#createUserContainer{
			width: 100%;
			max-width:380px;
			margin: 25px auto;
		}
		#createUserContainer h1{
			margin-top: 5px;
			margin-bottom: 15px;
			text-align:center;
		}
		#createUserContainer button{
			width:100%;
		}
		
	</style>

	<div id="createUserContainer">
		<div class="well">
			<h1>Creating a new user</h1>
			@if($errors->any())
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
						<div>{{$error}}</div>
					@endforeach
				</div>
			@endif			
			<form id="editUserForm" method="POST" action="/users">
				{!! csrf_field() !!}			
				<div class="form-group">
					<label>Name</label>
					<input class="form-control" type="text" name="name" value="">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input class="form-control" type="email" name="email" value="">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input class="form-control" type="password" name="password" placeholder="Type a password">
				</div>
				<div class="form-group">
					<label>Confirm Password</label>
					<input class="form-control" type="password" name="password_confirmation" placeholder="Retype the password">
				</div>
				<button class="btn btn-primary">Create</button>
			</form>
		</div>
	</div>
@stop