@extends('FO.layout.app')
@section('imageUrl', $imageUrl)
@section('content')
	<div class="container">
		@if (Auth::check() && Auth::user()->adminLevel > 0)
			<ul class="nav nav-pills pull-right" >
	  			<li role="presentation" ><a href="/createEvent"><i class="fa fa-plus" aria-hidden="true"> Evènement</i></a></li>
			</ul>
		@endif
		<div >
			{!! $calendar->calendar() !!}
    		{!! $calendar->script() !!}	
		</div> 
		
	</div>
@endsection