@extends('app')

@section('content')
	
	<style>
		#editUserContainer{
			width: 100%;
			max-width:380px;
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
			@if($errors->any())
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
						<div>{{$error}}</div>
					@endforeach
				</div>
			@endif
			<form id="editUserForm" method="POST" action="/users/{{$user->id}}">
				<input type="hidden" name="_method" value="PATCH">
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
					<label>New Password</label>
					<input class="form-control" type="password" name="password"  placeholder="Type a new password">
				</div>
				<div class="form-group">
					<label>Confrm New Password</label>
					<input class="form-control" type="password" name="password_confirmation" placeholder="Retype the new password">
				</div>
				<button class="btn btn-primary">Update</button>
			</form>
		</div>
	</div>
@stop