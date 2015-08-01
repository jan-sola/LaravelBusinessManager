@extends('app')

@section('content')
	
	<style>
		#editUserContainer{
			width: 320px;
			margin: 25px auto;
		}
		#editUserContainer h1{
			margin-top: 5px;
			margin-bottom: 15px;
			text-align:center;
		}
		#editUserContainer button{
			width:100%;
		}
		
	</style>

	<div id="editUserContainer">
		<div class="well">
			<h1>Editing user</h1>	
			<form id="editUserForm" method="POST" action="">
				{!! csrf_field() !!}			
				<div class="form-group">
					<label>Name</label>
					<input class="form-control" type="text" name="name" value="{{$user->name}}">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input class="form-control" type="email" name="email" value="{{$user->email}}">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input class="form-control" type="password" name="password" placeholder="Type your current password">
				</div>
				<div class="form-group">
					<label>New Password</label>
					<input class="form-control" type="password" name="passwordNew" placeholder="Type a new password">
				</div>
				<button class="btn btn-primary">Update</button>
			</form>
		</div>
	</div>
@stop