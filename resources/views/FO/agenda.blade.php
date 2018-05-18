@extends('FO.layout.app')
@section('imageUrl', $imageUrl)
@section('content')
	<div class="container">
		<div >
			{!! $calendar->calendar() !!}
    		{!! $calendar->script() !!}	
		</div> 
		
	</div>
@endsection