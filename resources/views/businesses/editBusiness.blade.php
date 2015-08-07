@extends('app')

@section('content')
	
	<style>
		#editBusinessContainer{
			width: 100%;
			max-width: 600px;
			margin: 25px auto;
		}
		#editBusinessContainer h1{
			margin-top: 5px;
			margin-bottom: 15px;
			text-align:center;
		}		
		#editBusinessContainer button{
			width:100%;
			display:block;
			margin: 0px auto;
		}
	</style>

	<div id="editBusinessContainer">
		<div class="well">
			<h1>Editing business</h1>	
			@if($errors->any())
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
						<div>{{$error}}</div>
					@endforeach
				</div>
			@endif
			<form id="editBusinessForm" method="POST" 
				action="/businesses/{{$business->id}}" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="PATCH">
				{!! csrf_field() !!}			
				<div class="form-group">
					<label>Name</label>
					<input class="form-control" type="text" name="name" value="{{$business->name}}">
				</div>
				<div class="form-group">
					<label>Description</label>
					<textarea class="form-control" name="description">{{$business->description}}</textarea>
				</div>
				<div class="form-group">
					<label>Phone Number</label>
					<input class="form-control" type="tel" name="phoneNumber" value="{{$business->phoneNumber}}">
				</div>
				<div class="form-group">
					<label>Website</label>
					<input class="form-control" type="website" name="website" value="{{$business->website}}">
				</div>
				<div class="form-group">
					<label>Business photo</label>
					<input type="file" name="businessPhoto">
				</div>
				<button class="btn btn-primary">Update</button>
			</form>
		</div>
	</div>
@stop