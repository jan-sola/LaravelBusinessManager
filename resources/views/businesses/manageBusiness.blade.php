@extends('app')

@section('content')
	
	<style>
		#editBusinessContainer{
			width: 600px;
			margin: 25px auto;
		}
		#editBusinessContainer h1{
			margin-top: 5px;
			margin-bottom: 15px;
			text-align:center;
		}		
		#editBusinessContainer button{
			width:300px;
			display:block;
			margin: 0px auto;
		}
	</style>

	<div id="editBusinessContainer">
		<div class="well">
			<h1>Editing business</h1>	
			<form id="editBusinessForm" method="POST" 
				action="" enctype="multipart/form-data">
				{!! csrf_field() !!}			
				<div class="form-group">
					<label>Name</label>
					<input class="form-control" type="text" name="name" value="{{$business->name}}">
				</div>
				<div class="form-group">
					<label>Description</label>
					<textarea class="form-control">{{$business->description}}</textarea>
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