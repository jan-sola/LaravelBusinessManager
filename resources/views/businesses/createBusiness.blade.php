@extends('app')

@section('content')
	
	<style>
		#createBusinessContainer{
			width: 600px;
			margin: 25px auto;
		}
		#createBusinessContainer h1{
			margin-top: 5px;
			margin-bottom: 15px;
			text-align:center;
		}		
		#createBusinessContainer button{
			width:300px;
			display:block;
			margin: 0px auto;
		}
	</style>

	<div id="createBusinessContainer">
		<div class="well">
			<h1>Creating a new business</h1>
			@if($errors->any())
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
						<div>{{$error}}</div>
					@endforeach
				</div>
			@endif
			<form id="editBusinessForm" method="POST" 
				action="/api/businesses/create" enctype="multipart/form-data">
				{!! csrf_field() !!}
				<div class="form-group">
					<label>Name</label>
					<input class="form-control" type="text" name="name" value="">
				</div>
				<div class="form-group">
					<label>Description</label>
					<textarea class="form-control" name="description"></textarea>
				</div>
				<div class="form-group">
					<label>Phone Number</label>
					<input class="form-control" type="tel" name="phoneNumber" value="">
				</div>
				<div class="form-group">
					<label>Website</label>
					<input class="form-control" type="website" name="website" value="">
				</div>
				<div class="form-group">
					<label>Business photo</label>
					<input type="file" name="businessPhoto">
				</div>
				<button class="btn btn-primary">Create</button>
			</form>
			
		</div>
	</div>
@stop