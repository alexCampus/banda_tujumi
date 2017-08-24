@extends('layout.app')

@section('content')
	<h1>Agenda</h1>
	<div class="container">
		<form method="GET" action="/createEvent">	
			<button><i class="fa fa-plus-square" aria-hidden="true"></i></button>			
		</form>
		<div >
			{!! $calendar->calendar() !!}
    		{!! $calendar->script() !!}	
		</div> 
		
	</div>
@endsection