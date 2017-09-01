@extends('layout.app')
@section('imageUrl', $imageUrl)
@section('content')
	<div class="container">
		<div id="pattern" class="table-responsive">
			<table class="table table-hover table-bordered">
	  			<thead>
			      	<tr>
				        <th>Titre</th>
				        <th>Description</th>
				        <th>Début</th>
				        <th>Fin</th>
			      </tr>
			    </thead>
			    <tbody>
			@foreach($events as $event)
			    <tr onclick="window.document.location='/agenda/{{$event->id}}';">
			        <td>{{$event->title}}</td>
			        <td>{{$event->content}}</td>
			        <td>{{\Carbon\Carbon::parse($event->start_time)->format('d/m/Y')}}</td>
			        <td>{{\Carbon\Carbon::parse($event->end)->format('d/m/Y')}}</td>
			    </tr>
			@endforeach
			    </tbody>
			   </table>
		</div>
	</div>
@endsection