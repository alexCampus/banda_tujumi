@extends('layout.app')

@section('content')
	<h1>One Event</h1>
	{{$event->title}}
    {{$event->content}}
    {{$event->start_time}}
    {{$event->end_time}}
   	
   	<h2>Liste des Inscrits</h2>
   	@foreach( $event->users as $user)
   		{{$user->name}}
   	@endforeach

   	@if(Auth::check() && $bool === false)
   		<form method="POST" action="/{{$event->id}}/participe">
   			{!! csrf_field() !!}
   			<button class="btn btn-primary">S'Inscrire</button>
   		</form>
   	@endif

   	@if(Auth::check() && $bool === true)
   		<form method="POST" action="/{{$event->id}}/desinscription">
   			{!! csrf_field() !!}
   			<button class="btn btn-danger">Se Désinscrire</button>
   		</form>
   	@endif
@endsection