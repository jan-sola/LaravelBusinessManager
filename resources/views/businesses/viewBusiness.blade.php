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
	</style>
	
	<div class="well" id="businessDetails">
		<h1>{{$business->name}}</h1>
		<div><img src="{{$business->imagePath}}"></div>
		<div>Owned by: {{$business->owner->name}}</div>
		<div><p>{{$business->description}}</p></div>	
		<div>Tel: {{$business->phoneNumber}}</div>
		<div>Website: <a href="{{$business->website}}">{{$business->website}}</a></div>
	</div>
@stop