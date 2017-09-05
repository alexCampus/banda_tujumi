@extends('layout.app')
@section('imageUrl', $imageUrl)
@section('content')
	<div class="container">
		<div id="pattern" class="table-responsive">
			<h2 style="text-align: center">Prestations à venir</h2>
			<table class="table table-hover table-bordered ">
	  			<thead>
			      	<tr>
				        <th>Titre</th>
				        <th>Début</th>
			      </tr>
			    </thead>
			    <tbody>
			@foreach($nextEvents as $nextEvent)
			    <tr onclick="window.document.location='/agenda/{{$nextEvent->id}}';">
			        <td>{{$nextEvent->title}}</td>
			        <td>{{\Carbon\Carbon::parse($nextEvent->start_time)->format('d/m/Y')}}</td>
			    </tr>
			@endforeach
			    </tbody>
			</table>
		</div>
		<hr>
		<div id="pattern" class="table-responsive">
			<h2 style="text-align: center">Prestations passées</h2>
			<table class="table table-hover table-bordered ">
	  			<thead>
			      	<tr>
				        <th>Titre</th>
				        <th>Début</th>
			      </tr>
			    </thead>
			    <tbody>
			@foreach($pastEvents as $pastEvent)
			    <tr onclick="window.document.location='/agenda/{{$pastEvent->id}}';">
			        <td>{{$pastEvent->title}}</td>
			        <td>{{\Carbon\Carbon::parse($pastEvent->start_time)->format('d/m/Y')}}</td>
			    </tr>
			@endforeach
			    </tbody>
			</table>
		</div>
	</div>
@endsection