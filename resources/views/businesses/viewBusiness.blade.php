@extends('app')

@section('content')
	
	<style>
		#businessDetails{
			margin: 0 auto;
			text-align:center;
		}
		#businessDetails div{
			margin: 5px 0;
		}
		#businessDetails img{
			display:block;
			margin: 10px auto;
			height: auto;
			width: 100%;
			max-height: auto;
			max-width: 400px;
			
		}
		#followersList {
			display: table;
			margin: 0 auto;
		}
		.following{
			background-color:rgb(92, 151, 202);
			background-image: linear-gradient(to bottom, #5c97ca 0%, #5c97ca 100%);
		}
		.following:hover, .following:focus{
		  background-position: 0px -33px;
		}
	</style>
	
	<div class="well" id="businessDetails">
		<h1>{{$business->name}}</h1>
		<div><img src="{{$business->imagePath}}"></div>
		<div>Owned by: {{$business->owner->name}}</div>
		<div><p>{{$business->description}}</p></div>	
		<div>Tel: {{$business->phoneNumber}}</div>
		<div>Website: <a href="{{$business->website}}">{{$business->website}}</a></div>
		<div>
			@if($isLoggedIn && !$isOwner)
				<form id="followForm" method="POST" action="/businesses/{{$business->id}}/follow" style="display:inline">
					{!! csrf_field() !!}
					
					@if($isFollowing)
						<button type="submit" class="btn btn-primary following">Unfollow</button>
						<input type="hidden" name="followStatus" value="unfollow">
					@else
						<button type="submit" class="btn btn-primary">Follow</button>
						<input type="hidden" name="followStatus" value="follow">						
					@endif
				</form>
			@endif
			@if($isOwner || $isAdmin)
				<a href="{{ Request::url() . '/edit' }}"><button class="btn btn-primary">Edit</button></a>
				<form method="POST" action="{{ Request::url() }}" style="display:inline">
					<button type="submit" class="btn btn-danger">Delete</button>
					{!! csrf_field() !!}			
					<input type="hidden" name="_method" value="DELETE">
				</form>
			@endif
		</div>
		<br>
		@if($isOwner || $isAdmin)
			<div>
				<h4>People following {{$business->name}} ({{sizeof($business->followers)}}):</h4>
				<div>
					<ul id="followersList">
						@foreach($business->followers as $follower)
							<li>{{$follower->name}}</li>
						@endforeach
					</ul>
				</div>
			</div>
		@endif
	</div>
@stop