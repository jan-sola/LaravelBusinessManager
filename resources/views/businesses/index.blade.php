@extends('app')

@section('content')

	<style>
		.businessContainer{
			height: 140px;
			margin: 10px 0;
			overflow:hidden;
		}
		.businessContainer a{
			color:black;
			text-decoration:none;
		}		
		.businessName{
			text-align:center;
		}
		.businessContainer img{
			display:block;
			height:100px;
			width:100px;
			border-radius:10px;
			margin-left:auto;
			margin-right:auto;
		}
	</style>
	
	@if(Auth::check() && sizeof(Auth::user()->following))
	<h2>Following</h2>
	<div class="well">
		<div class="row">
			@foreach( Auth::user()->following as $business)
				<div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
					<div class="businessContainer">
						<a href="/businesses/{{$business->id}}">
							<div><img src="{{$business->imagePath}}" alt="loading..."></div>
							<div class="businessName">{{$business->name}}</div>
						</a>
					</div>
				</div>
			@endforeach
		</div>
	</div>
	@endif
	
	<h2>Businesses</h2>		
	<div class="well">
		<div class="row">
			@foreach( $businesses as $business)
				<div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
					<div class="businessContainer">
						<a href="/businesses/{{$business->id}}">
							<div><img src="{{$business->imagePath}}" alt="loading..."></div>
							<div class="businessName">{{$business->name}}</div>
						</a>
					</div>
				</div>
			@endforeach
		</div>

	</div>
@stop