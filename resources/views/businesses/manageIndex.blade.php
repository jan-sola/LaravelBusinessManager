@extends('app')

@section('content')

	<style>
		#businessList, #businessList th, #userList, #userList th{
			text-align:center;
		}
	</style>
	

	<!--Delete Modal -->
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" >
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
					<h4 class="modal-title">Deleting <span id="entityName"></span></h4>
				</div>
				<div class="modal-body">
					Are you sure you want to delete this <span id="entity"></span>?
				</div>
				<div class="modal-footer">
					<form id="deleteForm" method="POST" action="">
						{!! csrf_field() !!}			
						<input type="hidden" name="_method" value="DELETE">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-danger">Delete</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	
	
	<div class="well">
		<h2>Businesses</h2>
		<div id="businessList">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Name</th>
						<th>Owner</th>
						<th>Phone Number</th>
						<th>Website</th>
						<th></th>				
					</tr>
				</thead>
				<tbody>
					@foreach($businesses as $business)
						<tr>
							<td><a href="/businesses/{{$business->id}}/edit">{{$business->name}}</a></td>
							<td>{{$business->owner->name}}</td>
							<td>{{$business->phoneNumber}}</td>
							<td><a href="{{$business->website}}">{{$business->website}}</a></td>
							<td>
								<a class="deleteButtonX" href="" data-toggle="modal" data-entityname="{{$business->name}}"
									data-target="#deleteModal" data-entity="business" data-id="{{$business->id}}">
									X
								</a>
							</td>					
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="well">
		<h2>Users</h2>
		<div id="userList">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th></th>				
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
						<tr>
							<td><a href="/users/{{$user->id}}/edit">{{$user->name}}</a></td>
							<td>{{$user->email}}</td>
							<td>
								<a class="deleteButtonX" href="" data-toggle="modal" data-entityname="{{$user->name}}"
									data-target="#deleteModal" data-entity="user" data-id="{{$user->id}}">
									X
								</a>
							</td>					
						</tr>
					@endforeach
				</tbody>
			</table>	
		</div>
	</div>
	<script>
		//Script to generate the modal info and delete form
		$('.deleteButtonX').on("click", function(e){
			e.preventDefault();
							
			var target = $(this).data('target');
			var entity = $(this).data('entity');
			var entityName = $(this).data('entityname');
			var id = $(this).data('id');

			$('#entity').html(entity);
			$('#entityName').html(entityName);
			
			if(entity == "user"){
				$('#deleteForm').attr("action", "/users/" + id);				
			}
			else if(entity == "business"){
				$('#deleteForm').attr("action", "/businesses/" + id);
			}
		});
	</script>
	
@stop